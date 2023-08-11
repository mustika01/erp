<?php

namespace Kumi\Jinzai\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Kumi\Jinzai\Database\Factories\EmployeeFactory;
use Kumi\Jinzai\Events\Employee\Created;
use Kumi\Jinzai\Support\DatabaseTableNames;
use Kumi\Jinzai\Support\Enums\EmploymentStatus;
use Kumi\Jinzai\Support\Enums\IdentityType;
use Kumi\Kanshi\Contracts\HasActivityLogNameAttribute;
use Kumi\Kanshi\Models\Activity;
use Kumi\Kanshi\Traits\InteractsWithNullCauser;
use Kumi\Tobira\Models\User;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Employee extends Model implements HasMedia, HasActivityLogNameAttribute
{
    use HasFactory;
    use InteractsWithMedia;
    use LogsActivity;
    use InteractsWithNullCauser;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::EMPLOYEES;

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => Created::class,
    ];

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'date_of_birth' => 'datetime',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'user',
        'latestEmployments' => [
            'department',
            'position',
        ],
        'latestActiveEmployment' => [
            'department',
            'position',
        ],
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function identities()
    {
        return $this->hasMany(Identity::class);
    }

    public function relatives()
    {
        return $this->hasMany(Relative::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function onboardingLink()
    {
        return $this->hasOne(OnboardingLink::class);
    }

    public function employments()
    {
        return $this->hasMany(Employment::class);
    }

    public function latestEmployments()
    {
        return $this->hasMany(Employment::class)->latest();
    }

    public function payroll()
    {
        return $this->hasOne(Payroll::class);
    }

    public function scopeCompletedOnboarding(Builder $builder): Builder
    {
        return $builder->whereNotNull('onboarded_at');
    }

    public function scopeActiveEmployment(Builder $builder): Builder
    {
        return $builder->whereHas('employments', function (Builder $query) {
            $query
                ->where('contract_ended_at', '>=', Carbon::now())
                ->whereNull('left_at')
                ->whereNull('resigned_at')
            ;
        });
    }

    public function scopeByDepartment(Builder $builder, int $departmentID): Builder
    {
        return $builder->whereHas('employments', function (Builder $query) use ($departmentID) {
            $query->where('department_id', $departmentID);
        });
    }

    public function scopeWithPayroll(Builder $builder): Builder
    {
        return $builder->has('payroll');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(function (string $event) {
                return __('jinzai::filament/resources/employee.events.' . $event);
            })
            ->logAll()
            ->logOnlyDirty()
        ;
    }

    public function tapActivity(Activity $activity, string $event)
    {
        if (self::eventsToBeRecorded()->contains($event)) {
            $activity = $this->handleNullCauser($activity);
        }
    }

    public function getActivityLogNameAttribute(): string
    {
        return $this->user->getAttribute('name');
    }

    public function getEmailAttribute(): string
    {
        return $this->user->getAttribute('email');
    }

    public function getCodeAttribute(): string
    {
        return Str::padLeft($this->getAttribute('id'), 4, 0);
    }

    public function getInternalIdAttribute(): string
    {
        $employment = $this->latestEmployments
            ->where('status', EmploymentStatus::PERMANENT)
            ->whereNull('contract_started_at')
            ->whereNull('contract_ended_at')
            ->whereNull('left_at')
            ->whereNull('resigned_at')
            ->first()
        ;

        if (! $employment) {
            $employment = $this->latestEmployments
                ->where('contract_ended_at', '>=', Carbon::now())
                ->whereNull('left_at')
                ->whereNull('resigned_at')
                ->first()
            ;
        }

        if (! $employment) {
            return 'N/A';
        }

        $department = $employment->department->code;
        $position = $employment->position->code;
        $employee = $this->getAttribute('code');

        return "{$department}.{$position}.{$employee}";
    }

    public function hasBeenThroughOnboarding(): bool
    {
        return $this->hasCreatedOnboardingLink()
            && ! is_null($this->getAttribute('onboarded_at'));
    }

    public function hasCreatedOnboardingLink(): bool
    {
        return (bool) $this->onboardingLink;
    }

    public function latestPermanentEmployment(): HasOne
    {
        return $this->hasOne(Employment::class)
            ->ofMany([
                'id' => 'max',
            ], function (Builder $builder) {
                $builder
                    ->where('status', EmploymentStatus::PERMANENT)
                    ->whereNull('left_at')
                    ->whereNull('resigned_at')
                ;
            })
        ;
    }

    public function latestActiveEmployment(): HasOne
    {
        return $this->hasOne(Employment::class)
            ->ofMany([
                'id' => 'max',
            ], function (Builder $builder) {
                $builder
                    ->where('contract_ended_at', '>=', Carbon::now())
                    ->whereNull('left_at')
                    ->whereNull('resigned_at')
                ;
            })
        ;
    }

    public function latestInactiveEmployment(): HasOne
    {
        return $this->hasOne(Employment::class)
            ->ofMany([
                'id' => 'max',
            ], function (Builder $builder) {
                $builder
                    ->where('contract_ended_at', '<=', Carbon::now())
                ;
            })
        ;
    }

    public function hasLatestInactiveEmployment(): bool
    {
        return ! is_null($this->latestInactiveEmployment);
    }

    public function identityCard(): HasOne
    {
        return $this->hasOne(Identity::class)
            ->ofMany([], function (Builder $builder) {
                $builder->where('type', IdentityType::IDENTITY_CARD);
            })
        ;
    }

    public function getIdentityCardNumberAttribute(): string
    {
        return is_null($this->identityCard) ? 'N/A' : $this->identityCard->number;
    }

    public function getDepartmentAttribute(): string
    {
        $employment = $this->latestPermanentEmployment;

        if (! $employment) {
            $employment = $this->latestActiveEmployment;
        }

        return is_null($employment) ? 'N/A' : $employment->department->name;
    }

    public function getJobPositionAttribute(): string
    {
        return is_null($this->latestActiveEmployment) ? 'N/A' : $this->latestActiveEmployment->position->name;
    }

    public function hasActiveEmployment(): bool
    {
        return $this->latestActiveEmployment()->exists();
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return EmployeeFactory::new();
    }
}

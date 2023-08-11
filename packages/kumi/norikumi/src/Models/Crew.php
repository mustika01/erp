<?php

namespace Kumi\Norikumi\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Kumi\Kanshi\Contracts\HasActivityLogNameAttribute;
use Kumi\Kanshi\Models\Activity;
use Kumi\Kanshi\Traits\InteractsWithNullCauser;
use Kumi\Norikumi\Database\Factories\CrewFactory;
use Kumi\Norikumi\Support\DatabaseTableNames;
use Kumi\Norikumi\Support\Enums\IdentityType;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Crew extends Model implements HasMedia, HasActivityLogNameAttribute
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
    protected $table = DatabaseTableNames::CREWS;

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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(function (string $event) {
                return __('norikumi::filament/resources/crew.events.' . $event);
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

    public function identities()
    {
        return $this->hasMany(Identity::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function relatives()
    {
        return $this->hasMany(Relative::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function payroll(): HasOne
    {
        return $this->hasOne(Payroll::class);
    }

    public function identityCard(): HasOne
    {
        return $this->hasOne(Identity::class)
            ->ofMany([], function (Builder $builder) {
                $builder->where('type', IdentityType::IDENTITY_CARD);
            })
        ;
    }

    public function scopeActiveContract(Builder $builder): Builder
    {
        return $builder->whereHas('contracts', function (Builder $query) {
            $query
                ->where('started_at', '<=', Carbon::now())
                ->where('ended_at', '>=', Carbon::now())
            ;
        });
    }

    public function latestActiveContract(): HasOne
    {
        return $this->hasOne(Contract::class)
            ->ofMany([
                'id' => 'max',
            ], function (Builder $builder) {
                $builder
                    ->where('started_at', '<=', Carbon::now())
                    ->where('ended_at', '>=', Carbon::now())
                ;
            })
        ;
    }

    public function latestInactiveContract(): HasOne
    {
        return $this->hasOne(Contract::class)
            ->ofMany([
                'id' => 'max',
            ], function (Builder $builder) {
                $builder
                    ->where('ended_at', '<=', Carbon::now())
                ;
            })
        ;
    }

    public function latestContracts()
    {
        return $this->hasMany(Contract::class)->latest();
    }

    public function latestActiveAssignment()
    {
        return $this->hasOne(Assignment::class)
            ->ofMany(
                [
                    'id' => 'max',
                ],
                function (Builder $builder) {
                    $builder
                        ->whereNull('retracted_at')
                    ;
                }
            )
        ;
    }

    public function hasLatestInactiveContract(): bool
    {
        return ! is_null($this->latestInactiveContract);
    }

    public function getIdentityCardNumberAttribute(): string
    {
        return is_null($this->identityCard) ? 'N/A' : $this->identityCard->number;
    }

    public function getPositionAttribute(): string
    {
        return is_null($this->latestActiveContract) ? 'N/A' : $this->latestActiveContract->position;
    }

    public function getPositionGradeAttribute()
    {
        return is_null($this->latestActiveContract) ? 'N/A' : $this->latestActiveContract->grade;
    }

    public function getVesselAttribute(): string
    {
        return is_null($this->latestActiveAssignment) ? 'N/A' : $this->latestActiveAssignment->vessel->name;
    }

    public function hasActiveContract(): bool
    {
        return $this->latestActiveContract()->exists();
    }

    public function scopeByVessel(Builder $builder, int $vesselID): Builder
    {
        return $builder->whereHas('assignments', function (Builder $query) use ($vesselID) {
            $query->where('vessel_id', $vesselID);
        });
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return CrewFactory::new();
    }
}

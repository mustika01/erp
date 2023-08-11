<?php

namespace Kumi\Jinzai\Models;

use Illuminate\Support\Carbon;
use Kumi\Kanshi\Models\Activity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Kumi\Jinzai\Support\DatabaseTableNames;
use Spatie\Activitylog\Traits\LogsActivity;
use Kumi\Kanshi\Traits\InteractsWithNullCauser;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Kumi\Jinzai\Database\Factories\PayrollFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payroll extends Model
{
    use HasFactory;
    use LogsActivity;
    use InteractsWithNullCauser;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::PAYROLLS;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'activated_at' => 'datetime',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'employee',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function banks(): HasMany
    {
        return $this->hasMany(Bank::class);
    }

    public function primaryBank(): HasOne
    {
        return $this->hasOne(Bank::class)
            ->ofMany([
                'id' => 'max',
            ], function (Builder $builder) {
                $builder->where('is_primary', true);
            })
        ;
    }

    public function payouts(): HasMany
    {
        return $this->hasMany(Payout::class);
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }

    public function oldestActiveLoan(): HasOne
    {
        return $this->hasOne(Loan::class)
            ->ofMany([
                'started_at' => 'MIN',
            ], function (Builder $builder) {
                $builder
                    ->has('approval')
                    ->where('started_at', '<=', Carbon::now())
                    ->where('finalized_at', '>=', Carbon::now())
                ;
            })
        ;
    }

    public function latestPayout(): HasOne
    {
        return $this->hasOne(Payout::class)->latestOfMany('finalized_at');
    }

    public function scopeOnlyActivated(Builder $builder): Builder
    {
        return $builder->whereNotNull('activated_at');
    }

    public function hasAnyBanks(): bool
    {
        return $this->banks()->exists();
    }

    public function hasPendingLoan(): bool
    {
        return $this->loans->contains(function (Loan $loan) {
            return ! $loan->isApproved() && ! $loan->isExpired();
        });
    }

    public function hasActiveLoan(): bool
    {
        return $this->loans->contains(function (Loan $loan) {
            return $loan->isApproved() && ! $loan->isExpired();
        });
    }

    public function markAsActivated(string $activationDate): void
    {
        $this->update([
            'activated_at' => $activationDate,
        ]);
    }

    public function markAsDeactivated(): void
    {
        $this->update([
            'activated_at' => null,
        ]);
    }

    public function isActivated(): bool
    {
        return ! is_null($this->getAttribute('activated_at'));
    }

    public function isLatestPayoutExpired(): bool
    {
        if (is_null($this->latestPayout)) {
            return true;
        }

        return $this->latestPayout->finalized_at->isPast();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(function (string $event) {
                return __('jinzai::filament/resources/payroll.events.' . $event);
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

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return PayrollFactory::new();
    }
}

<?php

namespace Kumi\Norikumi\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Kumi\Kanshi\Models\Activity;
use Kumi\Kanshi\Traits\InteractsWithNullCauser;
use Kumi\Norikumi\Events\Deposit\Approved;
use Kumi\Norikumi\Support\DatabaseTableNames;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Deposit extends Model
{
    use LogsActivity;
    use InteractsWithNullCauser;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::DEPOSITS;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'started_at' => 'datetime',
        'finalized_at' => 'datetime',
    ];

    public function payroll(): BelongsTo
    {
        return $this->belongsTo(Payroll::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(DepositPayment::class);
    }

    public function approval(): MorphOne
    {
        return $this->morphOne(Approval::class, 'approvable');
    }

    public function oldestPayment(): HasOne
    {
        return $this->hasOne(DepositPayment::class)->oldestOfMany('paid_at');
    }

    public function oldestUnpaidPayment(): HasOne
    {
        return $this->hasOne(DepositPayment::class)
            ->ofMany(
                [
                    'paid_at' => 'MIN',
                ],
                function (Builder $builder) {
                    $builder
                        ->where('paid_at', '>=', Carbon::now())
                    ;
                }
            )
        ;
    }

    public function getDepositAmountFormattedAttribute(): string
    {
        return number_format($this->getAttribute('deposit_amount'));
    }

    public function getInstallmentAmountFormattedAttribute(): string
    {
        return number_format($this->getAttribute('installment_amount'));
    }

    public function isActive(): bool
    {
        return $this->getAttribute('started_at')->isPast()
            && $this->getAttribute('finalized_at')->isFuture();
    }

    public function isActiveAgainstPayout(Payout $payout): bool
    {
        return $this->getAttribute('started_at')->isBefore($payout->finalized_at)
            && $this->getAttribute('finalized_at')->isAfter($payout->started_at);
    }

    public function isCompleted(): bool
    {
        return $this->getAttribute('finalized_at')->isPast();
    }

    public function markAsApproved(): void
    {
        $approval = new Approval([
            'user_id' => Auth::user()->id,
        ]);

        $this->approval()->save($approval);

        Approved::dispatch($this);
    }

    public function isApproved(): bool
    {
        return ! is_null($this->approval);
    }

    public function isExpired(): bool
    {
        return $this->getAttribute('finalized_at')->isPast();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(function (string $event) {
                return __('norikumi::filament/resources/deposit.events.' . $event);
            })
            ->logAll()
            ->logOnlyDirty()
        ;
    }

    public function tapActivity(Activity $activity, string $event)
    {
        if (self::eventsToBeRecorded()->contains($event)) {
            $activity = $this->handleNullCauser($activity);
            $payroll = $activity->subject->payroll;

            $activity->subject_type = Payroll::class;
            $activity->subject_id = $payroll->id;
        }
    }
}

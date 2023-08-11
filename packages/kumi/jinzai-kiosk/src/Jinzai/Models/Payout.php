<?php

namespace Kumi\Jinzai\Models;

use NumberFormatter;
use Illuminate\Support\Carbon;
use Kumi\Kanshi\Models\Activity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Kumi\Jinzai\Support\DatabaseTableNames;
use Spatie\Activitylog\Traits\LogsActivity;
use Kumi\Kanshi\Traits\InteractsWithNullCauser;
use Kumi\Jinzai\Support\Enums\DisbursementStatus;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Payout extends Model
{
    use LogsActivity;
    use InteractsWithNullCauser;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::PAYOUTS;

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

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'payroll' => [
            'employee' => [
                'user',
            ],
        ],
        'items',
        'approvals',
    ];

    public function payroll(): BelongsTo
    {
        return $this->belongsTo(Payroll::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(PayoutItem::class);
    }

    public function approvals(): MorphMany
    {
        return $this->morphMany(Approval::class, 'approvable');
    }

    public function disbursements(): HasMany
    {
        return $this->hasMany(Disbursement::class);
    }

    public function hasNoPendingDisbursement(): bool
    {
        return $this
            ->disbursements()
            ->whereIn('status', [DisbursementStatus::PENDING, DisbursementStatus::PROCESSING])
            ->doesntExist()
        ;
    }

    public function hasNoCompletedDisbursement(): bool
    {
        return $this
            ->disbursements()
            ->where('status', DisbursementStatus::COMPLETED)
            ->doesntExist()
        ;
    }

    public function scopeDateBetween(Builder $builder, Carbon $startDate, Carbon $endDate): Builder
    {
        return $builder
            ->whereBetween('started_at', [$startDate, $endDate])
            ->orWhereBetween('finalized_at', [$startDate, $endDate])
        ;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(function (string $event) {
                return __('jinzai::filament/resources/payout.events.' . $event);
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

    public function scopeSortAmount(Builder $builder, string $type, string $direction): Builder
    {
        return $builder
            ->join(
                DatabaseTableNames::PAYOUT_ITEMS,
                DatabaseTableNames::PAYOUT_ITEMS . '.payout_id',
                '=',
                DatabaseTableNames::PAYOUTS . '.id'
            )
            ->where(DatabaseTableNames::PAYOUT_ITEMS . '.type', $type)
            ->groupBy(DatabaseTableNames::PAYOUTS . '.id')
            ->orderByRaw('max(' . DatabaseTableNames::PAYOUT_ITEMS . ".amount) {$direction}")
        ;
    }

    public function initializeMonthlyPayoutItems(): void
    {
        $this->items()->saveMany([
            new PayoutItem([
                'type' => PayoutItem::TYPE_BASIC,
                'description' => 'Basic Salary',
                'amount' => $this->payroll->salary,
            ]),
            new PayoutItem([
                'type' => PayoutItem::TYPE_JOB_ALLOWANCE,
                'description' => 'Job Allowance',
                'amount' => $this->payroll->job_allowance,
            ]),
        ]);
    }

    public function initializePayoutItemForLoanPayment(): void
    {
        $payroll = $this->payroll;

        if ($payroll->hasActiveLoan() && $loan = $payroll->oldestActiveLoan) {
            $payment = $loan->oldestUnpaidPayment;

            $formatter = new NumberFormatter('en_US', NumberFormatter::ORDINAL);
            $sequence = $formatter->format($payment->sequence);

            $item = new PayoutItem([
                'type' => PayoutItem::TYPE_LOAN,
                'description' => "Loan Payment ({$sequence} of {$payment->total_sequence})",
                'amount' => $payment->amount * -1,
            ]);

            $item->relatable()->associate($payment);

            $this->items()->save($item);
        }
    }

    public function getBaseAmountAttribute(): int
    {
        return $this->items->firstWhere('type', PayoutItem::TYPE_BASIC)->amount;
    }

    public function getBaseAmountFormattedAttribute(): string
    {
        return number_format($this->getAttribute('base_amount'));
    }

    public function getJobAllowanceAmountAttribute(): int
    {
        return $this->items->firstWhere('type', PayoutItem::TYPE_JOB_ALLOWANCE)->amount;
    }

    public function getJobAllowanceAmountFormattedAttribute(): string
    {
        return number_format($this->getAttribute('job_allowance_amount'));
    }

    public function getAdjustmentAmountAttribute(): int
    {
        return $this->items->filter(function (PayoutItem $item) {
            return in_array($item->type, [
                PayoutItem::TYPE_INITIAL_ADJUSTMENT,
                PayoutItem::TYPE_ADJUSTMENT,
                PayoutItem::TYPE_ATTENDANCE,
            ]);
        })->sum('amount');
    }

    public function getAdjustmentAmountFormattedAttribute(): string
    {
        return number_format($this->getAttribute('adjustment_amount'));
    }

    public function getLoanAmountAttribute(): int
    {
        return $this->items->firstWhere('type', PayoutItem::TYPE_LOAN)->amount ?? 0;
    }

    public function getLoanAmountFormattedAttribute(): string
    {
        return number_format($this->getAttribute('loan_amount'));
    }

    public function getGrossPayoutAmountAttribute(): int
    {
        return $this->items->sum('amount');
    }

    public function getGrossPayoutAmountFormattedAttribute(): string
    {
        return number_format($this->getAttribute('gross_payout_amount'));
    }

    public function getTakeHomePayAmountAttribute(): int
    {
        return $this->items->sum('amount');
    }

    public function getTakeHomePayAmountFormattedAttribute(): string
    {
        return number_format($this->getAttribute('take_home_pay_amount'));
    }

    public function getPrimaryBankNameAttribute(): string
    {
        return is_null($this->payroll->primaryBank) ? 'N/A' : $this->payroll->primaryBank->bank_name;
    }

    public function getPrimaryBankAccountNumberAttribute(): string
    {
        return is_null($this->payroll->primaryBank) ? 'N/A' : $this->payroll->primaryBank->account_number;
    }
}

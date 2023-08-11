<?php

namespace Kumi\Kiosk\Models;

use Kumi\Jinzai\Models\Payroll;
use Kumi\Jinzai\Models\Approval;
use Kumi\Kanshi\Models\Activity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Kumi\Jinzai\Support\DatabaseTableNames;
use Spatie\Activitylog\Traits\LogsActivity;
use Kumi\Kanshi\Traits\InteractsWithNullCauser;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class PersonalPayout extends Model
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
        'approvals',
    ];

    public function payroll(): BelongsTo
    {
        return $this->belongsTo(Payroll::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(PersonalPayoutItem::class, 'payout_id');
    }

    public function approvals(): MorphMany
    {
        return $this->morphMany(Approval::class, 'approvable');
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

    public function getBaseAmountAttribute(): int
    {
        return $this->items->firstWhere('type', PersonalPayoutItem::TYPE_BASIC)->amount;
    }

    public function getBaseAmountFormattedAttribute(): string
    {
        return number_format($this->getAttribute('base_amount'));
    }

    public function getJobAllowanceAmountAttribute(): int
    {
        return $this->items->firstWhere('type', PersonalPayoutItem::TYPE_JOB_ALLOWANCE)->amount;
    }

    public function getJobAllowanceAmountFormattedAttribute(): string
    {
        return number_format($this->getAttribute('job_allowance_amount'));
    }

    public function getAdjustmentAmountAttribute(): int
    {
        return $this->items->filter(function (PersonalPayoutItem $item) {
            return in_array($item->type, [
                PersonalPayoutItem::TYPE_INITIAL_ADJUSTMENT,
                PersonalPayoutItem::TYPE_ADJUSTMENT,
            ]);
        })->sum('amount');
    }

    public function getAdjustmentAmountFormattedAttribute(): string
    {
        return number_format($this->getAttribute('adjustment_amount'));
    }

    public function getLoanAmountAttribute(): int
    {
        return $this->items->firstWhere('type', PersonalPayoutItem::TYPE_LOAN)->amount ?? 0;
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
        return $this->items
            ->reject(function (PersonalPayoutItem $item) {
                return $item->type == PersonalPayoutItem::TYPE_ATTENDANCE;
            })
            ->sum('amount')
        ;
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

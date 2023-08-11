<?php

namespace Kumi\Kiosk\Models;

use Illuminate\Database\Eloquent\Model;
use Kumi\Jinzai\Support\DatabaseTableNames;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonalPayoutItem extends Model
{
    public const TYPE_BASIC = 'basic';
    public const TYPE_JOB_ALLOWANCE = 'job_allowance';
    public const TYPE_INITIAL_ADJUSTMENT = 'initial-adjustment';
    public const TYPE_ADJUSTMENT = 'adjustment';
    public const TYPE_ATTENDANCE = 'attendance';
    public const TYPE_LOAN = 'loan';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::PAYOUT_ITEMS;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'properties' => AsCollection::class,
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'payout',
    ];

    public function payout(): BelongsTo
    {
        return $this->belongsTo(PersonalPayout::class);
    }

    public function getAmountFormattedAttribute(): string
    {
        return number_format($this->getAttribute('amount'));
    }
}

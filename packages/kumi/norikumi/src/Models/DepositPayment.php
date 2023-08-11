<?php

namespace Kumi\Norikumi\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kumi\Norikumi\Support\DatabaseTableNames;

class DepositPayment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::DEPOSIT_PAYMENTS;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function deposit(): BelongsTo
    {
        return $this->belongsTo(Deposit::class);
    }

    public function getAmountFormattedAttribute(): string
    {
        return number_format($this->getAttribute('amount'));
    }
}

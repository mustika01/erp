<?php

namespace Kumi\Yoyaku\Models;

use Illuminate\Database\Eloquent\Model;
use Kumi\Yoyaku\Support\DatabaseTableNames;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::BOOKINGS;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    public function bookable(): BelongsTo
    {
        return $this->belongsTo(Bookable::class);
    }
}

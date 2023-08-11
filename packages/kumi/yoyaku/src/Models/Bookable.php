<?php

namespace Kumi\Yoyaku\Models;

use Illuminate\Database\Eloquent\Model;
use Kumi\Yoyaku\Support\DatabaseTableNames;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bookable extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::BOOKABLES;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}

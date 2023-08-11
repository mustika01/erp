<?php

namespace Kumi\Sousa\Models;

use Illuminate\Database\Eloquent\Model;
use Kumi\Sousa\Support\DatabaseTableNames;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VesselTrack extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::VESSEL_TRACKS;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'tracking_started_at' => 'datetime',
        'tracking_finished_at' => 'datetime',
    ];

    public function vessel(): BelongsTo
    {
        return $this->belongsTo(Vessel::class);
    }
}

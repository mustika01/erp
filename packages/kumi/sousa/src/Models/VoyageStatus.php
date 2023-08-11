<?php

namespace Kumi\Sousa\Models;

use Illuminate\Database\Eloquent\Model;
use Kumi\Sousa\Support\DatabaseTableNames;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VoyageStatus extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::VOYAGE_STATUSES;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'executed_at' => 'datetime',
    ];

    public function voyage(): BelongsTo
    {
        return $this->belongsTo(VesselVoyage::class);
    }

    public function getExecutedDateAttribute(): string
    {
        return $this->getAttribute('executed_at')->format('d M Y');
    }

    public function getExecutedTimeAttribute(): string
    {
        return $this->getAttribute('executed_at')->format('H:i');
    }

    public function isDeletable(): bool
    {
        return $this->voyage->latestStatus->is($this);
    }
}

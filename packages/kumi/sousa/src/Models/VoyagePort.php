<?php

namespace Kumi\Sousa\Models;

use Illuminate\Database\Eloquent\Model;
use Kumi\Sousa\Support\DatabaseTableNames;
use Kumi\Sousa\Database\Factories\VoyagePortFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VoyagePort extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::VOYAGE_PORTS;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    public function city(): BelongsTo
    {
        return $this->belongsTo(VoyageCity::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return VoyagePortFactory::new();
    }
}

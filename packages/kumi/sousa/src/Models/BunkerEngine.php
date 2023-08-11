<?php

namespace Kumi\Sousa\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kumi\Sousa\Database\Factories\BunkerEngineFactory;
use Kumi\Sousa\Support\DatabaseTableNames;

class BunkerEngine extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::BUNKER_ENGINES;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    public function bunker(): BelongsTo
    {
        return $this->belongsTo(Bunker::class);
    }

    public function formulas(): HasMany
    {
        return $this->hasMany(BunkerFormula::class, 'engine_id');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return BunkerEngineFactory::new();
    }
}

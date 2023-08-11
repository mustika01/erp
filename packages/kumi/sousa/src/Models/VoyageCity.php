<?php

namespace Kumi\Sousa\Models;

use Illuminate\Database\Eloquent\Model;
use Kumi\Sousa\Support\DatabaseTableNames;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kumi\Sousa\Database\Factories\VoyageCityFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VoyageCity extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::VOYAGE_CITIES;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    public function ports(): HasMany
    {
        return $this->hasMany(VoyagePort::class, 'city_id');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return VoyageCityFactory::new();
    }
}

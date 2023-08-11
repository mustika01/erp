<?php

namespace Kumi\Jinzai\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Kumi\Jinzai\Support\DatabaseTableNames;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kumi\Jinzai\Database\Factories\JobPositionFactory;

class JobPosition extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::JOB_POSITIONS;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    public function employments(): HasMany
    {
        return $this->hasMany(Employment::class);
    }

    public function getCodeAttribute(): string
    {
        return Str::padLeft($this->getAttribute('id'), 3, 0);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return JobPositionFactory::new();
    }
}

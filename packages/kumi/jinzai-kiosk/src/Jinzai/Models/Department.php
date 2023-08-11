<?php

namespace Kumi\Jinzai\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Kumi\Jinzai\Support\DatabaseTableNames;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kumi\Jinzai\Database\Factories\DepartmentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::DEPARTMENTS;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    public function positions(): HasMany
    {
        return $this->hasMany(JobPosition::class);
    }

    public function getCodeAttribute(): string
    {
        return Str::padLeft($this->getAttribute('id'), 2, 0);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return DepartmentFactory::new();
    }
}

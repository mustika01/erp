<?php

namespace Kumi\Norikumi\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kumi\Norikumi\Support\DatabaseTableNames;
use Illuminate\Database\Eloquent\Casts\AsCollection;

class RegistrationFormEntry extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::REGISTRATION_FORM_ENTRIES;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'completed_at' => 'datetime',
        'properties' => AsCollection::class,
    ];

    public function getCompletedDateAttribute(): string
    {
        return $this->isCompleted()
            ? $this->getAttribute('completed_at')->format('d F Y')
            : 'N/A';
    }

    public function isCompleted(): bool
    {
        return ! is_null($this->getAttribute('completed_at'));
    }
}

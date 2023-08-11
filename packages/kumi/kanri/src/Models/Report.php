<?php

namespace Kumi\Kanri\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Kumi\Kanri\Support\DatabaseTableNames;
use Kumi\Tobira\Models\User;

class Report extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::REPORTS;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'started_at' => 'datetime',
        'finalized_at' => 'datetime',
        'properties' => AsCollection::class,
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reportable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getStartDateAttribute(): string
    {
        return $this->getAttribute('started_at')->format('d F Y');
    }

    public function getFinalDateAttribute(): string
    {
        return $this->getAttribute('finalized_at')->format('d F Y');
    }
}

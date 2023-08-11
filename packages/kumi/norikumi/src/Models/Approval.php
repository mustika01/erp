<?php

namespace Kumi\Norikumi\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Kumi\Norikumi\Support\DatabaseTableNames;
use Kumi\Tobira\Models\User;

class Approval extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::APPROVALS;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    public function approvable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedDateAttribute(): string
    {
        return $this->getAttribute('created_at')->format('d F Y');
    }

    public function getCreatedTimeAttribute(): string
    {
        return $this->getAttribute('created_at')->format('H:i');
    }
}

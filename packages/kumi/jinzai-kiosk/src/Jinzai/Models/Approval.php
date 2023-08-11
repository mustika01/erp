<?php

namespace Kumi\Jinzai\Models;

use Kumi\Tobira\Models\User;
use Illuminate\Database\Eloquent\Model;
use Kumi\Jinzai\Support\DatabaseTableNames;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

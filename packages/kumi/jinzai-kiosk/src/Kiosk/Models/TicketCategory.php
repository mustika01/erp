<?php

namespace Kumi\Kiosk\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Kumi\Kiosk\Support\DatabaseTableNames;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketCategory extends Model
{
    public const KEY_SALARY = 'salary';
    public const KEY_SALARY_ADVANCE = 'salary-advance';
    public const KEY_SALARY_INCREASE = 'salary-increase';

    public const KEY_ATTENDANCE = 'attendance';
    public const KEY_LEAVE_REQUEST = 'leave-request';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::TICKET_CATEGORIES;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class);
    }

    public function scopeParents(Builder $builder): Builder
    {
        return $builder->whereNull('parent_id');
    }

    public function scopeWithParent(Builder $builder, ?int $parentId): Builder
    {
        return $parentId ? $builder->where('parent_id', $parentId) : $builder;
    }
}

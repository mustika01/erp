<?php

namespace Kumi\Senzou\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kumi\Senzou\Database\Factories\RequestNoteFactory;
use Kumi\Senzou\Support\DatabaseTableNames;

class RequestNote extends Model
{
    use HasFactory;

    protected $table = DatabaseTableNames::REQUEST_NOTES;

    protected $guarded = [];

    public function scopeStatus(Builder $query, array $statuses): Builder
    {
        return $query->whereIn('status', $statuses);
    }

    public function scopeByVessel(Builder $query, int $vesselID): Builder
    {
        return $query->whereHas('user', function (Builder $builder) use ($vesselID) {
            $builder->where('vessel_id', $vesselID);
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(VesselUser::class, 'vessel_user_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(RequestNoteItem::class);
    }

    public function approved_items(): HasMany
    {
        return $this->hasMany(RequestNoteApproveItem::class);
    }

    public function isApproved(): bool
    {
        return ! is_null($this->getAttribute('approved_at'));
    }

    protected static function newFactory()
    {
        return RequestNoteFactory::new();
    }
}

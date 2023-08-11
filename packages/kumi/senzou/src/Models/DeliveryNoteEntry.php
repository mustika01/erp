<?php

namespace Kumi\Senzou\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kumi\Senzou\Database\Factories\DeliveryNoteEntryFactory;
use Kumi\Senzou\Support\DatabaseTableNames;

class DeliveryNoteEntry extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::DELIVERY_NOTE_ENTRIES;

    protected $guarded = [];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function note(): BelongsTo
    {
        return $this->belongsTo(DeliveryNote::class, 'delivery_note_id');
    }

    public function scopeByVessel(Builder $builder, int $vesselID): Builder
    {
        return $builder->whereHas('note', function (Builder $query) use ($vesselID) {
            return $query->where('vessel_id', $vesselID);
        });
    }

    protected static function newFactory()
    {
        return DeliveryNoteEntryFactory::new();
    }
}

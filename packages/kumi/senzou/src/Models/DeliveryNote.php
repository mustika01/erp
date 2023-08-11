<?php

namespace Kumi\Senzou\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kumi\Senzou\Database\Factories\DeliveryNoteFactory;
use Kumi\Senzou\Support\DatabaseTableNames;
use Kumi\Sousa\Models\Vessel;

class DeliveryNote extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::DELIVERY_NOTES;

    protected $guarded = [];

    protected $casts = [
        'date' => 'date',
        'committed_at' => 'date',
    ];

    public function vessel(): BelongsTo
    {
        return $this->belongsTo(Vessel::class);
    }

    public function entries(): HasMany
    {
        return $this->hasMany(DeliveryNoteEntry::class)->oldest('id');
    }

    public function isCommitted(): bool
    {
        return ! is_null($this->getAttribute('committed_at'));
    }

    protected static function newFactory()
    {
        return DeliveryNoteFactory::new();
    }
}

<?php

namespace Kumi\Senzou\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kumi\Senzou\Database\Factories\RequestNoteItemFactory;
use Kumi\Senzou\Support\DatabaseTableNames;

class RequestNoteItem extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::REQUEST_NOTE_ITEMS;

    protected $guarded = [];

    public function note(): BelongsTo
    {
        return $this->belongsTo(RequestNote::class, 'request_note_id');
    }

    public function isCommitted(): bool
    {
        return ! is_null($this->getAttribute('committed_at'));
    }

    protected static function newFactory()
    {
        return RequestNoteItemFactory::new();
    }
}

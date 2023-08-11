<?php

namespace Kumi\Sousa\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Kumi\Sousa\Support\DatabaseTableNames;

class OilJournalEntry extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::OIL_JOURNAL_ENTRIES;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    public function journal(): BelongsTo
    {
        return $this->belongsTo(OilJournal::class, 'oil_journal_id');
    }

    public function setTotalLitreAttribute($value): void
    {
        $this->attributes['total_litre'] = (float) Str::of($value)->replace(',', '')->toString();
    }
}

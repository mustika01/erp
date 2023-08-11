<?php

namespace Kumi\Sousa\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Kumi\Sousa\Support\DatabaseTableNames;

class BunkerJournalEntry extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::BUNKER_JOURNAL_ENTRIES;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    public function journal(): BelongsTo
    {
        return $this->belongsTo(BunkerJournal::class);
    }

    public function setTotalRefuelAttribute($value): void
    {
        $this->attributes['total_refuel'] = (float) Str::of($value)->replace(',', '')->toString();
    }

    public function setTotalUsageAttribute($value): void
    {
        $this->attributes['total_usage'] = (float) Str::of($value)->replace(',', '')->toString();
    }

    public function setTotalAdjustmentAttribute($value): void
    {
        $this->attributes['total_adjustment'] = (float) Str::of($value)->replace(',', '')->toString();
    }
}

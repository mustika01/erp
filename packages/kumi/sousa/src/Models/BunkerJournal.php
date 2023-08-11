<?php

namespace Kumi\Sousa\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Kumi\Kanshi\Models\Activity;
use Kumi\Kanshi\Traits\InteractsWithNullCauser;
use Kumi\Sousa\Support\DatabaseTableNames;
use Kumi\Sousa\Support\Enums\BunkerJournalEntryType;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class BunkerJournal extends Model
{
    use LogsActivity;
    use InteractsWithNullCauser;

    protected $table = DatabaseTableNames::BUNKER_JOURNALS;

    protected $guarded = [];

    protected $casts = [
        'date' => 'datetime',
        'committed_at' => 'datetime',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(function (string $event) {
                return __('sousa::filament/resources/bunker-journal.events.' . $event);
            })
            ->logAll()
            ->logOnlyDirty()
        ;
    }

    public function tapActivity(Activity $activity, string $event)
    {
        if (self::eventsToBeRecorded()->contains($event)) {
            $activity = $this->handleNullCauser($activity);
        }
    }

    public function bunker(): BelongsTo
    {
        return $this->belongsTo(Bunker::class);
    }

    public function entries(): HasMany
    {
        return $this->hasMany(BunkerJournalEntry::class, 'journal_id')->oldest('id');
    }

    public function getRobAmountFormattedAttribute(): string
    {
        if (! $this->isCommitted()) {
            $qualifiedJournal = $this->getQualifiedJournalBeforeDate($this);

            if ($qualifiedJournal) {
                $journals = $this->getJournalsBetween($qualifiedJournal, $this);
                $journals->shift();

                $rob_amount = $qualifiedJournal->remainder - $journals->sum('real_time_usage') + $journals->sum('refuel');

                return number_format($rob_amount, 3) . ' ℓ';
            }

            return '0.000 ℓ';
        }

        return number_format($this->getAttribute('rob_amount'), 3) . ' ℓ';
    }

    public function getRemainderFormattedAttribute(): string
    {
        if (! $this->isCommitted()) {
            $qualifiedJournal = $this->getQualifiedJournalBeforeDate($this);

            if ($qualifiedJournal) {
                $journals = $this->getJournalsBetween($qualifiedJournal, $this);

                $remainder = $qualifiedJournal->remainder - $journals->sum('real_time_usage') + $journals->sum('refuel');

                return number_format($remainder, 3) . ' ℓ';
            }
        }

        return number_format($this->getAttribute('remainder'), 3) . ' ℓ';
    }

    public function getRefuelAttribute(): float
    {
        return $this->entries->filter(function (BunkerJournalEntry $entry) {
            return $entry->type === BunkerJournalEntryType::REFUEL;
        })->sum('total_refuel');
    }

    public function getRefuelFormattedAttribute(): string
    {
        return number_format($this->getAttribute('refuel'), 3) . ' ℓ';
    }

    public function getRealTimeUsageAttribute(): float
    {
        $totalUsage = $this->entries->filter(function (BunkerJournalEntry $entry) {
            return $entry->type === BunkerJournalEntryType::USAGE;
        })->sum('total_usage');

        $totalAdjustment = $this->entries->filter(function (BunkerJournalEntry $entry) {
            return $entry->type === BunkerJournalEntryType::ADJUSTMENT;
        })->sum('total_adjustment');

        return $totalUsage + $totalAdjustment;
    }

    public function getExpectedUsageAttribute(): float
    {
        $totalUsage = $this->entries->filter(function (BunkerJournalEntry $entry) {
            return $entry->type === BunkerJournalEntryType::USAGE;
        })->sum('total_usage');

        return $totalUsage;
    }

    public function getRealTimeUsageFormattedAttribute(): string
    {
        return number_format($this->getAttribute('real_time_usage'), 3) . ' ℓ';
    }

    public function isCommitted(): bool
    {
        return ! is_null($this->getAttribute('committed_at'));
    }

    public function isEarliestUncommittedJournal(): bool
    {
        $query = $this->bunker->journals()->getQuery();

        $journal = $query
            ->whereNull('committed_at')
            ->orderBy('date')
            ->first()
        ;

        return $journal->is($this);
    }

    public function getQualifiedJournalBeforeDate(self $instance): ?self
    {
        $latestCommittedJournal = self::query()
            ->where('date', '<', $instance->date)
            ->where('bunker_id', $instance->bunker_id)
            ->whereNotNull('committed_at')
            ->latest('date')
            ->first()
        ;

        $oldestUncommittedJournal = self::query()
            ->where('date', '<', $instance->date)
            ->where('bunker_id', $instance->bunker_id)
            ->oldest('date')
            ->first()
        ;

        return $latestCommittedJournal ?: $oldestUncommittedJournal;
    }

    public function getJournalsBetween(self $oldest, self $current): Collection
    {
        return self::query()
            ->where('date', '>', $oldest->date)
            ->where('date', '<=', $current->date)
            ->where('bunker_id', $current->bunker_id)
            ->latest('date')
            ->get()
        ;
    }
}

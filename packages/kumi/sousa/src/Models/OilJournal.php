<?php

namespace Kumi\Sousa\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kumi\Kanshi\Models\Activity;
use Kumi\Kanshi\Traits\InteractsWithNullCauser;
use Kumi\Sousa\Support\DatabaseTableNames;
use Kumi\Sousa\Support\Enums\OilJournalEntryType;
use Kumi\Sousa\Support\Enums\OilJournalOilType;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class OilJournal extends Model
{
    use LogsActivity;
    use InteractsWithNullCauser;

    protected $table = DatabaseTableNames::OIL_JOURNALS;

    protected $guarded = [];

    protected $casts = [
        'date' => 'datetime',
        'committed_at' => 'datetime',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(function (string $event) {
                return __('sousa::filament/resources/bunker-oil.events.' . $event);
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
        return $this->hasMany(OilJournalEntry::class, 'oil_journal_id')->oldest('id');
    }

    public function getTotalUsageType90Attribute(): string
    {
        $totalUsage = $this->entries
            ->filter(function (OilJournalEntry $entry) {
                return $entry->entry_type === OilJournalEntryType::USAGE;
            })
            ->filter(function (OilJournalEntry $entry) {
                return $entry->oil_type === OilJournalOilType::TYPE_90;
            })
            ->sum('total_litre')
        ;

        return $totalUsage;
    }

    public function getTotalUsageType40Attribute(): string
    {
        $totalUsage = $this->entries
            ->filter(function (OilJournalEntry $entry) {
                return $entry->entry_type === OilJournalEntryType::USAGE;
            })
            ->filter(function (OilJournalEntry $entry) {
                return $entry->oil_type === OilJournalOilType::TYPE_40;
            })
            ->sum('total_litre')
        ;

        return $totalUsage;
    }

    public function getTotalUsageType10Attribute(): string
    {
        $totalUsage = $this->entries
            ->filter(function (OilJournalEntry $entry) {
                return $entry->entry_type === OilJournalEntryType::USAGE;
            })
            ->filter(function (OilJournalEntry $entry) {
                return $entry->oil_type === OilJournalOilType::TYPE_10;
            })
            ->sum('total_litre')
        ;

        return $totalUsage;
    }

    public function getRefuelType90Attribute(): float
    {
        return $this->entries
            ->filter(function (OilJournalEntry $entry) {
                return $entry->entry_type === OilJournalEntryType::REFUEL;
            })
            ->filter(function (OilJournalEntry $entry) {
                return $entry->oil_type === OilJournalOilType::TYPE_90;
            })->sum('total_litre');
    }

    public function getRefuelType40Attribute(): float
    {
        return $this->entries
            ->filter(function (OilJournalEntry $entry) {
                return $entry->entry_type === OilJournalEntryType::REFUEL;
            })
            ->filter(function (OilJournalEntry $entry) {
                return $entry->oil_type === OilJournalOilType::TYPE_40;
            })->sum('total_litre');
    }

    public function getRefuelType10Attribute(): float
    {
        return $this->entries
            ->filter(function (OilJournalEntry $entry) {
                return $entry->entry_type === OilJournalEntryType::REFUEL;
            })
            ->filter(function (OilJournalEntry $entry) {
                return $entry->oil_type === OilJournalOilType::TYPE_10;
            })->sum('total_litre');
    }

    public function getType90AmountFormattedAttribute(): string
    {
        return number_format($this->getAttribute('rob_amount_type_90'), 3) . ' ℓ';
    }

    public function getType40AmountFormattedAttribute(): string
    {
        return number_format($this->getAttribute('rob_amount_type_40'), 3) . ' ℓ';
    }

    public function getType10AmountFormattedAttribute(): string
    {
        return number_format($this->getAttribute('rob_amount_type_10'), 3) . ' ℓ';
    }

    public function getTotalUsageType90FormattedAttribute(): string
    {
        return number_format($this->getAttribute('total_usage_type_90'), 3) . ' ℓ';
    }

    public function getTotalUsageType40FormattedAttribute(): string
    {
        return number_format($this->getAttribute('total_usage_type_40'), 3) . ' ℓ';
    }

    public function getTotalUsageType10FormattedAttribute(): string
    {
        return number_format($this->getAttribute('total_usage_type_10'), 3) . ' ℓ';
    }

    public function isCommitted(): bool
    {
        return ! is_null($this->getAttribute('committed_at'));
    }

    public function isEarliestUncommittedJournal(): bool
    {
        $query = $this->bunker->oils()->getQuery();

        $oil = $query
            ->whereNull('committed_at')
            ->orderBy('date')
            ->first()
        ;

        return $oil->is($this);
    }
}

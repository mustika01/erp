<?php

namespace Kumi\Sousa\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Kumi\Kanshi\Models\Activity;
use Kumi\Kanshi\Traits\InteractsWithNullCauser;
use Kumi\Sousa\Database\Factories\BunkerFactory;
use Kumi\Sousa\Support\DatabaseTableNames;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Bunker extends Model
{
    use HasFactory;
    use LogsActivity;
    use InteractsWithNullCauser;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::BUNKERS;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'vessel',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(function (string $event) {
                return __('sousa::filament/resources/bunker.events.' . $event);
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

    public function vessel(): BelongsTo
    {
        return $this->belongsTo(Vessel::class);
    }

    public function engines(): HasMany
    {
        return $this->hasMany(BunkerEngine::class);
    }

    public function formulas(): HasMany
    {
        return $this->hasMany(BunkerFormula::class);
    }

    public function journals(): HasMany
    {
        return $this->hasMany(BunkerJournal::class);
    }

    public function oils(): HasMany
    {
        return $this->hasMany(OilJournal::class);
    }

    public function latestJournal(): HasOne
    {
        return $this->hasOne(BunkerJournal::class)
            ->ofMany([
                'id' => 'MAX',
            ], function (Builder $builder) {
                $builder->whereNotNull('committed_at');
            })
        ;
    }

    public function getLatestJournalDateAttribute(): string
    {
        return $this->latestJournal
            ? $this->latestJournal->date->format('d F Y')
            : 'N/A';
    }

    public function getRobAmountFormattedAttribute(): string
    {
        return number_format($this->getAttribute('rob_amount'), 3) . ' ℓ';
    }

    public function getType90AmountFormattedAttribute(): string
    {
        return number_format($this->getAttribute('type_90_amount'), 3) . ' ℓ';
    }

    public function getType40AmountFormattedAttribute(): string
    {
        return number_format($this->getAttribute('type_40_amount'), 3) . ' ℓ';
    }

    public function getType10AmountFormattedAttribute(): string
    {
        return number_format($this->getAttribute('type_10_amount'), 3) . ' ℓ';
    }

    public function getIsFinalizedAttribute(): bool
    {
        return ! $this
            ->journals()
            ->getQuery()
            ->whereNull('committed_at')
            ->exists()
        ;
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return BunkerFactory::new();
    }
}

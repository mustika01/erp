<?php

namespace Kumi\Sousa\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kumi\Kanshi\Models\Activity;
use Kumi\Kanshi\Traits\InteractsWithNullCauser;
use Kumi\Sousa\Database\Factories\BunkerFormulaFactory;
use Kumi\Sousa\Support\DatabaseTableNames;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class BunkerFormula extends Model
{
    use HasFactory;
    use LogsActivity;
    use InteractsWithNullCauser;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::BUNKER_FORMULAS;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    public function bunker(): BelongsTo
    {
        return $this->belongsTo(Bunker::class);
    }

    public function engine(): BelongsTo
    {
        return $this->belongsTo(BunkerEngine::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(function (string $event) {
                return __('sousa::filament/resources/bunker-formula.events.' . $event);
            })
            ->logAll()
            ->logOnlyDirty()
        ;
    }

    public function tapActivity(Activity $activity, string $event)
    {
        if (self::eventsToBeRecorded()->contains($event)) {
            $activity = $this->handleNullCauser($activity);
            $bunker = $activity->subject->bunker;

            $activity->subject_type = Bunker::class;
            $activity->subject_id = $bunker->id;
        }
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return BunkerFormulaFactory::new();
    }
}

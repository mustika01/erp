<?php

namespace Kumi\Sousa\Models;

use Kumi\Kanshi\Models\Activity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Kumi\Sousa\Support\DatabaseTableNames;
use Spatie\Activitylog\Traits\LogsActivity;
use Kumi\Kanshi\Traits\InteractsWithNullCauser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CargoLog extends Model
{
    use LogsActivity;
    use InteractsWithNullCauser;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::CARGO_LOGS;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'executed_at' => 'datetime',
    ];

    public function voyage(): BelongsTo
    {
        return $this->belongsTo(VesselVoyage::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(function (string $event) {
                return __('sousa::filament/resources/cargo-log.events.' . $event);
            })
            ->logAll()
            ->logOnlyDirty()
        ;
    }

    public function tapActivity(Activity $activity, string $event)
    {
        if (self::eventsToBeRecorded()->contains($event)) {
            $activity = $this->handleNullCauser($activity);
            $voyage = $activity->subject->voyage;

            $activity->subject_type = VesselVoyage::class;
            $activity->subject_id = $voyage->id;
        }
    }

    public function getTonnageAmountFormattedAttribute(): string
    {
        return number_format($this->getAttribute('tonnage_amount'), 2);
    }
}

<?php

namespace Kumi\Norikumi\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kumi\Kanshi\Models\Activity;
use Kumi\Kanshi\Traits\InteractsWithNullCauser;
use Kumi\Norikumi\Support\DatabaseTableNames;
use Kumi\Sousa\Models\Vessel;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Assignment extends Model implements Sortable
{
    use LogsActivity;
    use InteractsWithNullCauser;
    use SortableTrait;

    /**
     * Spatie / Eloquent Sortable configuration.
     *
     * @var array
     */
    public $sortable = [
        'order_column_name' => 'sortable_order',
        'sort_when_creating' => true,
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::ASSIGNMENTS;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'assigned_at' => 'datetime',
        'retracted_at' => 'datetime',
        'sijil_date' => 'datetime',
    ];

    public function crew(): BelongsTo
    {
        return $this->belongsTo(Crew::class);
    }

    public function vessel(): BelongsTo
    {
        return $this->belongsTo(Vessel::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(function (string $event) {
                return __('norikumi::filament/resources/assignment.events.' . $event);
            })
            ->logAll()
            ->logOnlyDirty()
        ;
    }

    public function tapActivity(Activity $activity, string $event)
    {
        if (self::eventsToBeRecorded()->contains($event)) {
            $activity = $this->handleNullCauser($activity);
            $crew = $activity->subject->crew;

            $activity->subject_type = Crew::class;
            $activity->subject_id = $crew->id;
        }
    }

    public function getAssignedAtFormattedAttribute(): string
    {
        $attribute = $this->getAttribute('assigned_at');

        return $attribute ? $attribute->format('d F Y') : 'N/A';
    }

    public function getRetractedAtFormattedAttribute(): string
    {
        $attribute = $this->getAttribute('retracted_at');

        return $attribute ? $attribute->format('d F Y') : 'N/A';
    }

    public function getSijilDateFormattedAttribute(): string
    {
        $attribute = $this->getAttribute('sijil_date');

        return $attribute ? $attribute->format('d F Y') : 'N/A';
    }

    public function getMonthStartedFormattedAttribute(): string
    {
        $attribute = $this->getAttribute('month_started');

        return $attribute ? $attribute->format('F Y') : 'N/A';
    }

    public function getMonthEndedFormattedAttribute(): string
    {
        $attribute = $this->getAttribute('month_ended');

        return $attribute ? $attribute->format('F Y') : 'N/A';
    }
}

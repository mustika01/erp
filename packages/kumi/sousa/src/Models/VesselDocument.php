<?php

namespace Kumi\Sousa\Models;

use Illuminate\Support\Carbon;
use Kumi\Kanshi\Models\Activity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\LogOptions;
use Spatie\EloquentSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Kumi\Sousa\Support\DatabaseTableNames;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;
use Kumi\Kanshi\Traits\InteractsWithNullCauser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kumi\Sousa\Models\VesselDocument\Traits\InteractsWithAttachments;

class VesselDocument extends Model implements HasMedia, Sortable
{
    use InteractsWithMedia;
    use InteractsWithAttachments;
    use SortableTrait;
    use LogsActivity;
    use InteractsWithNullCauser;

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
    protected $table = DatabaseTableNames::VESSEL_DOCUMENTS;

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
        'issued_at' => 'datetime',
        // 'endorsed_at' => 'datetime',
        'endorse_period_started_at' => 'datetime',
        'endorse_period_finished_at' => 'datetime',
        'expired_at' => 'datetime',
        'is_permanent' => 'boolean',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(function (string $event) {
                return __('sousa::filament/resources/vessel-document.events.' . $event);
            })
            ->logAll()
            ->logOnlyDirty()
        ;
    }

    public function tapActivity(Activity $activity, string $event)
    {
        if (self::eventsToBeRecorded()->contains($event)) {
            $activity = $this->handleNullCauser($activity);
            $vessel = $activity->subject->vessel;

            $activity->subject_type = Vessel::class;
            $activity->subject_id = $vessel->id;
        }
    }

    public function buildSortQuery()
    {
        return static::query()->where('vessel_id', $this->vessel_id);
    }

    public function vessel(): BelongsTo
    {
        return $this->belongsTo(Vessel::class);
    }

    public function isActive(): bool
    {
        $expired = $this->getAttribute('expired_at');
        $isPermanent = $this->getAttribute('is_permanent');

        return $isPermanent
            ? true
            : ($expired ? Carbon::now()->diffInDays($expired, false) >= 21 : false);
    }

    public function isExpiringSoon(): bool
    {
        $expired = $this->getAttribute('expired_at');

        return $expired ? Carbon::now()->diffInDays($expired, false) < 21 && $expired->isFuture() : false;
    }

    public function isExpired(): bool
    {
        $expired = $this->getAttribute('expired_at');
        $isPermanent = $this->getAttribute('is_permanent');

        return $isPermanent
            ? false
            : ($expired ? $expired->isPast() || Carbon::now()->diffInHours($expired, false) < 24 : false);
    }
}

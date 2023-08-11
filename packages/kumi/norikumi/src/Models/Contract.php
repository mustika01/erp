<?php

namespace Kumi\Norikumi\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kumi\Kanshi\Models\Activity;
use Kumi\Kanshi\Traits\InteractsWithNullCauser;
use Kumi\Norikumi\Database\Factories\ContractFactory;
use Kumi\Norikumi\Support\DatabaseTableNames;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Contract extends Model
{
    use HasFactory;
    use LogsActivity;
    use InteractsWithNullCauser;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::CONTRACTS;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    public function crew(): BelongsTo
    {
        return $this->belongsTo(Crew::class);
    }

    public function getStartedAtFormattedAttribute(): string
    {
        $attribute = $this->getAttribute('started_at');

        return $attribute ? $attribute->format('d F Y') : 'N/A';
    }

    public function getEndedAtFormattedAttribute(): string
    {
        $attribute = $this->getAttribute('ended_at');

        return $attribute ? $attribute->format('d F Y') : 'N/A';
    }

    public function isExpired(): bool
    {
        return $this->getAttribute('ended_at')->isPast();
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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(function (string $event) {
                return __('norikumi::filament/resources/contract.events.' . $event);
            })
            ->logAll()
            ->logOnlyDirty()
        ;
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return ContractFactory::new();
    }
}

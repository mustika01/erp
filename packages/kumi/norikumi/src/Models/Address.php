<?php

namespace Kumi\Norikumi\Models;

use Kumi\Kanshi\Models\Activity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Kumi\Norikumi\Support\DatabaseTableNames;
use Kumi\Kanshi\Traits\InteractsWithNullCauser;
use Kumi\Norikumi\Database\Factories\AddressFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;
    use LogsActivity;
    use InteractsWithNullCauser;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::ADDRESSES;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    public function crew(): BelongsTo
    {
        return $this->belongsTo(Crew::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(function (string $event) {
                return __('norikumi::filament/resources/address.events.' . $event);
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

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return AddressFactory::new();
    }
}

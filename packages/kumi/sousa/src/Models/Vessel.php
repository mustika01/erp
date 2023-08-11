<?php

namespace Kumi\Sousa\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Kumi\Kanshi\Models\Activity;
use Kumi\Kanshi\Traits\InteractsWithNullCauser;
use Kumi\Norikumi\Models\Assignment;
use Kumi\Sousa\Database\Factories\VesselFactory;
use Kumi\Sousa\Events\Vessel\Created;
use Kumi\Sousa\Models\Vessel\Traits\InteractsWithFeaturedImage;
use Kumi\Sousa\Support\DatabaseTableNames;
use Kumi\Sousa\Support\Enums\VesselStatus;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Vessel extends Model implements HasMedia
{
    use HasFactory;
    use LogsActivity;
    use InteractsWithNullCauser;
    use InteractsWithMedia;
    use InteractsWithFeaturedImage;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::VESSELS;

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => Created::class,
    ];

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'properties' => AsCollection::class,
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'latestTrack',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(function (string $event) {
                return __('sousa::filament/resources/vessel.events.' . $event);
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

    public function tracks(): HasMany
    {
        return $this->hasMany(VesselTrack::class);
    }

    public function latestTrack(): HasOne
    {
        return $this->hasOne(VesselTrack::class)
            ->ofMany([
                'tracking_finished_at' => 'max',
            ])
        ;
    }

    public function documents(): HasMany
    {
        return $this->hasMany(VesselDocument::class);
    }

    public function voyages(): HasMany
    {
        return $this->hasMany(VesselVoyage::class);
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class);
    }

    public function latestVoyage(): HasOne
    {
        return $this->hasOne(VesselVoyage::class)->latestOfMany();
    }

    public function bunker(): HasOne
    {
        return $this->hasOne(Bunker::class);
    }

    public function getLastDockedAtAttribute(): ?string
    {
        $properties = $this->getAttribute('properties');
        $nextDockedDate = $properties['last_docked_at'];

        return isset($nextDockedDate) ? Carbon::parse($nextDockedDate)->format('d F Y') : null;
    }

    public function getNextDockedAtAttribute(): ?string
    {
        $properties = $this->getAttribute('properties');
        $nextDockedDate = $properties['next_docked_at'];

        return isset($nextDockedDate) ? Carbon::parse($nextDockedDate)->format('d F Y') : null;
    }

    public function scopeOperational(Builder $builder): Builder
    {
        return $builder->where('properties->status', VesselStatus::OPERATIONAL);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return VesselFactory::new();
    }
}

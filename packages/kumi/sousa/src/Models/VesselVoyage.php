<?php

namespace Kumi\Sousa\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Kumi\Sousa\Database\Factories\VesselVoyageFactory;
use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\VoyageState;
use Kumi\Sousa\Support\DatabaseTableNames;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\ModelStates\HasStates;

class VesselVoyage extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use LogsActivity;
    use HasStates;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::VESSEL_VOYAGES;

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
        'loading_started_at' => 'datetime',
        'loading_finished_at' => 'datetime',
        'unmoored_at' => 'datetime',
        'departed_at' => 'datetime',
        'arrived_at' => 'datetime',
        'moored_at' => 'datetime',
        'unloading_started_at' => 'datetime',
        'unloading_finished_at' => 'datetime',
        'status' => VoyageState::class,
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(function (string $event) {
                return __('sousa::filament/resources/vessel-voyage.events.' . $event);
            })
            ->logAll()
            ->logOnlyDirty()
        ;
    }

    public function vessel(): BelongsTo
    {
        return $this->belongsTo(Vessel::class);
    }

    public function statuses(): HasMany
    {
        return $this->hasMany(VoyageStatus::class, 'voyage_id');
    }

    public function loadingCargoLogs(): HasMany
    {
        return $this->hasMany(CargoLog::class, 'voyage_id')->where('is_loading', true);
    }

    public function unloadingCargoLogs(): HasMany
    {
        return $this->hasMany(CargoLog::class, 'voyage_id')->where('is_loading', false);
    }

    public function originCity(): BelongsTo
    {
        return $this->belongsTo(VoyageCity::class);
    }

    public function originPort(): BelongsTo
    {
        return $this->belongsTo(VoyagePort::class);
    }

    public function destinationCity(): BelongsTo
    {
        return $this->belongsTo(VoyageCity::class);
    }

    public function destinationPort(): BelongsTo
    {
        return $this->belongsTo(VoyagePort::class);
    }

    public function departedStatus(): HasOne
    {
        return $this->hasOne(VoyageStatus::class, 'voyage_id')->where('description', VoyageState::DEPARTED);
    }

    public function arrivedStatus(): HasOne
    {
        return $this->hasOne(VoyageStatus::class, 'voyage_id')->where('description', VoyageState::ARRIVED);
    }

    public function finishLoadingStatus(): HasOne
    {
        return $this->hasOne(VoyageStatus::class, 'voyage_id')->where('description', VoyageState::FINISH_LOADING);
    }

    public function finishUnloadingStatus(): HasOne
    {
        return $this->hasOne(VoyageStatus::class, 'voyage_id')->where('description', VoyageState::FINISH_UNLOADING);
    }

    public function latestStatus(): HasOne
    {
        return $this->hasOne(VoyageStatus::class, 'voyage_id')->latestOfMany();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('origin_nor')
            ->singleFile()
        ;
        $this->addMediaCollection('origin_sof')
            ->singleFile()
        ;
        $this->addMediaCollection('origin_spb')
            ->singleFile()
        ;
        $this->addMediaCollection('origin_report')
            ->singleFile()
        ;
        $this->addMediaCollection('destination_nor')
            ->singleFile()
        ;
        $this->addMediaCollection('destination_sof')
            ->singleFile()
        ;
        $this->addMediaCollection('destination_spb')
            ->singleFile()
        ;
        $this->addMediaCollection('destination_report')
            ->singleFile()
        ;
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return VesselVoyageFactory::new();
    }
}

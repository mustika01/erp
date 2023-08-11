<?php

namespace Kumi\Norikumi\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kumi\Kanshi\Models\Activity;
use Kumi\Kanshi\Traits\InteractsWithNullCauser;
use Kumi\Norikumi\Database\Factories\IdentityFactory;
use Kumi\Norikumi\Support\DatabaseTableNames;
use Kumi\Norikumi\Support\Enums\IdentityGroup;
use Kumi\Norikumi\Support\Enums\IdentityStatus;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Identity extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use LogsActivity;
    use InteractsWithNullCauser;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::IDENTITIES;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'expired_at' => 'datetime',
    ];

    public function crew(): BelongsTo
    {
        return $this->belongsTo(Crew::class);
    }

    public function isPermanent(): bool
    {
        $attribute = $this->getAttribute('expired_at');

        return is_null($attribute);
    }

    public function isActive(): bool
    {
        $attribute = $this->getAttribute('expired_at');

        return $attribute->isFuture();
    }

    public function isExpired(): bool
    {
        $attribute = $this->getAttribute('expired_at');

        return $attribute->isPast();
    }

    public function getStatusAttribute(): string
    {
        if ($this->isPermanent()) {
            return IdentityStatus::PERMANENT;
        }

        if ($this->isActive()) {
            return IdentityStatus::ACTIVE;
        }

        if ($this->isExpired()) {
            return IdentityStatus::EXPIRED;
        }
    }

    /**
     * @codeCoverageIgnore
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('front-side')
            ->singleFile()
        ;

        $this->addMediaCollection('back-side')
            ->singleFile()
        ;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(function (string $event) {
                return __('norikumi::filament/resources/identity.events.' . $event);
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

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('preview')
            ->width(1024)
            ->height(768)
        ;
    }

    public function scopePersonal(Builder $builder): Builder
    {
        return $builder->where('group', IdentityGroup::PERSONAL);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return IdentityFactory::new();
    }
}

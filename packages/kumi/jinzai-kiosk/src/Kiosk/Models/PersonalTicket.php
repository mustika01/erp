<?php

namespace Kumi\Kiosk\Models;

use Kumi\Jinzai\Models\Employee;
use Kumi\Kanshi\Models\Activity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Kumi\Kiosk\Support\DatabaseTableNames;
use Kumi\Kiosk\Support\Enums\TicketStatus;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;
use Kumi\Kanshi\Traits\InteractsWithNullCauser;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonalTicket extends Model implements HasMedia
{
    use InteractsWithMedia;
    use LogsActivity;
    use InteractsWithNullCauser;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::TICKETS;

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

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function category()
    {
        return $this->belongsTo(TicketCategory::class, 'category_id');
    }

    public function childCategory()
    {
        return $this->belongsTo(TicketCategory::class, 'child_category_id');
    }

    public function grandChildCategory()
    {
        return $this->belongsTo(TicketCategory::class, 'grand_child_category_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('attachments')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif'])
        ;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(function (string $event) {
                return __('kiosk::filament/resources/ticket.events.' . $event);
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

    public function isPending(): bool
    {
        return $this->getAttribute('status') === TicketStatus::PENDING;
    }

    public function isUnderReview(): bool
    {
        return $this->getAttribute('status') === TicketStatus::UNDER_REVIEW;
    }

    public function isApproved(): bool
    {
        return $this->getAttribute('status') === TicketStatus::APPROVED;
    }
}

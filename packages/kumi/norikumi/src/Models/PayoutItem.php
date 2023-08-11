<?php

namespace Kumi\Norikumi\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Kumi\Kanshi\Models\Activity;
use Kumi\Kanshi\Traits\InteractsWithNullCauser;
use Kumi\Norikumi\Support\DatabaseTableNames;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PayoutItem extends Model
{
    use LogsActivity;
    use InteractsWithNullCauser;

    public const TYPE_BASIC = 'basic';
    public const TYPE_INITIAL_ADJUSTMENT = 'initial-adjustment';
    public const TYPE_ADJUSTMENT = 'adjustment';
    public const TYPE_ATTENDANCE = 'attendance';
    public const TYPE_LOAN = 'loan';
    public const TYPE_DEPOSIT_ON_HOLD = 'deposit-on-hold';
    public const TYPE_DEPOSIT_RETURNED = 'deposit-returned';
    public const TYPE_RETRACTED_ADJUSTMENT = 'retracted-adjustment';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::PAYOUT_ITEMS;

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

    public function payout(): BelongsTo
    {
        return $this->belongsTo(Payout::class);
    }

    public function relatable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getAmountFormattedAttribute(): string
    {
        return number_format($this->getAttribute('amount'));
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(function (string $event) {
                return __('jinzai::filament/resources/payout-item.events.' . $event);
            })
            ->logAll()
            ->logOnlyDirty()
        ;
    }

    public function tapActivity(Activity $activity, string $event)
    {
        if (self::eventsToBeRecorded()->contains($event)) {
            $activity = $this->handleNullCauser($activity);
            $payout = $activity->subject->payout;

            $activity->subject_type = Payout::class;
            $activity->subject_id = $payout->id;
        }
    }
}

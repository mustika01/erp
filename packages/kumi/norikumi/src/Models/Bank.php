<?php

namespace Kumi\Norikumi\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kumi\Kanshi\Models\Activity;
use Kumi\Kanshi\Traits\InteractsWithNullCauser;
use Kumi\Norikumi\Database\Factories\BankFactory;
use Kumi\Norikumi\Support\DatabaseTableNames;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Bank extends Model
{
    use HasFactory;
    use LogsActivity;
    use InteractsWithNullCauser;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::BANKS;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    public function payroll(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    public function markAsPrimary(): void
    {
        $this->update([
            'is_primary' => true,
        ]);
    }

    public function markAsSecondary(): void
    {
        $this->update([
            'is_primary' => false,
        ]);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(function (string $event) {
                return __('jinzai::filament/resources/bank.events.' . $event);
            })
            ->logAll()
            ->logOnlyDirty()
        ;
    }

    public function tapActivity(Activity $activity, string $event)
    {
        if (self::eventsToBeRecorded()->contains($event)) {
            $activity = $this->handleNullCauser($activity);
            $payroll = $activity->subject->payroll;

            $activity->subject_type = Payroll::class;
            $activity->subject_id = $payroll->id;
        }
    }

    protected static function newFactory()
    {
        return BankFactory::new();
    }
}

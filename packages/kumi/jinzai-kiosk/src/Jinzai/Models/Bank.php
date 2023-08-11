<?php

namespace Kumi\Jinzai\Models;

use Kumi\Kanshi\Models\Activity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Kumi\Jinzai\Support\DatabaseTableNames;
use Spatie\Activitylog\Traits\LogsActivity;
use Kumi\Jinzai\Database\Factories\BankFactory;
use Kumi\Kanshi\Traits\InteractsWithNullCauser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    protected $table = DatabaseTableNames::BANKS;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    public function payroll(): BelongsTo
    {
        return $this->belongsTo(Payroll::class);
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

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return BankFactory::new();
    }
}

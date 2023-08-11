<?php

namespace Kumi\Jinzai\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Kumi\Jinzai\Database\Factories\EmploymentFactory;
use Kumi\Jinzai\Events\Employment\Updated;
use Kumi\Jinzai\Support\DatabaseTableNames;
use Kumi\Kanshi\Models\Activity;
use Kumi\Kanshi\Traits\InteractsWithNullCauser;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Employment extends Model
{
    use HasFactory;
    use LogsActivity;
    use InteractsWithNullCauser;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::EMPLOYMENTS;

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'updated' => Updated::class,
    ];

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'joined_at' => 'datetime',
        'contract_start_at' => 'datetime',
        'contract_ended_at' => 'datetime',
        'left_at' => 'datetime',
        'resigned_at' => 'datetime',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(JobPosition::class, 'job_position_id');
    }

    public function scopeActive(Builder $builder): Builder
    {
        return $builder
            ->where('contract_ended_at', '>=', Carbon::now())
            ->whereNull('left_at')
            ->whereNull('resigned_at')
        ;
    }

    public function scopeByDepartment(Builder $builder, int $departmentID): Builder
    {
        return $builder->where('department_id', $departmentID);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(function (string $event) {
                return __('jinzai::filament/resources/employment.events.' . $event);
            })
            ->logAll()
            ->logOnlyDirty()
        ;
    }

    public function tapActivity(Activity $activity, string $event)
    {
        if (self::eventsToBeRecorded()->contains($event)) {
            $activity = $this->handleNullCauser($activity);
            $employee = $activity->subject->employee;

            $activity->subject_type = Employee::class;
            $activity->subject_id = $employee->id;
        }
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return EmploymentFactory::new();
    }
}

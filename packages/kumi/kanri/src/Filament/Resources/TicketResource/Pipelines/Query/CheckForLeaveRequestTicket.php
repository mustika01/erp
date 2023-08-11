<?php

namespace Kumi\Kanri\Filament\Resources\TicketResource\Pipelines\Query;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Kumi\Jinzai\Models\Employment;
use Kumi\Kanri\Support\DefaultPermissions;
use Kumi\Kiosk\Models\TicketCategory;
use Kumi\Tobira\Models\User;

class CheckForLeaveRequestTicket
{
    public function handle(Builder $builder, \Closure $next)
    {
        $user = Auth::user();

        $attendance = TicketCategory::query()->where('slug', TicketCategory::KEY_ATTENDANCE)->first();
        $leave = TicketCategory::query()->where('slug', TicketCategory::KEY_LEAVE_REQUEST)->first();

        if ($user->can(DefaultPermissions::VIEW_DEPARTMENT_LEAVE_REQUEST_TICKETS)) {
            $builder
                ->orWhere(function (Builder $query) use ($user, $attendance, $leave) {
                    $query
                        ->whereIn('employee_id', $this->getEmployeesByUserDepartment($user))
                        ->where('category_id', $attendance->id)
                        ->where('child_category_id', $leave->id)
                    ;
                })
            ;
        }

        if ($user->can(DefaultPermissions::VIEW_ANY_LEAVE_REQUEST_TICKETS)) {
            $builder
                ->orWhere(function (Builder $query) use ($attendance, $leave) {
                    $query
                        ->where('category_id', $attendance->id)
                        ->where('child_category_id', $leave->id)
                    ;
                })
            ;
        }

        return $next($builder);
    }

    protected function getEmployeesByUserDepartment(User $user)
    {
        $employment = $user->employee->latestActiveEmployment;
        $department = $employment->department;

        return Employment::query()
            ->active()
            ->where('department_id', $department->id)
            ->pluck('employee_id')
        ;
    }
}

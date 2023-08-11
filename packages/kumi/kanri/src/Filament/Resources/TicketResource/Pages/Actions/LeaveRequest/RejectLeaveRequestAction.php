<?php

namespace Kumi\Kanri\Filament\Resources\TicketResource\Pages\Actions\LeaveRequest;

use Filament\Pages\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Kumi\Kiosk\Models\TicketCategory;
use Illuminate\Database\Eloquent\Model;
use Kumi\Kanri\Support\DefaultPermissions;
use Kumi\Kiosk\Support\Enums\TicketStatus;
use Filament\Support\Actions\Concerns\CanCustomizeProcess;

class RejectLeaveRequestAction extends Action
{
    use CanCustomizeProcess;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('kanri::filament/resources/ticket-leave-request.actions.reject.single.label'));

        $this->modalWidth('sm');

        $this->modalHeading(__('kanri::filament/resources/ticket-leave-request.headings.tickets.reject.label'));

        $this->color('danger');

        $this->requiresConfirmation();

        $this->successNotificationMessage(__('kanri::filament/resources/ticket-leave-request.messages.updated'));

        $this->action(function (): void {
            $this->process(function (Model $record, array $data) {
                $record->status = TicketStatus::REJECTED;
                $record->save();
            });

            $this->success();
        });

        $this->visible(function (?Model $record) {
            $user = Auth::user();
            $userHasActiveEmployment = $user->employee->hasActiveEmployment();
            $employee = $record->employee;
            $employeeHasActiveEmployment = $employee->hasActiveEmployment();

            if (! $userHasActiveEmployment && ! $employeeHasActiveEmployment) {
                return false;
            }

            $salary = TicketCategory::query()->where('slug', TicketCategory::KEY_ATTENDANCE)->first();
            $salaryAdvance = TicketCategory::query()->where('slug', TicketCategory::KEY_LEAVE_REQUEST)->first();
            $userPositionLevel = $user->employee->latestActiveEmployment->position->level;
            $employeePositionLevel = $employee->latestActiveEmployment->position->level;
            $hasSameDepartment = $user->can(DefaultPermissions::REJECT_ANY_LEAVE_REQUEST_TICKET)
                ? true
                : $user->employee->latestActiveEmployment->department_id === $employee->latestActiveEmployment->department_id;

            return is_null($record)
                ? false
                : $userPositionLevel > $employeePositionLevel
                    && $hasSameDepartment
                    && $record->isUnderReview()
                    && $record->category->is($salary)
                    && $record->childCategory->is($salaryAdvance);
        });
    }

    public static function make(?string $name = 'reject_leave_request'): static
    {
        return parent::make($name);
    }
}

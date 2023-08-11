<?php

namespace Kumi\Kanri\Filament\Resources\TicketResource\Pages;

use Filament\Pages\Actions\Action;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\ViewRecord;
use Kumi\Kanri\Support\DefaultPermissions;
use Kumi\Kanri\Filament\Resources\TicketResource;
use Kumi\Kanri\Filament\Resources\TicketResource\Pages\Actions\LeaveRequest\RejectLeaveRequestAction;
use Kumi\Kanri\Filament\Resources\TicketResource\Pages\Actions\LeaveRequest\ReviewLeaveRequestAction;
use Kumi\Kanri\Filament\Resources\TicketResource\Pages\Actions\HumanCapital\RejectSalaryAdvanceAction;
use Kumi\Kanri\Filament\Resources\TicketResource\Pages\Actions\HumanCapital\ReviewSalaryAdvanceAction;
use Kumi\Kanri\Filament\Resources\TicketResource\Pages\Actions\LeaveRequest\ApproveLeaveRequestAction;
use Kumi\Kanri\Filament\Resources\TicketResource\Pages\Actions\HumanCapital\ApproveSalaryAdvanceAction;

class ViewTicket extends ViewRecord
{
    protected static string $resource = TicketResource::class;

    protected function getActions(): array
    {
        $actions = [];

        Collection::make([
            DefaultPermissions::REVIEW_SALARY_ADVANCE_TICKET => $this->getReviewSalaryAdvanceAction(),
            DefaultPermissions::REJECT_SALARY_ADVANCE_TICKET => $this->getRejectSalaryAdvanceAction(),
            DefaultPermissions::APPROVE_SALARY_ADVANCE_TICKET => $this->getApproveSalaryAdvanceAction(),

            DefaultPermissions::REVIEW_LEAVE_REQUEST_TICKET => $this->getReviewLeaveRequestAction(),
            DefaultPermissions::REJECT_DEPARTMENT_LEAVE_REQUEST_TICKET => $this->getRejectLeaveRequestAction(),
            DefaultPermissions::APPROVE_DEPARTMENT_LEAVE_REQUEST_TICKET => $this->getApproveLeaveRequestAction(),
        ])->each(function ($action, $permission) use (&$actions) {
            $user = Auth::user();

            if ($user->can($permission)) {
                $actions[] = $action;
            }
        });

        return array_merge($actions, parent::getActions());
    }

    protected function getReviewSalaryAdvanceAction(): Action
    {
        return ReviewSalaryAdvanceAction::make()
            ->record($this->getRecord())
        ;
    }

    protected function getRejectSalaryAdvanceAction(): Action
    {
        return RejectSalaryAdvanceAction::make()
            ->record($this->getRecord())
        ;
    }

    protected function getApproveSalaryAdvanceAction(): Action
    {
        return ApproveSalaryAdvanceAction::make()
            ->record($this->getRecord())
        ;
    }

    protected function getReviewLeaveRequestAction(): Action
    {
        return ReviewLeaveRequestAction::make()
            ->record($this->getRecord())
        ;
    }

    protected function getRejectLeaveRequestAction(): Action
    {
        return RejectLeaveRequestAction::make()
            ->record($this->getRecord())
        ;
    }

    protected function getApproveLeaveRequestAction(): Action
    {
        return ApproveLeaveRequestAction::make()
            ->record($this->getRecord())
        ;
    }
}

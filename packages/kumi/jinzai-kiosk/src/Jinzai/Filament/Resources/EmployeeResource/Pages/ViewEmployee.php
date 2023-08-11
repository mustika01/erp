<?php

namespace Kumi\Jinzai\Filament\Resources\EmployeeResource\Pages;

use Filament\Facades\Filament;
use Filament\Pages\Actions\Action;
use Illuminate\Support\Collection;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Redirect;
use Kumi\Jinzai\Support\DefaultPermissions;
use Kumi\Jinzai\Actions\GenerateOnboardingLink;
use Kumi\Jinzai\Filament\Resources\PayrollResource;
use Kumi\Jinzai\Filament\Resources\EmployeeResource;

class ViewEmployee extends ViewRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function getActions(): array
    {
        $actions = [];

        Collection::make([
            DefaultPermissions::CREATE_EMPLOYEE_ONBOARDING_LINK => $this->getCreateOnboardingLinkAction(),
            DefaultPermissions::CREATE_PAYROLL => $this->getCreatePayrollAction(),
            DefaultPermissions::VIEW_PAYROLL => $this->getViewPayrollAction(),
        ])->each(function ($action, $permission) use (&$actions) {
            $user = Filament::auth()->user();

            if ($user->can($permission)) {
                $actions[] = $action;
            }
        });

        return array_merge($actions, parent::getActions());
    }

    /**
     * @codeCoverageIgnore
     */
    protected function getCreateOnboardingLinkAction(): Action
    {
        return Action::make('create_onboarding_link')
            ->label(__('jinzai::filament/resources/employee.buttons.create_onboarding_link.label'))
            ->action(function () {
                $record = $this->getRecord();

                GenerateOnboardingLink::run($record);

                Redirect::to(EmployeeResource::getUrl('view', [
                    'record' => $record,
                ]));
            })
            ->color('secondary')
            ->hidden(function () {
                $record = $this->getRecord();

                return $record->hasCreatedOnboardingLink();
            })
        ;
    }

    /**
     * @codeCoverageIgnore
     */
    protected function getCreatePayrollAction(): Action
    {
        return Action::make('create_payroll')
            ->label(__('jinzai::filament/resources/employee.buttons.create_payroll.label'))
            ->url(PayrollResource::getUrl('create', ['employee_id' => $this->getRecord()]))
            ->color('secondary')
            ->visible(function () {
                $record = $this->getRecord();

                return (bool) ! $record->payroll && $record->hasBeenThroughOnboarding();
            })
        ;
    }

    /**
     * @codeCoverageIgnore
     */
    protected function getViewPayrollAction(): Action
    {
        return Action::make('view_payroll')
            ->label(__('jinzai::filament/resources/employee.buttons.view_payroll.label'))
            ->url(function () {
                $record = $this->getRecord();

                if ((bool) $record->payroll) {
                    return PayrollResource::getUrl('view', ['record' => $record->payroll]);
                }

                return '#';
            })
            ->color('secondary')
            ->visible(function () {
                $record = $this->getRecord();

                return (bool) $record->payroll && $record->hasBeenThroughOnboarding();
            })
        ;
    }
}

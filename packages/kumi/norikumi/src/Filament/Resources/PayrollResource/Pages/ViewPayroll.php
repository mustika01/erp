<?php

namespace Kumi\Norikumi\Filament\Resources\PayrollResource\Pages;

use Filament\Resources\Pages\ViewRecord;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Kumi\Norikumi\Filament\Resources\PayrollResource;
use Kumi\Norikumi\Filament\Resources\PayrollResource\Pages\Actions\ActivateAction;
use Kumi\Norikumi\Support\DefaultPermissions;

class ViewPayroll extends ViewRecord
{
    protected static string $resource = PayrollResource::class;

    protected function getActions(): array
    {
        $actions = [];

        Collection::make([
            DefaultPermissions::ACTIVATE_PAYROLL => $this->getActivateAction(),
        ])->each(function ($action, $permission) use (&$actions) {
            $user = Auth::user();

            if ($user->can($permission)) {
                $actions[] = $action;
            }
        });

        return array_merge($actions, parent::getActions());
    }

    protected function getActivateAction()
    {
        return ActivateAction::make()
            ->record($this->getRecord())
        ;
    }
}

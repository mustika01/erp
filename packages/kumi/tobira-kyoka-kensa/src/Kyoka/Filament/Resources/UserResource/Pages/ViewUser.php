<?php

namespace Kumi\Kyoka\Filament\Resources\UserResource\Pages;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Filament\Pages\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Kumi\Kyoka\Support\DefaultPermissions;
use Kumi\Kyoka\Filament\Resources\UserResource;
use Kumi\Kyoka\Filament\Resources\UserResource\Pages\Actions\ActivateAction;
use Kumi\Kyoka\Filament\Resources\UserResource\Pages\Actions\DeactivateAction;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        $actions = [];
        $resource = static::getResource();

        Collection::make([
            DefaultPermissions::ACTIVATE_USER => ActivateAction::make()->record($this->getRecord()),
            DefaultPermissions::DEACTIVATE_USER => DeactivateAction::make()->record($this->getRecord()),
        ])->each(function ($action, $permission) use (&$actions) {
            if (Auth::user()->can($permission)) {
                $actions[] = $action;
            }
        });

        if ($resource::hasPage('edit') && $resource::canEdit($this->getRecord())) {
            $actions[] = EditAction::make();
        }

        return array_merge($actions, parent::getActions());
    }
}

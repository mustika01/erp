<?php

namespace Kumi\Kyoka\Filament\Resources\RoleResource\Pages;

use Filament\Resources\Pages\ViewRecord;
use Kumi\Kyoka\Filament\Resources\RoleResource;
use Kumi\Kyoka\Filament\Resources\RoleResource\Pages\Actions\EditAction;

class ViewRole extends ViewRecord
{
    protected static string $resource = RoleResource::class;

    protected function getActions(): array
    {
        $resource = static::getResource();

        if (! $resource::hasPage('edit')) {
            return [];
        }

        if (! $resource::canEdit($this->getRecord())) {
            return [];
        }

        return [EditAction::make()];
    }
}

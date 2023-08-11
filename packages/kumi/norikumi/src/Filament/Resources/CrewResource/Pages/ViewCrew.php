<?php

namespace Kumi\Norikumi\Filament\Resources\CrewResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;
use Kumi\Norikumi\Filament\Resources\CrewResource;

class ViewCrew extends ViewRecord
{
    protected static string $resource = CrewResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

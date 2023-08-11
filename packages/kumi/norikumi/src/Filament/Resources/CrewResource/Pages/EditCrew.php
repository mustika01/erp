<?php

namespace Kumi\Norikumi\Filament\Resources\CrewResource\Pages;

use Kumi\Norikumi\Filament\Resources\CrewResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCrew extends EditRecord
{
    protected static string $resource = CrewResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

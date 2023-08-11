<?php

namespace Kumi\Norikumi\Filament\Resources\CrewResource\Pages;

use Kumi\Norikumi\Filament\Resources\CrewResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCrews extends ListRecords
{
    protected static string $resource = CrewResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

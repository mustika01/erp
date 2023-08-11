<?php

namespace Kumi\Sousa\Filament\Resources\VesselVoyageResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Kumi\Sousa\Filament\Resources\VesselVoyageResource;

class ListVesselVoyages extends ListRecords
{
    protected static string $resource = VesselVoyageResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

<?php

namespace Kumi\Sousa\Filament\Resources\VesselResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Kumi\Sousa\Filament\Resources\VesselResource;

class ListVessels extends ListRecords
{
    protected static string $resource = VesselResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

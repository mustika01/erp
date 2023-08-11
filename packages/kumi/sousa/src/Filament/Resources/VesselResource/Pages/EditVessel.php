<?php

namespace Kumi\Sousa\Filament\Resources\VesselResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Kumi\Sousa\Filament\Resources\VesselResource;

class EditVessel extends EditRecord
{
    protected static string $resource = VesselResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace Kumi\Sousa\Filament\Resources\VesselDocumentResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Kumi\Sousa\Filament\Resources\VesselDocumentResource;

class EditVesselDocument extends EditRecord
{
    protected static string $resource = VesselDocumentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

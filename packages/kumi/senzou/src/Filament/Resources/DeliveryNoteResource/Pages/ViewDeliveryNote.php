<?php

namespace Kumi\Senzou\Filament\Resources\DeliveryNoteResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;
use Kumi\Senzou\Filament\Resources\DeliveryNoteResource;

class ViewDeliveryNote extends ViewRecord
{
    protected static string $resource = DeliveryNoteResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

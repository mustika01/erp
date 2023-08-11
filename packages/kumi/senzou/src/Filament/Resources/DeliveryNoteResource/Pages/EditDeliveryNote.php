<?php

namespace Kumi\Senzou\Filament\Resources\DeliveryNoteResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Kumi\Senzou\Filament\Resources\DeliveryNoteResource;

class EditDeliveryNote extends EditRecord
{
    protected static string $resource = DeliveryNoteResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

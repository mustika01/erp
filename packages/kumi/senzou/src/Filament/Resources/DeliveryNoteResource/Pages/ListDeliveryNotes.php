<?php

namespace Kumi\Senzou\Filament\Resources\DeliveryNoteResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Kumi\Senzou\Filament\Resources\DeliveryNoteResource;

class ListDeliveryNotes extends ListRecords
{
    protected static string $resource = DeliveryNoteResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

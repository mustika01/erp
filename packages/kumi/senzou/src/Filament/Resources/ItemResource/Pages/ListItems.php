<?php

namespace Kumi\Senzou\Filament\Resources\ItemResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Kumi\Senzou\Filament\Resources\ItemResource;

class ListItems extends ListRecords
{
    protected static string $resource = ItemResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

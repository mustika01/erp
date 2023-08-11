<?php

namespace Kumi\Yoyaku\Filament\Resources\BookableResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Kumi\Yoyaku\Filament\Resources\BookableResource;

class ListBookables extends ListRecords
{
    protected static string $resource = BookableResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->modalWidth('sm')
                ->disableCreateAnother(),
        ];
    }
}

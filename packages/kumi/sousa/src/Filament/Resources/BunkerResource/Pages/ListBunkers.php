<?php

namespace Kumi\Sousa\Filament\Resources\BunkerResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Kumi\Sousa\Filament\Resources\BunkerResource;

class ListBunkers extends ListRecords
{
    protected static string $resource = BunkerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}

<?php

namespace Kumi\Sousa\Filament\Resources\OilJournalResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Kumi\Sousa\Filament\Resources\OilJournalResource;

class ListOilJournals extends ListRecords
{
    protected static string $resource = OilJournalResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->latest();
    }
}

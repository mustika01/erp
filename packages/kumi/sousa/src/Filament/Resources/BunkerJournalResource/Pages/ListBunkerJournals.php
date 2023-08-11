<?php

namespace Kumi\Sousa\Filament\Resources\BunkerJournalResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Kumi\Sousa\Filament\Resources\BunkerJournalResource;
use Kumi\Sousa\Filament\Resources\BunkerResource;

class ListBunkerJournals extends ListRecords
{
    protected static string $resource = BunkerJournalResource::class;

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

    // protected function getBreadcrumbs(): array
    // {
    //     $request = App::make(Request::class);

    //     $breadcrumbs[
    //         BunkerResource::getUrl()
    //     ] = 'Bunkers';

    //     $breadcrumbs[
    //         URL::full() . '#'
    //     ] = 'Sollars';

    //     return $breadcrumbs;
    // }
}

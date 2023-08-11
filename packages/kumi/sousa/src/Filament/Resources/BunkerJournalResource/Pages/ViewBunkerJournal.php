<?php

namespace Kumi\Sousa\Filament\Resources\BunkerJournalResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\URL;
use Kumi\Sousa\Filament\Pages\BunkerJournals;
use Kumi\Sousa\Filament\Resources\BunkerJournalResource;
use Kumi\Sousa\Filament\Resources\BunkerResource;

class ViewBunkerJournal extends ViewRecord
{
    protected static string $resource = BunkerJournalResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getBreadcrumbs(): array
    {
        $breadcrumbs[
            BunkerResource::getUrl()
        ] = 'Bunkers';

        $breadcrumbs[
            BunkerJournals::getUrl(['bunker' => $this->record->bunker])
        ] = 'Solar';

        $breadcrumbs[
            URL::full() . '#'
        ] = 'View';

        return $breadcrumbs;
    }
}

<?php

namespace Kumi\Sousa\Filament\Resources\OilJournalResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\URL;
use Kumi\Sousa\Filament\Pages\OilJournals;
use Kumi\Sousa\Filament\Resources\BunkerResource;
use Kumi\Sousa\Filament\Resources\OilJournalResource;

class ViewOilJournal extends ViewRecord
{
    protected static string $resource = OilJournalResource::class;

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
            OilJournals::getUrl(['bunker' => $this->record->bunker])
        ] = 'Oil';

        $breadcrumbs[
            URL::full() . '#'
        ] = 'View';

        return $breadcrumbs;
    }
}

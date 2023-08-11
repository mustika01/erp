<?php

namespace Kumi\Sousa\Filament\Resources\BunkerJournalResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Kumi\Sousa\Filament\Pages\BunkerJournals;
use Kumi\Sousa\Filament\Resources\BunkerJournalResource;
use Kumi\Sousa\Filament\Resources\BunkerResource;

class EditBunkerJournal extends EditRecord
{
    protected static string $resource = BunkerJournalResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['rob_amount'] = (float) Str::of($data['rob_amount'])->replace(',', '')->toString();
        $data['remainder'] = (float) Str::of($data['remainder'])->replace(',', '')->toString();

        return $data;
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
            URL::current() . '#'
        ] = 'Edit';

        return $breadcrumbs;
    }
}

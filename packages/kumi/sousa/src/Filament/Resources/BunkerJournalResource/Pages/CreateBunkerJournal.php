<?php

namespace Kumi\Sousa\Filament\Resources\BunkerJournalResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Kumi\Sousa\Filament\Pages\BunkerJournals;
use Kumi\Sousa\Filament\Resources\BunkerJournalResource;
use Kumi\Sousa\Filament\Resources\BunkerResource;

class CreateBunkerJournal extends CreateRecord
{
    protected static string $resource = BunkerJournalResource::class;

    protected static bool $canCreateAnother = false;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['rob_amount'] = (float) Str::of($data['rob_amount'])->replace(',', '')->toString();
        $data['remainder'] = (float) Str::of($data['remainder'])->replace(',', '')->toString();

        return $data;
    }

    protected function getBreadcrumbs(): array
    {
        $request = App::make(Request::class);

        if (empty($bunkerID = $request->get('bunker_id'))) {
            return parent::getBreadcrumbs();
        }

        $breadcrumbs[
            BunkerResource::getUrl()
        ] = 'Bunkers';

        $breadcrumbs[
            BunkerJournals::getUrl(['bunker' => $bunkerID])
        ] = 'Solar';

        $breadcrumbs[
            URL::full() . '#'
        ] = 'Create';

        return $breadcrumbs;
    }
}

<?php

namespace Kumi\Sousa\Filament\Resources\OilJournalResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Kumi\Sousa\Filament\Pages\OilJournals;
use Kumi\Sousa\Filament\Resources\BunkerResource;
use Kumi\Sousa\Filament\Resources\OilJournalResource;

class CreateOilJournal extends CreateRecord
{
    protected static string $resource = OilJournalResource::class;

    protected static bool $canCreateAnother = false;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['rob_amount_type_90'] = (float) Str::of($data['rob_amount_type_90'])->replace(',', '')->toString();
        $data['remainder_type_90'] = (float) Str::of($data['remainder_type_90'])->replace(',', '')->toString();
        $data['rob_amount_type_40'] = (float) Str::of($data['rob_amount_type_40'])->replace(',', '')->toString();
        $data['remainder_type_40'] = (float) Str::of($data['remainder_type_40'])->replace(',', '')->toString();
        $data['rob_amount_type_10'] = (float) Str::of($data['rob_amount_type_10'])->replace(',', '')->toString();
        $data['remainder_type_10'] = (float) Str::of($data['remainder_type_10'])->replace(',', '')->toString();

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
            OilJournals::getUrl(['bunker' => $bunkerID])
        ] = 'Oil';

        $breadcrumbs[
            URL::full() . '#'
        ] = 'Create';

        return $breadcrumbs;
    }
}

<?php

namespace Kumi\Sousa\Filament\Resources\OilJournalResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Kumi\Sousa\Filament\Pages\OilJournals;
use Kumi\Sousa\Filament\Resources\BunkerResource;
use Kumi\Sousa\Filament\Resources\OilJournalResource;

class EditOilJournal extends EditRecord
{
    protected static string $resource = OilJournalResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
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
        $breadcrumbs[
            BunkerResource::getUrl()
        ] = 'Bunkers';

        $breadcrumbs[
            OilJournals::getUrl(['bunker' => $this->record->bunker])
        ] = 'Oil';

        $breadcrumbs[
            URL::current() . '#'
        ] = 'Edit';

        return $breadcrumbs;
    }
}

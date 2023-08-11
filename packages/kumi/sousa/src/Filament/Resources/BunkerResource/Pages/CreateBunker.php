<?php

namespace Kumi\Sousa\Filament\Resources\BunkerResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Kumi\Sousa\Filament\Resources\BunkerResource;

class CreateBunker extends CreateRecord
{
    protected static string $resource = BunkerResource::class;

    protected static bool $canCreateAnother = false;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['rob_amount'] = 0;
        $data['type_90_amount'] = 0;
        $data['type_40_amount'] = 0;
        $data['type_10_amount'] = 0;

        return $data;
    }
}

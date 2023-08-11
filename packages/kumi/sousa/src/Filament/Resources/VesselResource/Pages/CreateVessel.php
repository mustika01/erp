<?php

namespace Kumi\Sousa\Filament\Resources\VesselResource\Pages;

use Illuminate\Support\Str;
use Filament\Resources\Pages\CreateRecord;
use Kumi\Sousa\Filament\Resources\VesselResource;

class CreateVessel extends CreateRecord
{
    protected static string $resource = VesselResource::class;

    protected static bool $canCreateAnother = false;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['slug'] = Str::slug($data['name']);

        return $data;
    }
}

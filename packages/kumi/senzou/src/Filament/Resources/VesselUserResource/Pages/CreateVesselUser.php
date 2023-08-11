<?php

namespace Kumi\Senzou\Filament\Resources\VesselUserResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use Kumi\Senzou\Filament\Resources\VesselUserResource;

class CreateVesselUser extends CreateRecord
{
    protected static string $resource = VesselUserResource::class;

    protected static bool $canCreateAnother = false;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['password'] = Hash::make($data['password']);

        return $data;
    }
}

<?php

namespace Kumi\Senzou\Filament\Resources\VesselUserResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;
use Kumi\Senzou\Filament\Resources\VesselUserResource;

class EditVesselUser extends EditRecord
{
    protected static string $resource = VesselUserResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['password'] = Hash::make($data['password']);

        return $data;
    }
}

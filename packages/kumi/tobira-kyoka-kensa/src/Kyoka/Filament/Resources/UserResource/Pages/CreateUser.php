<?php

namespace Kumi\Kyoka\Filament\Resources\UserResource\Pages;

use Illuminate\Support\Facades\Hash;
use Filament\Resources\Pages\CreateRecord;
use Kumi\Kyoka\Filament\Resources\UserResource;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['password'] = Hash::make($data['password']);

        return $data;
    }
}

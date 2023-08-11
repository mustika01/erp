<?php

namespace Kumi\Jinzai\Filament\Resources\EmployeeResource\Pages;

use Kumi\Tobira\Models\User;
use Kumi\Kyoka\Support\DefaultRoles;
use Filament\Resources\Pages\CreateRecord;
use Kumi\Jinzai\Actions\GenerateRandomPassword;
use Kumi\Jinzai\Filament\Resources\EmployeeResource;
use Kumi\Kiosk\Support\DefaultRoles as KioskDefaultRoles;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = $this->handleUserCreation();

        $data['user_id'] = $user->id;

        return $data;
    }

    protected function handleUserCreation(): User
    {
        $data = $this->validate()['data']['user'];
        $data['password'] = GenerateRandomPassword::run();

        $user = User::create($data);
        $user->assignRole(DefaultRoles::FILAMENT_USER);
        $user->assignRole(KioskDefaultRoles::EMPLOYEE);
        $user->markEmailAsVerified();
        $user->markUserAsActive();

        return $user;
    }
}

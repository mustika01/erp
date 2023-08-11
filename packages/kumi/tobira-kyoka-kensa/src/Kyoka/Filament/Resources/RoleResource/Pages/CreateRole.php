<?php

namespace Kumi\Kyoka\Filament\Resources\RoleResource\Pages;

use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use Kumi\Kyoka\Filament\Resources\RoleResource;
use Kumi\Kyoka\Filament\Resources\RoleResource\Traits\InteractsWithRoleFormData;

class CreateRole extends CreateRecord
{
    use InteractsWithRoleFormData;

    protected static string $resource = RoleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return $this->mutateRoleFormData($data);
    }

    protected function handleRecordCreation(array $data): Model
    {
        $model = parent::handleRecordCreation($data);
        $model->syncPermissions($data['permissions']);

        return $model;
    }
}

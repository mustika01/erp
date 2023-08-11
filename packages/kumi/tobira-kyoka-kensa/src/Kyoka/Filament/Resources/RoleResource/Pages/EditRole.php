<?php

namespace Kumi\Kyoka\Filament\Resources\RoleResource\Pages;

use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\EditRecord;
use Kumi\Kyoka\Filament\Resources\RoleResource;
use Kumi\Kyoka\Filament\Resources\RoleResource\Pages\Actions\DeleteAction;
use Kumi\Kyoka\Filament\Resources\RoleResource\Traits\InteractsWithRoleFormData;

class EditRole extends EditRecord
{
    use InteractsWithRoleFormData;

    protected static string $resource = RoleResource::class;

    public function mount($record): void
    {
        static::authorizeResourceAccess();

        $this->record = $this->resolveRecord($record);

        abort_unless($this->record->is_editable, Response::HTTP_FORBIDDEN);
        abort_unless(static::getResource()::canEdit($this->record), Response::HTTP_FORBIDDEN);

        $this->fillForm();
    }

    public function beforeDelete()
    {
        abort_unless($this->record->is_editable, Response::HTTP_FORBIDDEN);
    }

    protected function getActions(): array
    {
        $resource = static::getResource();

        return array_merge(
            (($resource::hasPage('view') && $resource::canView($this->getRecord())) ? [$this->getViewAction()] : []),
            ($resource::canDelete($this->getRecord()) ? [DeleteAction::make()] : []),
        );
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return $this->mutateRoleFormData($data);
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $model = parent::handleRecordUpdate($record, $data);
        $model->syncPermissions($data['permissions']);

        return $model;
    }
}

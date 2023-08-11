<?php

namespace Kumi\Kyoka\Filament\Resources\UserResource\Pages;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Filament\Resources\Pages\EditRecord;
use Kumi\Kyoka\Filament\Resources\UserResource;
use Kumi\Kyoka\Filament\Resources\UserResource\Pages\Actions\DeleteAction;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    public function mount($record): void
    {
        static::authorizeResourceAccess();

        $this->record = $this->resolveRecord($record);

        abort_unless(static::getResource()::canEdit($this->getRecord()), Response::HTTP_FORBIDDEN);
        abort_if(Auth::user()->is($this->getRecord()), Response::HTTP_FORBIDDEN);

        $this->fillForm();
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
        if (is_null($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        return $data;
    }
}

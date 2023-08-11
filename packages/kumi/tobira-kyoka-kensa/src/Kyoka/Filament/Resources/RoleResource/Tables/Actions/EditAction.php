<?php

namespace Kumi\Kyoka\Filament\Resources\RoleResource\Tables\Actions;

use Illuminate\Database\Eloquent\Model;
use Kumi\Kyoka\Filament\Resources\RoleResource;
use Filament\Tables\Actions\EditAction as BaseEditAction;

class EditAction extends BaseEditAction
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->hidden(function (Model $record) {
            $canEdit = RoleResource::canEdit($record);
            $isEditable = $record->is_editable;

            if (! $isEditable) {
                return true;
            }

            return ! $canEdit;
        });
    }
}

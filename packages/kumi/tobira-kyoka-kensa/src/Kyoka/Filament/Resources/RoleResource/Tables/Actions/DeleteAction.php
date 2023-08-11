<?php

namespace Kumi\Kyoka\Filament\Resources\RoleResource\Tables\Actions;

use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Model;
use Kumi\Kyoka\Filament\Resources\RoleResource;
use Filament\Tables\Actions\DeleteAction as BaseDeleteAction;

class DeleteAction extends BaseDeleteAction
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->recordTitle(function (Model $record) {
            return $record->label;
        });

        $this->hidden(function (Model $record) {
            $canDelete = RoleResource::canDelete($record);
            $isEditable = $record->is_editable;

            if (! $isEditable) {
                return true;
            }

            return ! $canDelete;
        });

        $this->action(function (): void {
            $this->process(static function (Model $record) {
                $canDelete = RoleResource::canDelete($record);
                $isEditable = $record->is_editable;

                abort_unless($isEditable && $canDelete, Response::HTTP_FORBIDDEN);

                $record->delete();
            });

            $this->success();
        });
    }
}

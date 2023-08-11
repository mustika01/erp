<?php

namespace Kumi\Kyoka\Filament\Resources\UserResource\Tables\Actions;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Kumi\Kyoka\Filament\Resources\UserResource;
use Filament\Tables\Actions\DeleteAction as BaseDeleteAction;

class DeleteAction extends BaseDeleteAction
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->recordTitle(function (Model $record) {
            return $record->name;
        });

        $this->hidden(function (Model $record) {
            $canDelete = UserResource::canDelete($record);

            return Auth::user()->is($record)
                || ! $canDelete;
        });

        $this->action(function (): void {
            $this->process(static function (Model $record) {
                $canDelete = UserResource::canDelete($record);

                abort_unless($canDelete, Response::HTTP_FORBIDDEN);
                abort_if(Auth::user()->is($record), Response::HTTP_FORBIDDEN);

                $record->delete();
            });

            $this->success();
        });
    }
}

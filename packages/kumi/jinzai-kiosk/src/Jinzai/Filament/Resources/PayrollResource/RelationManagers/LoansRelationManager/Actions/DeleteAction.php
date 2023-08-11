<?php

namespace Kumi\Jinzai\Filament\Resources\PayrollResource\RelationManagers\LoansRelationManager\Actions;

use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\DeleteAction as BaseDeleteAction;

class DeleteAction extends BaseDeleteAction
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->visible(function (Model $record) {
            return ! $record->isApproved()
                || (! $record->isApproved() && $record->isExpired());
        });

        $this->successRedirectUrl(URL::previous());
    }
}

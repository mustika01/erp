<?php

namespace Kumi\Norikumi\Filament\Resources\PayrollResource\RelationManagers\LoansRelationManager\Actions;

use Filament\Tables\Actions\DeleteAction as BaseDeleteAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

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

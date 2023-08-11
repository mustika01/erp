<?php

namespace Kumi\Jinzai\Filament\Resources\PayrollResource\RelationManagers\LoansRelationManager\Actions;

use Closure;
use Illuminate\Support\Facades\URL;
use Livewire\Component as Livewire;
use Filament\Tables\Actions\CreateAction as BaseCreateAction;

class CreateAction extends BaseCreateAction
{
    protected bool|Closure $isCreateAnotherDisabled = true;

    protected function setUp(): void
    {
        parent::setUp();

        $this->hidden(function (Livewire $livewire) {
            return $livewire->getOwnerRecord()->hasPendingLoan()
                || $livewire->getOwnerRecord()->hasActiveLoan();
        });

        $this->successRedirectUrl(URL::previous());
    }
}

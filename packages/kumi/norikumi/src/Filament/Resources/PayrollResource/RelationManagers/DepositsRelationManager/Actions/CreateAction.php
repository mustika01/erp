<?php

namespace Kumi\Norikumi\Filament\Resources\PayrollResource\RelationManagers\DepositsRelationManager\Actions;

use Filament\Tables\Actions\CreateAction as BaseCreateAction;
use Illuminate\Support\Facades\URL;
use Livewire\Component as Livewire;

class CreateAction extends BaseCreateAction
{
    protected bool|\Closure $isCreateAnotherDisabled = true;

    protected function setUp(): void
    {
        parent::setUp();

        $this->hidden(function (Livewire $livewire) {
            return $livewire->getOwnerRecord()->hasActiveDeposit();
        });

        $this->successRedirectUrl(URL::previous());
    }
}

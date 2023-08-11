<?php

namespace Kumi\Norikumi\Filament\Resources\CrewResource\RelationManagers\ContractsRelationManager\Tables\Actions;

use Filament\Tables\Actions\CreateAction as BaseCreateAction;
use Kumi\Norikumi\Events\Contract\Created;
use Livewire\Component as Livewire;

class CreateAction extends BaseCreateAction
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->visible(
            function (Livewire $livewire) {
                $contract = $livewire
                    ->getOwnerRecord()
                    ->contracts()
                    ->getQuery()
                    ->latest()
                    ->first()
                ;

                return is_null($contract)
                    ? true
                    : $contract->ended_at->isPast()
                ;
            }
        );

        $this->after(function ($record) {
            Created::dispatch($record);
        });
    }
}

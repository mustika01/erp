<?php

namespace Kumi\Jinzai\Filament\Resources\PayrollResource\RelationManagers\BanksRelationManager\Actions;

use Kumi\Jinzai\Models\Bank;
use Livewire\Component as Livewire;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\CreateAction as BaseCreateAction;

class CreateAction extends BaseCreateAction
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->disableCreateAnother();

        $this->modalWidth('sm');

        $this->after(function (Model $record, Livewire $livewire) {
            if ($record->is_primary) {
                $ownerRecord = $livewire->getOwnerRecord();
                $ownerRecord
                    ->banks
                    ->reject(function (Bank $bank) use ($record) {
                        return $bank->is($record);
                    })
                    ->each
                    ->markAsSecondary()
                ;
            }
        });
    }
}

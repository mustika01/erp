<?php

namespace Kumi\Norikumi\Filament\Resources\PayrollResource\RelationManagers\BanksRelationManager\Actions;

use Filament\Tables\Actions\EditAction as BaseCreateAction;
use Illuminate\Database\Eloquent\Model;
use Kumi\Norikumi\Models\Bank;
use Livewire\Livewire;

class EditAction extends BaseCreateAction
{
    protected function setUp(): void
    {
        parent::setUp();

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

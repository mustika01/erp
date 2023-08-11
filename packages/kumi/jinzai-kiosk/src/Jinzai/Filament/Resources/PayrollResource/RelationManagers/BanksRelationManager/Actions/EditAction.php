<?php

namespace Kumi\Jinzai\Filament\Resources\PayrollResource\RelationManagers\BanksRelationManager\Actions;

use Filament\Tables\Actions\EditAction as BaseEditAction;
use Illuminate\Database\Eloquent\Model;
use Kumi\Jinzai\Models\Bank;
use Livewire\Component as Livewire;

class EditAction extends BaseEditAction
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

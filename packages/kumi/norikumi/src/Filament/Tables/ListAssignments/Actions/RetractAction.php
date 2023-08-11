<?php

namespace Kumi\Norikumi\Filament\Tables\ListAssignments\Actions;

use Filament\Forms;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Kumi\Norikumi\Events\Assignment\Retracted;
use Kumi\Norikumi\Support\DefaultPermissions;

class RetractAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->modalWidth('sm');

        $this->icon('heroicon-s-x');

        $this->color('danger');

        $this->form([
            Forms\Components\DatePicker::make('retracted_at')
                ->label(__('norikumi::filament/resources/assignment.fields.retracted_at.label'))
                ->displayFormat('d F Y')
                ->closeOnDateSelection()
                ->nullable(),
        ]);

        $this->authorize(function (Model $record) {
            return Auth::user()->can(DefaultPermissions::CREATE_ASSIGNMENT, $record);
        });

        $this->action(function (array $data, Model $record) {
            $record->update([
                'retracted_at' => $data['retracted_at'],
            ]);
        });

        $this->after(function ($record) {
            // dd($record);
            Retracted::dispatch($record);
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'retract';
    }
}

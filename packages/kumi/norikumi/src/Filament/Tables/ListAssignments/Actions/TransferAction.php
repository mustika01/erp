<?php

namespace Kumi\Norikumi\Filament\Tables\ListAssignments\Actions;

use Filament\Forms;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Kumi\Norikumi\Models\Assignment;
use Kumi\Norikumi\Support\DefaultPermissions;
use Kumi\Norikumi\Support\Enums\Position;
use Kumi\Sousa\Models\Vessel;

class TransferAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->color('success');

        $this->form([
            Forms\Components\Grid::make(2)
                ->schema([
                    Forms\Components\Select::make('vessel_id')
                        ->options(function () {
                            return Vessel::query()->orderBy('name')->pluck('name', 'id');
                        })
                        ->preload()
                        ->searchable()
                        ->label(__('norikumi::filament/resources/assignment.fields.vessel.label'))
                        ->required(),
                ])->columnSpan(2),
            Forms\Components\Grid::make(2)
                ->schema([
                    Forms\Components\Select::make('position')
                        ->label(__('norikumi::filament/resources/assignment.fields.position.label'))
                        ->options(self::getPositionOptions())
                        ->required(),
                    Forms\Components\Select::make('grade')
                        ->label(__('norikumi::filament/resources/assignment.fields.grade.label'))
                        ->options([
                            1 => 'I',
                            2 => 'II',
                            3 => 'III',
                            4 => 'IV',
                            5 => 'V',
                        ])
                        ->nullable(),
                    Forms\Components\DatePicker::make('assigned_at')
                        ->label(__('norikumi::filament/resources/assignment.fields.assigned_at.label'))
                        ->displayFormat('d F Y')
                        ->closeOnDateSelection()
                        ->required(),
                ])->columnSpan(2),
        ]);

        $this->authorize(function (Model $record) {
            return Auth::user()->can(DefaultPermissions::CREATE_ASSIGNMENT, $record);
        });

        $this->action(function (array $data, Model $record) {
            $record->update([
                'retracted_at' => $data['assigned_at'],
            ]);

            $data['crew_id'] = $record->crew_id;

            Assignment::create($data);
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'transfer';
    }

    protected static function getPositionOptions(): array
    {
        return [
            Position::NAHKODA => __('norikumi::filament/resources/assignment.fields.position.options.' . Position::NAHKODA),
            Position::MUALIM => __('norikumi::filament/resources/assignment.fields.position.options.' . Position::MUALIM),
            Position::KKM => __('norikumi::filament/resources/assignment.fields.position.options.' . Position::KKM),
            Position::MASINIS => __('norikumi::filament/resources/assignment.fields.position.options.' . Position::MASINIS),
            Position::BOSUN => __('norikumi::filament/resources/assignment.fields.position.options.' . Position::BOSUN),
            Position::KELASI => __('norikumi::filament/resources/assignment.fields.position.options.' . Position::KELASI),
            Position::MANDOR => __('norikumi::filament/resources/assignment.fields.position.options.' . Position::MANDOR),
            Position::JURU_MUDI => __('norikumi::filament/resources/assignment.fields.position.options.' . Position::JURU_MUDI),
            Position::JURU_MINYAK => __('norikumi::filament/resources/assignment.fields.position.options.' . Position::JURU_MINYAK),
            Position::JURU_MASAK => __('norikumi::filament/resources/assignment.fields.position.options.' . Position::JURU_MASAK),
            Position::CADET_DECK => __('norikumi::filament/resources/assignment.fields.position.options.' . Position::CADET_DECK),
            Position::CADET_ENGINE => __('norikumi::filament/resources/assignment.fields.position.options.' . Position::CADET_ENGINE),
            Position::WIPER => __('norikumi::filament/resources/assignment.fields.position.options.' . Position::WIPER),
            Position::CRANE_OPERATOR => __('norikumi::filament/resources/assignment.fields.position.options.' . Position::CRANE_OPERATOR),
        ];
    }
}

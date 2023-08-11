<?php

namespace Kumi\Norikumi\Filament\Pages\ListVesselAssignments\Actions;

use Filament\Forms;
use Filament\Pages\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redirect;
use Kumi\Norikumi\Filament\Pages\ListVesselAssignments;
use Kumi\Norikumi\Models\Assignment;
use Kumi\Norikumi\Models\Crew;
use Kumi\Norikumi\Support\DefaultPermissions;
use Kumi\Norikumi\Support\Enums\Position;

class AssignAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->label('New Assignment');

        $this->icon('heroicon-s-plus');

        $this->form([
            Forms\Components\Grid::make(2)
                ->schema([
                    Forms\Components\Select::make('crew_id')
                        ->options(self::getCrewOptions())
                        ->searchable()
                        ->label(__('norikumi::filament/resources/assignment.fields.crew.label'))
                        ->required(),
                ])->columnSpan(2),
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
        ]);

        $this->authorize(DefaultPermissions::CREATE_ASSIGNMENT);

        $this->action(function (array $data, Model $record) {
            $data['vessel_id'] = $record->id;

            Assignment::create($data);

            return Redirect::to(ListVesselAssignments::getUrl(['vessel' => $record]));
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'assign';
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

    protected static function getCrewOptions(): array
    {
        $results = Crew::query()
            ->orWhere(function (Builder $query) {
                $query->doesntHave('assignments');
            })
            ->orWhere(function (Builder $query) {
                $query->whereDoesntHave('assignments', function ($assignmentQuery) {
                    $assignmentQuery->whereNull('retracted_at');
                });
            })
        ;

        return $results->pluck('name', 'id')->toArray();
    }
}

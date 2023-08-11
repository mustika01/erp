<?php

namespace Kumi\Sousa\Filament\Tables;

use Filament\Tables;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Kumi\Sousa\Filament\Pages\VesselVoyages;
use Kumi\Sousa\Models\Vessel;
use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\VoyageState;
use Livewire\Component;

class ListVesselsToVoyagesTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected $queryString = [
        'tableFilters',
        'tableSortColumn',
        'tableSortDirection',
        'tableSearchQuery' => ['except' => ''],
    ];

    public function render(): View
    {
        return view('sousa::filament.tables.list-vessels-to-voyages');
    }

    protected function getTableQuery(): Builder
    {
        return Vessel::query()->with('latestVoyage');
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->label(__('sousa::filament/resources/vessel.columns.name.label'))
                ->searchable(),
            Tables\Columns\TextColumn::make('origin')
                ->label(__('sousa::filament/resources/vessel-voyage.columns.origin.label'))
                ->formatStateUsing(function (Model $record) {
                    $latestVoyage = $record->latestVoyage;

                    if (! $latestVoyage) {
                        return 'N/A';
                    }

                    $originCity = $latestVoyage->originCity->name;
                    $originPort = $latestVoyage->originPort->name;

                    return "{$originCity} / {$originPort}";
                })
                ->description(function (Model $record) {
                    $voyage = $record->latestVoyage;

                    if (! $voyage) {
                        return 'N/A';
                    }

                    $status = $voyage->departedStatus;

                    return $status ? $status->executed_at->format('d F Y') : 'N/A';
                }),
            Tables\Columns\TextColumn::make('destination')
                ->label(__('sousa::filament/resources/vessel-voyage.columns.destination.label'))
                ->formatStateUsing(function (Model $record) {
                    $latestVoyage = $record->latestVoyage;

                    if (! $latestVoyage) {
                        return 'N/A';
                    }

                    $destinationCity = $latestVoyage->destinationCity->name;
                    $destinationPort = $latestVoyage->destinationPort->name;

                    return "{$destinationCity} / {$destinationPort}";
                })
                ->description(function (Model $record) {
                    $voyage = $record->latestVoyage;

                    if (! $voyage) {
                        return 'N/A';
                    }

                    $status = $voyage->arrivedStatus;

                    return $status ? $status->executed_at->format('d F Y') : 'N/A';
                }),
            Tables\Columns\BadgeColumn::make('latestVoyage.status')
                ->label(__('sousa::filament/resources/vessel-voyage.columns.status.label'))
                ->formatStateUsing(function (?VoyageState $state) {
                    if (is_null($state)) {
                        return 'N/A';
                    }

                    return __('sousa::filament/resources/vessel-voyage.columns.status.options.' . $state->status());
                })
                ->colors([
                    'secondary',
                    'primary' => static function (?VoyageState $state) {
                        if (is_null($state)) {
                            return false;
                        }

                        return $state->status() === VoyageState::START_LOADING || $state->status() === VoyageState::FINISH_LOADING;
                    },
                    'success' => static function (?VoyageState $state) {
                        if (is_null($state)) {
                            return false;
                        }

                        return $state->status() === VoyageState::START_UNLOADING || $state->status() === VoyageState::FINISH_UNLOADING;
                    },
                    'warning' => static function (?VoyageState $state) {
                        if (is_null($state)) {
                            return false;
                        }

                        return $state->status() === VoyageState::UNMOORED || $state->status() === VoyageState::DEPARTED || $state->status() === VoyageState::ARRIVED || $state->status() === VoyageState::MOORED;
                    },
                ]),
        ];
    }

    protected function getTableRecordUrlUsing(): \Closure
    {
        return fn (Model $record): string => VesselVoyages::getUrl(['vessel' => $record]);
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}

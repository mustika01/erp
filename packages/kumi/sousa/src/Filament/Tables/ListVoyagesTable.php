<?php

namespace Kumi\Sousa\Filament\Tables;

use Filament\Tables;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kumi\Sousa\Filament\Resources\VesselVoyageResource;
use Kumi\Sousa\Filament\Resources\VesselVoyageResource\Tables\Actions as TableActions;
use Kumi\Sousa\Models\Vessel;
use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\VoyageState;
use Kumi\Sousa\Support\DatabaseTableNames;
use Livewire\Component;

class ListVoyagesTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    public Vessel $vessel;

    protected $queryString = [
        'tableFilters',
        'tableSortColumn',
        'tableSortDirection',
        'tableSearchQuery' => ['except' => ''],
    ];

    public function render(): View
    {
        return view('sousa::filament.tables.list-voyages');
    }

    protected function getTableQuery(): Builder
    {
        $voyageTable = DatabaseTableNames::VESSEL_VOYAGES;
        $statusTable = DatabaseTableNames::VOYAGE_STATUSES;

        return $this->vessel->voyages()->getQuery()
            ->leftJoin($statusTable, "{$voyageTable}.id", '=', "{$statusTable}.voyage_id")
            ->select("{$voyageTable}.*", DB::raw("MAX({$statusTable}.executed_at) as loading_executed_at"))
            ->groupBy("{$voyageTable}.id")
            ->orderByRaw('loading_executed_at DESC')
        ;
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('number')
                ->label(__('sousa::filament/resources/vessel-voyage.columns.number.label'))
                ->description(function (Model $record) {
                    return $record->cargo_content;
                })
                ->wrap()
                ->alignCenter(),
            Tables\Columns\TextColumn::make('originCity.name')
                ->label(__('sousa::filament/resources/vessel-voyage.columns.origin.label'))
                ->formatStateUsing(function (Model $record) {
                    $city = $record->originCity->name;
                    $port = $record->originPort->name;

                    return "{$city} / {$port}";
                })
                ->description(function (Model $record) {
                    $finishLoadingStatus = $record->finishLoadingStatus;

                    return $finishLoadingStatus ? $finishLoadingStatus->executed_at->format('d F Y') : 'N/A';
                })
                ->searchable(query: function (Builder $query, string $search): Builder {
                    return $query->orWhereHas('originCity', function (Builder $builder) use ($search) {
                        return $builder->where('name', 'ILIKE', "%{$search}%");
                    })->orWhereHas('originPort', function (Builder $builder) use ($search) {
                        return $builder->where('name', 'ILIKE', "%{$search}%");
                    });
                }),
            Tables\Columns\TextColumn::make('destinationCity.name')
                ->label(__('sousa::filament/resources/vessel-voyage.columns.destination.label'))
                ->formatStateUsing(function (Model $record) {
                    $city = $record->destinationCity->name;
                    $port = $record->destinationPort->name;

                    return "{$city} / {$port}";
                })
                ->description(function (Model $record) {
                    $finishUnloadingStatus = $record->finishUnloadingStatus;

                    return $finishUnloadingStatus ? $finishUnloadingStatus->executed_at->format('d F Y') : 'N/A';
                })
                ->searchable(query: function (Builder $query, string $search): Builder {
                    return $query->orWhereHas('destinationCity', function (Builder $builder) use ($search) {
                        return $builder->where('name', 'ILIKE', "%{$search}%");
                    })->orWhereHas('destinationPort', function (Builder $builder) use ($search) {
                        return $builder->where('name', 'ILIKE', "%{$search}%");
                    });
                }),
            Tables\Columns\BadgeColumn::make('status')
                ->label(__('sousa::filament/resources/vessel-voyage.columns.status.label'))
                ->formatStateUsing(function (VoyageState $state) {
                    return __('sousa::filament/resources/vessel-voyage.columns.status.options.' . $state->status());
                })
                ->colors([
                    'secondary',
                    'primary' => static fn (VoyageState $state) => $state->status() === VoyageState::START_LOADING || $state->status() === VoyageState::FINISH_LOADING,
                    'success' => static fn (VoyageState $state) => $state->status() === VoyageState::START_UNLOADING || $state->status() === VoyageState::FINISH_UNLOADING,
                    'warning' => static fn (VoyageState $state) => $state->status() === VoyageState::UNMOORED || $state->status() === VoyageState::DEPARTED || $state->status() === VoyageState::ARRIVED || $state->status() === VoyageState::MOORED,
                    'bg-pink-200 text-pink-900' => static fn (VoyageState $state) => $state->status() === VoyageState::CONDITIONAL_DEPARTURE || $state->status() === VoyageState::CONDITIONAL_ARRIVAL,
                ]),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\ViewAction::make()
                ->url(function (Model $record) {
                    return VesselVoyageResource::getUrl('view', ['record' => $record]);
                })
                ->authorize(function (Model $record) {
                    return VesselVoyageResource::canView($record);
                }),

            TableActions\PreviewStatusesVoyageAction::make(),
            TableActions\DownloadStatusesVoyageAction::make(),
            Tables\Actions\EditAction::make()
                ->url(function (Model $record) {
                    return VesselVoyageResource::getUrl('edit', ['record' => $record]);
                })
                ->authorize(function (Model $record) {
                    return VesselVoyageResource::canEdit($record);
                }),
            Tables\Actions\DeleteAction::make()
                ->authorize(function (Model $record) {
                    return VesselVoyageResource::canDelete($record);
                }),
        ];
    }

    protected function getTableRecordUrlUsing(): \Closure
    {
        return fn (Model $record): string => VesselVoyageResource::getUrl('view', ['record' => $record]);
    }
}

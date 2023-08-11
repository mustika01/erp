<?php

namespace Kumi\Sousa\Filament\Resources\VesselResource\RelationManagers;

use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;
use Kumi\Sousa\Filament\Resources\VesselVoyageResource;
use Kumi\Sousa\Filament\Resources\VesselVoyageResource\Tables\Actions\DownloadStatusesVoyageAction;
use Kumi\Sousa\Filament\Resources\VesselVoyageResource\Tables\Actions\PreviewStatusesVoyageAction;
use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\VoyageState;
use Kumi\Sousa\Support\DatabaseTableNames;
use Livewire\Component as Livewire;

class VoyagesRelationManager extends RelationManager
{
    protected static string $relationship = 'voyages';

    protected static ?string $recordTitleAttribute = '';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
                    ]),
            ])
            ->filters([
                SelectFilter::make('vessel_id')
                    ->relationship('vessel', 'name')
                    ->label(__('sousa::filament/resources/vessel-voyage.filters.vessel_id.label'))
                    ->searchable(),
                TernaryFilter::make('is_returning')
                    ->label(__('sousa::filament/resources/vessel-voyage.filters.is_returning.label')),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->url(function (Livewire $livewire) {
                        $ownerRecord = $livewire->getOwnerRecord();

                        return VesselVoyageResource::getUrl('create', ['vessel_id' => $ownerRecord->id]);
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->url(function (Model $record) {
                        return VesselVoyageResource::getUrl('view', ['record' => $record->id]);
                    }),
                PreviewStatusesVoyageAction::make(),
                DownloadStatusesVoyageAction::make(),
                Tables\Actions\EditAction::make()
                    ->url(function (Model $record) {
                        return VesselVoyageResource::getUrl('edit', ['record' => $record->id]);
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
        ;
    }

    protected function getTableQuery(): Builder|Relation
    {
        $voyageTable = DatabaseTableNames::VESSEL_VOYAGES;
        $statusTable = DatabaseTableNames::VOYAGE_STATUSES;

        return parent::getTableQuery()
            ->join($statusTable, "{$voyageTable}.id", '=', "{$statusTable}.voyage_id")
            ->select("{$voyageTable}.*", DB::raw("MAX({$statusTable}.executed_at) as loading_executed_at"))
            ->groupBy("{$voyageTable}.id")
            ->orderByRaw('loading_executed_at DESC')
        ;
    }
}

<?php

namespace Kumi\Sousa\Filament\Resources\BunkerJournalResource\Traits;

use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Kumi\Sousa\Models\Bunker;
use Kumi\Sousa\Support\DatabaseTableNames;

trait InteractsWithBunkerJournalSchema
{
    protected static function getSchemaForTableColumns(bool $showVessel = true): array
    {
        return [
            Tables\Columns\TextColumn::make('bunker.vessel.name')
                ->label(__('sousa::filament/resources/bunker-journal.columns.vessel.label'))
                ->visible($showVessel)
                ->searchable($showVessel),
            Tables\Columns\TextColumn::make('date')
                ->label(__('sousa::filament/resources/bunker-journal.columns.date.label'))
                ->formatStateUsing(function (Carbon $state) {
                    return $state->format('d F Y');
                }),
            Tables\Columns\TextColumn::make('rob_amount_formatted')
                ->label(__('sousa::filament/resources/bunker-journal.columns.rob_amount_formatted.label')),
            Tables\Columns\TextColumn::make('real_time_usage_formatted')
                ->label(__('sousa::filament/resources/bunker-journal.columns.real_time_usage_formatted.label')),
            Tables\Columns\TextColumn::make('remainder_formatted')
                ->label(__('sousa::filament/resources/bunker-journal.columns.remainder_formatted.label')),
            Tables\Columns\BadgeColumn::make('status')
                ->label(__('sousa::filament/resources/bunker-journal.columns.status.label'))
                ->formatStateUsing(function (Model $record) {
                    return $record->isCommitted()
                        ? __('sousa::filament/resources/bunker-journal.columns.status.states.committed')
                        : __('sousa::filament/resources/bunker-journal.columns.status.states.draft');
                })
                ->colors(function (Model $record) {
                    return [
                        'secondary',
                        'success' => function () use ($record): bool {
                            return $record->isCommitted();
                        },
                    ];
                }),
        ];
    }

    protected static function getSchemaForTableFilters(bool $showVessel = true): array
    {
        return [
            SelectFilter::make('bunker_id')
                ->label(__('sousa::filament/resources/bunker-journal.filters.bunker_id.label'))
                ->options(function () {
                    $vesselTable = DatabaseTableNames::VESSELS;
                    $bunkerTable = DatabaseTableNames::BUNKERS;

                    $query = Bunker::query()
                        ->join($vesselTable, "{$bunkerTable}.vessel_id", '=', "{$vesselTable}.id")
                        ->select("{$vesselTable}.name as name", "{$bunkerTable}.id as id")
                        ->limit(50)
                    ;

                    return $query->pluck('name', 'id');
                })
                ->visible($showVessel)
                ->searchable(),
            Filter::make('period')
                ->form([
                    Forms\Components\Select::make('year')
                        ->options(function () {
                            $options = Collection::make();

                            $start = Carbon::parse('2022-01-01');

                            while ($start->isBefore(Carbon::now())) {
                                $options->push($start->format('Y'));
                                $start->addYear();
                            }

                            return $options->mapWithKeys(function ($value) {
                                return [$value => $value];
                            });
                        })
                        ->default(Carbon::now()->format('Y'))
                        ->required(),
                    Forms\Components\Select::make('month')
                        ->options(function () {
                            $options = Collection::make();

                            $start = Carbon::parse('2022-01-01');
                            $end = $start->copy()->endOfYear()->endOfMonth()->endOfDay();

                            while ($start->isBefore($end)) {
                                $options->push([
                                    'id' => $start->format('m'),
                                    'label' => $start->format('F'),
                                ]);
                                $start->addMonth();
                            }

                            return $options->mapWithKeys(function ($value) {
                                return [$value['id'] => $value['label']];
                            });
                        })
                        ->default(Carbon::now()->format('m'))
                        ->required(),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->whereMonth('date', $data['month'])
                        ->whereYear('date', $data['year'])
                    ;
                }),
        ];
    }
}

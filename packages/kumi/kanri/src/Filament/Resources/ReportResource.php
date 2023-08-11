<?php

namespace Kumi\Kanri\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Kumi\Kanri\Actions\GenerateAuthorizedReportableType;
use Kumi\Kanri\Actions\GenerateReportableTypeOptions;
use Kumi\Kanri\Filament\Resources\ReportResource\Pages;
use Kumi\Kanri\Filament\Resources\ReportResource\Table\Actions as TableActions;
use Kumi\Kanri\Models\Report;

class ReportResource extends Resource
{
    protected static ?string $modelLabel = 'Report';

    protected static ?string $model = Report::class;

    protected static ?string $navigationGroup = 'kanri';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 8002;

    protected static ?string $slug = 'kanri/reports';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('reportable_type')
                ->label(__('kanri::filament/resources/report.fields.reportable_type.label'))
                ->options(self::getReportableOptions())
                ->reactive()
                ->required(),

            Forms\Components\Grid::make()
                ->schema([
                    Forms\Components\Select::make('year')
                        ->options(function () {
                            $options = Collection::make();

                            $start = Carbon::parse('2022-01-01');

                            while ($start->isBefore(Carbon::now()->addYear())) {
                                $options->push($start->format('Y'));
                                $start->addYear();
                            }

                            return $options->mapWithKeys(function ($value) {
                                return [$value => $value];
                            });
                        })
                        ->default(Carbon::now()->format('Y'))
                        ->required()
                        ->visible(function (\Closure $get) {
                            $type = $get('reportable_type');

                            return ! empty($type) && in_array($type, [
                                \Kumi\Jinzai\Models\Payout::class,
                                \Kumi\Sousa\Models\VesselVoyage::class,
                                'docking-schedule',
                            ]);
                        }),

                    Forms\Components\Select::make('month')
                        ->options(function () {
                            $options = Collection::make();

                            $start = Carbon::parse('2022-01-01');
                            $end = $start->copy()->endOfYear()->endOfMonth()->endOfDay();

                            while ($start->isBefore($end)) {
                                $options->push($start->format('F'));
                                $start->addMonth();
                            }

                            return $options->mapWithKeys(function ($value) {
                                return [$value => $value];
                            });
                        })
                        ->default(Carbon::now()->format('F'))
                        ->required()
                        ->visible(function (\Closure $get) {
                            $type = $get('reportable_type');

                            return ! empty($type) && in_array($type, [
                                \Kumi\Jinzai\Models\Payout::class,
                                \Kumi\Sousa\Models\VesselVoyage::class,
                            ]);
                        }),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reportable_type')
                    ->label(__('kanri::filament/resources/report.columns.reportable_type.label'))
                    ->formatStateUsing(function (string $state) {
                        return __('kanri::filament/resources/report.columns.reportable_type.options.' . $state);
                    }),
                Tables\Columns\TextColumn::make('start_date')
                    ->label(__('kanri::filament/resources/report.columns.start_date.label')),
                Tables\Columns\TextColumn::make('final_date')
                    ->label(__('kanri::filament/resources/report.columns.final_date.label')),
                Tables\Columns\TextColumn::make('owner.name')
                    ->label(__('kanri::filament/resources/report.columns.owner.label')),
            ])
            ->filters([
            ])
            ->actions([
                TableActions\ViewAction::make(),
                TableActions\DownloadAction::make(),
            ])
            ->bulkActions([
            ])
        ;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageReports::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $collection = GenerateAuthorizedReportableType::run();

        return parent::getEloquentQuery()->whereIn('reportable_type', $collection);
    }

    protected static function getReportableOptions(): array
    {
        $collection = GenerateReportableTypeOptions::run();

        return $collection->mapWithKeys(function ($type) {
            return [
                $type => __('kanri::filament/resources/report.fields.reportable_type.options.' . $type),
            ];
        })->toArray();
    }
}

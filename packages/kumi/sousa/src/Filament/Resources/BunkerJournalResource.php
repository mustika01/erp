<?php

namespace Kumi\Sousa\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Kumi\Senzou\Filament\Resources\DeliveryNoteResource\Tables\Actions as TableActions;
use Kumi\Sousa\Filament\Resources\BunkerJournalResource\Actions\CalculateFuelConsumption;
use Kumi\Sousa\Filament\Resources\BunkerJournalResource\Actions\CalculateFuelRemainder;
use Kumi\Sousa\Filament\Resources\BunkerJournalResource\Actions\CalculateFuelTotalUsage;
use Kumi\Sousa\Filament\Resources\BunkerJournalResource\Pages;
use Kumi\Sousa\Filament\Resources\BunkerJournalResource\Traits\InteractsWithBunkerJournalSchema;
use Kumi\Sousa\Models\Bunker;
use Kumi\Sousa\Models\BunkerEngine;
use Kumi\Sousa\Models\BunkerFormula;
use Kumi\Sousa\Models\BunkerJournal;
use Kumi\Sousa\Support\DatabaseTableNames;
use Kumi\Sousa\Support\Enums\BunkerJournalEntryType;

class BunkerJournalResource extends Resource
{
    use InteractsWithBunkerJournalSchema;

    protected static ?string $model = BunkerJournal::class;

    protected static ?string $modelLabel = 'Journal';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'sousa';

    protected static ?string $slug = 'sousa/solar-journals';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\Group::make([
                        Forms\Components\Select::make('bunker_id')
                            ->label(__('sousa::filament/resources/bunker-journal.fields.bunker_id.label'))
                            ->reactive()
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
                            ->default(function (Request $request) {
                                $bunker = Bunker::query()->firstWhere('id', $request->get('bunker_id'));

                                return $bunker ? $request->get('bunker_id') : null;
                            })
                            ->disabled(function (Request $request) {
                                $bunker = Bunker::query()->firstWhere('id', $request->get('bunker_id'));

                                return $bunker ? true : false;
                            })
                            ->searchable()
                            ->required()
                            ->afterStateUpdated(function (?string $state, \Closure $set) {
                                if (is_null($state) || empty($state)) {
                                    $set('rob_amount', null);
                                    $set('remainder', null);
                                    $set('entries.*.hourly_consumption', null);
                                    $set('entries.*.time_started_at', null);
                                    $set('entries.*.time_finished_at', null);
                                    $set('entries.*.total_minutes', null);
                                    $set('entries.*.total_usage', null);
                                    $set('entries.*.total_refuel', null);
                                    $set('entries.*.total_adjustment', null);

                                    return;
                                }

                                $bunker = Bunker::find($state);

                                $set('rob_amount', $bunker->rob_amount);
                            }),
                        Forms\Components\DatePicker::make('date')
                            ->label(__('sousa::filament/resources/bunker-journal.fields.date.label'))
                            ->displayFormat('d F Y')
                            ->closeOnDateSelection()
                            ->reactive()
                            ->required(),
                    ]),
                    Forms\Components\Textarea::make('description')
                        ->label(__('sousa::filament/resources/bunker-journal.fields.description.label'))
                        ->rows(4)
                        ->nullable()
                        ->extraInputAttributes([
                            'style' => 'height: 132px',
                        ]),
                ])
                    ->columns(2)
                    ->columnSpan(2),
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make('rob_amount')
                        ->label(__('sousa::filament/resources/bunker-journal.fields.rob_amount.label'))
                        ->reactive()
                        ->default(function (Request $request) {
                            $bunker = Bunker::query()->firstWhere('id', $request->get('bunker_id'));

                            return $bunker ? $bunker->rob_amount : null;
                        })
                        ->disabled()
                        ->suffix('ℓ'),
                    Forms\Components\TextInput::make('total_usage')
                        ->label(__('sousa::filament/resources/bunker-journal.fields.total_usage.label'))
                        ->dehydrated(false)
                        ->reactive()
                        ->disabled()
                        ->suffix('ℓ')
                        ->afterStateHydrated(function (TextInput $component, \Closure $get, ?Model $record) {
                            $entries = $get('entries');

                            if ($record && is_null($entries)) {
                                $totalUsage = $record->entries->sum('total_usage');

                                $component->state(number_format($totalUsage, 3));
                            }
                        }),
                    Forms\Components\TextInput::make('remainder')
                        ->label(__('sousa::filament/resources/bunker-journal.fields.remainder.label'))
                        ->reactive()
                        ->disabled()
                        ->suffix('ℓ'),
                ])->columnSpan(1),
                Forms\Components\Repeater::make('entries')
                    ->relationship('entries')
                    ->disableLabel()
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Grid::make(4)
                                    ->schema([
                                        Forms\Components\Select::make('type')
                                            ->disableLabel()
                                            ->reactive()
                                            ->options([
                                                BunkerJournalEntryType::USAGE => __('sousa::filament/resources/bunker-journal-entry.fields.type.options.' . BunkerJournalEntryType::USAGE),
                                                BunkerJournalEntryType::REFUEL => __('sousa::filament/resources/bunker-journal-entry.fields.type.options.' . BunkerJournalEntryType::REFUEL),
                                                BunkerJournalEntryType::ADJUSTMENT => __('sousa::filament/resources/bunker-journal-entry.fields.type.options.' . BunkerJournalEntryType::ADJUSTMENT),
                                            ])
                                            ->default(BunkerJournalEntryType::USAGE)
                                            ->disabled(function (\Closure $get) {
                                                $bunkerId = $get('../../bunker_id');

                                                return is_null($bunkerId) || empty($bunkerId);
                                            })
                                            ->required()
                                            ->disablePlaceholderSelection()
                                            ->afterStateUpdated(function (\Closure $set) {
                                                $set('engine', null);
                                                $set('formula', null);
                                                $set('hourly_consumption', null);
                                                $set('time_started_at', null);
                                                $set('time_finished_at', null);
                                                $set('total_minutes', null);
                                                $set('total_usage', null);
                                                $set('total_refuel', null);
                                                $set('total_adjustment', null);
                                                $set('../../total_usage', null);
                                            }),
                                        Forms\Components\Select::make('engine')
                                            ->disableLabel()
                                            ->reactive()
                                            ->options(function (\Closure $get) {
                                                $bunkerId = $get('../../bunker_id');

                                                $bunker = Bunker::find($bunkerId);

                                                if (! $bunker) {
                                                    return [];
                                                }

                                                return $bunker->engines()->pluck('label', 'label');
                                            })
                                            ->disabled(function (\Closure $get) {
                                                $bunkerId = $get('../../bunker_id');
                                                $type = $get('type');

                                                $bunkerIsEmpty = is_null($bunkerId) || empty($bunkerId);
                                                $typeIsReFuel = $type === BunkerJournalEntryType::REFUEL;
                                                $typeIsAdjustment = $type === BunkerJournalEntryType::ADJUSTMENT;

                                                return $bunkerIsEmpty || $typeIsReFuel || $typeIsAdjustment;
                                            })
                                            ->nullable()
                                            ->afterStateUpdated(function (\Closure $set) {
                                                $set('formula', null);
                                                $set('hourly_consumption', null);
                                                $set('time_started_at', null);
                                                $set('time_finished_at', null);
                                                $set('total_minutes', null);
                                                $set('total_usage', null);
                                                $set('total_refuel', null);
                                                $set('total_adjustment', null);
                                                $set('../../total_usage', null);
                                            }),
                                        Forms\Components\Select::make('formula')
                                            ->disableLabel()
                                            ->reactive()
                                            ->options(function (\Closure $get) {
                                                $bunkerId = $get('../../bunker_id');
                                                $label = $get('engine');

                                                $engine = BunkerEngine::query()->firstWhere([
                                                    ['bunker_id', '=', $bunkerId],
                                                    ['label', '=', $label],
                                                ]);

                                                if (! $engine) {
                                                    return [];
                                                }

                                                return $engine->formulas()->pluck('label', 'label');
                                            })
                                            ->disabled(function (\Closure $get) {
                                                $bunkerId = $get('../../bunker_id');
                                                $type = $get('type');
                                                $engine = $get('engine');

                                                $bunkerIsEmpty = is_null($bunkerId) || empty($bunkerId);
                                                $typeIsReFuel = $type === BunkerJournalEntryType::REFUEL;
                                                $typeIsAdjustment = $type === BunkerJournalEntryType::ADJUSTMENT;
                                                $engineIsEmpty = is_null($engine) || empty($engine);

                                                return $bunkerIsEmpty || $typeIsReFuel || $typeIsAdjustment || $engineIsEmpty;
                                            })
                                            ->nullable()
                                            ->afterStateUpdated(function (\Closure $get, \Closure $set, ?string $state) {
                                                $bunkerId = $get('../../bunker_id');
                                                $engineLabel = $get('engine');
                                                $formulaLabel = $state;

                                                $engine = BunkerEngine::query()->firstWhere([
                                                    ['bunker_id', '=', $bunkerId],
                                                    ['label', '=', $engineLabel],
                                                ]);

                                                $formula = BunkerFormula::query()->firstWhere([
                                                    ['bunker_id', '=', $bunkerId],
                                                    ['engine_id', '=', optional($engine)->id],
                                                    ['label', '=', $formulaLabel],
                                                ]);

                                                if (! $engine || ! $formula) {
                                                    return;
                                                }

                                                $set('hourly_consumption', $formula->hourly_consumption);

                                                CalculateFuelConsumption::run($get, $set);
                                                CalculateFuelRemainder::run($get, $set);
                                                CalculateFuelTotalUsage::run($get, $set);
                                            }),
                                        Forms\Components\TextInput::make('hourly_consumption')
                                            ->disableLabel()
                                            ->suffix('ℓ/h')
                                            ->disabled()
                                            ->nullable(),
                                        Forms\Components\DateTimePicker::make('time_started_at')
                                            ->disableLabel()
                                            ->reactive()
                                            ->withoutSeconds()
                                            ->minDate(function (\Closure $get) {
                                                $date = $get('../../date');

                                                return Carbon::parse($date)->startOfDay();
                                            })
                                            ->displayFormat('d M / H:i')
                                            ->disabled(function (\Closure $get) {
                                                $consumption = $get('hourly_consumption');
                                                $date = $get('../../date');

                                                $consumptionIsEmpty = is_null($consumption) || empty($consumption);
                                                $dateIsEmpty = is_null($date) || empty($date);

                                                return $consumptionIsEmpty || $dateIsEmpty;
                                            })
                                            ->nullable()
                                            ->afterStateUpdated(function (\Closure $get, \Closure $set) {
                                                CalculateFuelConsumption::run($get, $set);
                                                CalculateFuelRemainder::run($get, $set);
                                                CalculateFuelTotalUsage::run($get, $set);
                                            }),
                                        Forms\Components\DateTimePicker::make('time_finished_at')
                                            ->disableLabel()
                                            ->reactive()
                                            ->withoutSeconds()
                                            ->minDate(function (\Closure $get) {
                                                $date = $get('../../date');

                                                return Carbon::parse($date)->startOfDay();
                                            })
                                            ->displayFormat('d M / H:i')
                                            ->disabled(function (\Closure $get) {
                                                $consumption = $get('hourly_consumption');
                                                $date = $get('../../date');

                                                $consumptionIsEmpty = is_null($consumption) || empty($consumption);
                                                $dateIsEmpty = is_null($date) || empty($date);

                                                return $consumptionIsEmpty || $dateIsEmpty;
                                            })
                                            ->nullable()
                                            ->afterStateUpdated(function (\Closure $get, \Closure $set) {
                                                CalculateFuelConsumption::run($get, $set);
                                                CalculateFuelRemainder::run($get, $set);
                                                CalculateFuelTotalUsage::run($get, $set);
                                            }),
                                        Forms\Components\TextInput::make('total_minutes')
                                            ->disableLabel()
                                            ->suffix('min')
                                            ->disabled()
                                            ->nullable(),
                                        Forms\Components\TextInput::make('total_usage')
                                            ->disableLabel()
                                            ->reactive()
                                            ->suffix('ℓ')
                                            ->disabled()
                                            ->visible(function (\Closure $get) {
                                                $type = $get('type');

                                                return $type === BunkerJournalEntryType::USAGE;
                                            })
                                            ->nullable()
                                            ->afterStateHydrated(function (?string $state, Forms\Components\TextInput $component) {
                                                $component->state(number_format($state, 3));
                                            }),
                                        Forms\Components\TextInput::make('total_refuel')
                                            ->disableLabel()
                                            ->lazy()
                                            ->suffix('ℓ')
                                            ->mask(
                                                fn (Forms\Components\TextInput\Mask $mask) => $mask
                                                    ->numeric()
                                                    ->minValue(1)
                                                    ->maxValue(500_000)
                                                    ->decimalPlaces(3) // Set the number of digits after the decimal point.
                                                    ->decimalSeparator('.') // Add a separator for decimal numbers.
                                                    ->normalizeZeros() // Append or remove zeros at the end of the number.
                                                    ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
                                                    ->thousandsSeparator(','), // Add a separator for thousands.
                                            )
                                            ->visible(function (\Closure $get) {
                                                $type = $get('type');

                                                return $type === BunkerJournalEntryType::REFUEL;
                                            })
                                            ->nullable()
                                            ->afterStateUpdated(function (\Closure $get, \Closure $set) {
                                                CalculateFuelConsumption::run($get, $set);
                                                CalculateFuelRemainder::run($get, $set);
                                                CalculateFuelTotalUsage::run($get, $set);
                                            }),

                                        Forms\Components\TextInput::make('total_adjustment')
                                            ->disableLabel()
                                            ->lazy()
                                            ->suffix('ℓ')
                                            ->mask(
                                                fn (Forms\Components\TextInput\Mask $mask) => $mask
                                                    ->numeric()
                                                    ->decimalPlaces(3) // Set the number of digits after the decimal point.
                                                    ->decimalSeparator('.') // Add a separator for decimal numbers.
                                                    ->normalizeZeros() // Append or remove zeros at the end of the number.
                                                    ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
                                                    ->thousandsSeparator(','), // Add a separator for thousands.
                                            )
                                            ->visible(function (\Closure $get) {
                                                $type = $get('type');

                                                return $type === BunkerJournalEntryType::ADJUSTMENT;
                                            })
                                            ->nullable()
                                            ->afterStateUpdated(function (\Closure $get, \Closure $set) {
                                                CalculateFuelConsumption::run($get, $set);
                                                CalculateFuelRemainder::run($get, $set);
                                                CalculateFuelTotalUsage::run($get, $set);
                                            }),
                                    ])
                                    ->columnSpan(2),
                                Forms\Components\Textarea::make('description')
                                    ->disableLabel()
                                    ->rows(3)
                                    ->disabled(function (\Closure $get) {
                                        $bunkerId = $get('../../bunker_id');

                                        return is_null($bunkerId) || empty($bunkerId);
                                    })
                                    ->nullable()
                                    ->extraInputAttributes([
                                        'style' => 'height: 108px;',
                                    ]),
                            ]),
                    ])
                    ->columnSpan(3),
            ])
            ->columns(3)
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(static::getSchemaForTableColumns())
            ->filters(static::getSchemaForTableFilters())
            ->actions([
                TableActions\CommitAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
        ;
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBunkerJournals::route('/'),
            'create' => Pages\CreateBunkerJournal::route('/create'),
            'view' => Pages\ViewBunkerJournal::route('/{record}'),
            'edit' => Pages\EditBunkerJournal::route('/{record}/edit'),
        ];
    }
}

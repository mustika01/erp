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
use Kumi\Sousa\Filament\Resources\OilJournalResource\Actions\CalculateOilRemainder;
use Kumi\Sousa\Filament\Resources\OilJournalResource\Actions\CalculateOilUsage;
use Kumi\Sousa\Filament\Resources\OilJournalResource\Actions\RejectInvalidOilJournalEntries;
use Kumi\Sousa\Filament\Resources\OilJournalResource\Pages;
use Kumi\Sousa\Filament\Resources\OilJournalResource\Tables\Actions as TableActions;
use Kumi\Sousa\Filament\Resources\OilJournalResource\Traits\InteractsWithOilJournalSchema;
use Kumi\Sousa\Models\Bunker;
use Kumi\Sousa\Models\OilJournal;
use Kumi\Sousa\Models\OilJournalEntry;
use Kumi\Sousa\Support\DatabaseTableNames;
use Kumi\Sousa\Support\Enums\OilJournalEntryType;
use Kumi\Sousa\Support\Enums\OilJournalOilType;

class OilJournalResource extends Resource
{
    use InteractsWithOilJournalSchema;

    protected static ?string $model = OilJournal::class;

    protected static ?string $modelLabel = 'Journal';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'sousa';

    protected static ?string $slug = 'sousa/oil-journals';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\Group::make([
                        Forms\Components\Select::make('bunker_id')
                            ->label(__('sousa::filament/resources/oil-journal.fields.bunker_id.label'))
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
                                    $set('entries.*.    ', null);
                                    $set('entries.*.total_usage', null);
                                    $set('entries.*.total_refuel', null);

                                    return;
                                }

                                $bunker = Bunker::find($state);

                                $set('rob_amount', $bunker->rob_amount_type_90);
                            }),
                        Forms\Components\DatePicker::make('date')
                            ->label(__('sousa::filament/resources/oil-journal.fields.date.label'))
                            ->displayFormat('d F Y')
                            ->closeOnDateSelection()
                            ->reactive()
                            ->required(),
                    ])->columns(2),
                ]),
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make('rob_amount_type_90')
                        ->label(__('sousa::filament/resources/oil-journal.fields.rob_amount_type_90.label'))
                        ->reactive()
                        ->default(function (Request $request) {
                            $bunker = Bunker::query()->firstWhere('id', $request->get('bunker_id'));

                            return $bunker ? $bunker->type_90_amount : null;
                        })
                        ->disabled()
                        ->suffix('ℓ'),
                    Forms\Components\TextInput::make('total_usage_type_90')
                        ->label(__('sousa::filament/resources/oil-journal.fields.total_usage_type_90.label'))
                        ->dehydrated(false)
                        ->reactive()
                        ->disabled()
                        ->suffix('ℓ')
                        ->afterStateHydrated(function (TextInput $component, \Closure $get, ?Model $record) {
                            $entries = $get('entries');

                            if ($record && is_null($entries)) {
                                $totalUsageType90 = $record
                                    ->entries
                                    ->filter(function (OilJournalEntry $entry) {
                                        return $entry->entry_type == OilJournalEntryType::USAGE;
                                    })
                                    ->filter(function (OilJournalEntry $entry) {
                                        return $entry->oil_type == OilJournalOilType::TYPE_90;
                                    })
                                    ->sum('total_litre')
                                ;

                                $component->state(number_format($totalUsageType90, 3));
                            }
                        }),
                    Forms\Components\TextInput::make('remainder_type_90')
                        ->label(__('sousa::filament/resources/oil-journal.fields.remainder_type_90.label'))
                        ->reactive()
                        ->disabled()
                        ->suffix('ℓ'),
                ])->columnSpan(1),

                Forms\Components\Card::make([
                    Forms\Components\TextInput::make('rob_amount_type_40')
                        ->label(__('sousa::filament/resources/oil-journal.fields.rob_amount_type_40.label'))
                        ->reactive()
                        ->default(function (Request $request) {
                            $bunker = Bunker::query()->firstWhere('id', $request->get('bunker_id'));

                            return $bunker ? $bunker->type_40_amount : null;
                        })
                        ->disabled()
                        ->suffix('ℓ'),
                    Forms\Components\TextInput::make('total_usage_type_40')
                        ->label(__('sousa::filament/resources/oil-journal.fields.total_usage_type_40.label'))
                        ->dehydrated(false)
                        ->reactive()
                        ->disabled()
                        ->suffix('ℓ')
                        ->afterStateHydrated(function (TextInput $component, \Closure $get, ?Model $record) {
                            $entries = $get('entries');

                            if ($record && is_null($entries)) {
                                $totalUsageType40 = $record
                                    ->entries
                                    ->filter(function (OilJournalEntry $entry) {
                                        return $entry->entry_type == OilJournalEntryType::USAGE;
                                    })
                                    ->filter(function (OilJournalEntry $entry) {
                                        return $entry->oil_type == OilJournalOilType::TYPE_40;
                                    })
                                    ->sum('total_litre')
                                ;

                                $component->state(number_format($totalUsageType40, 3));
                            }
                        }),
                    Forms\Components\TextInput::make('remainder_type_40')
                        ->label(__('sousa::filament/resources/oil-journal.fields.remainder_type_40.label'))
                        ->reactive()
                        ->disabled()
                        ->suffix('ℓ'),
                ])->columnSpan(1),

                Forms\Components\Card::make([
                    Forms\Components\TextInput::make('rob_amount_type_10')
                        ->label(__('sousa::filament/resources/oil-journal.fields.rob_amount_type_10.label'))
                        ->reactive()
                        ->default(function (Request $request) {
                            $bunker = Bunker::query()->firstWhere('id', $request->get('bunker_id'));

                            return $bunker ? $bunker->type_10_amount : null;
                        })
                        ->disabled()
                        ->suffix('ℓ'),
                    Forms\Components\TextInput::make('total_usage_type_10')
                        ->label(__('sousa::filament/resources/oil-journal.fields.total_usage_type_10.label'))
                        ->dehydrated(false)
                        ->reactive()
                        ->disabled()
                        ->suffix('ℓ')
                        ->afterStateHydrated(function (TextInput $component, \Closure $get, ?Model $record) {
                            $entries = $get('entries');

                            if ($record && is_null($entries)) {
                                $totalUsageType10 = $record
                                    ->entries
                                    ->filter(function (OilJournalEntry $entry) {
                                        return $entry->entry_type == OilJournalEntryType::USAGE;
                                    })
                                    ->filter(function (OilJournalEntry $entry) {
                                        return $entry->oil_type == OilJournalOilType::TYPE_10;
                                    })
                                    ->sum('total_litre')
                                ;

                                $component->state(number_format($totalUsageType10, 3));
                            }
                        }),
                    Forms\Components\TextInput::make('remainder_type_10')
                        ->label(__('sousa::filament/resources/oil-journal.fields.remainder_type_10.label'))
                        ->reactive()
                        ->disabled()
                        ->suffix('ℓ'),
                ])->columnSpan(1),

                Forms\Components\Repeater::make('entries')
                    ->relationship('entries')
                    ->disableLabel()
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Grid::make(3)
                                    ->schema([
                                        Forms\Components\Select::make('entry_type')
                                            ->disableLabel()
                                            ->reactive()
                                            ->options([
                                                OilJournalEntryType::USAGE => __('sousa::filament/resources/oil-journal.fields.entry_type.options.' . OilJournalEntryType::USAGE),
                                                OilJournalEntryType::REFUEL => __('sousa::filament/resources/oil-journal.fields.entry_type.options.' . OilJournalEntryType::REFUEL),
                                            ])
                                            ->default(OilJournalEntryType::USAGE)
                                            ->disabled(function (\Closure $get) {
                                                $bunkerId = $get('../../bunker_id');

                                                return is_null($bunkerId) || empty($bunkerId);
                                            })
                                            ->required()
                                            ->disablePlaceholderSelection()
                                            ->afterStateUpdated(function (\Closure $set) {
                                                $set('total_litre', null);
                                            }),
                                        Forms\Components\Select::make('oil_type')
                                            ->disableLabel()
                                            ->reactive()
                                            ->options([
                                                OilJournalOilType::TYPE_90 => __('sousa::filament/resources/oil-journal.fields.oil_type.options.' . OilJournalOilType::TYPE_90),
                                                OilJournalOilType::TYPE_40 => __('sousa::filament/resources/oil-journal.fields.oil_type.options.' . OilJournalOilType::TYPE_40),
                                                OilJournalOilType::TYPE_10 => __('sousa::filament/resources/oil-journal.fields.oil_type.options.' . OilJournalOilType::TYPE_10),
                                            ])
                                            ->default(OilJournalOilType::TYPE_90)
                                            ->disabled(function (\Closure $get) {
                                                $bunkerId = $get('../../bunker_id');

                                                return is_null($bunkerId) || empty($bunkerId);
                                            })
                                            ->required()
                                            ->disablePlaceholderSelection()
                                            ->afterStateUpdated(function (\Closure $set) {
                                                $set('total_litre', null);
                                            }),

                                        Forms\Components\TextInput::make('total_litre')
                                            ->disableLabel()
                                            ->reactive()
                                            ->lazy()
                                            ->suffix('ℓ')
                                            ->mask(
                                                fn (Forms\Components\TextInput\Mask $mask) => $mask
                                                    ->numeric()
                                                    ->minValue(0)
                                                    ->maxValue(100_000)
                                                    ->decimalPlaces(3) // Set the number of digits after the decimal point.
                                                    ->decimalSeparator('.') // Add a separator for decimal numbers.
                                                    ->normalizeZeros() // Append or remove zeros at the end of the number.
                                                    ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
                                                    ->thousandsSeparator(','), // Add a separator for thousands.
                                            )
                                            ->nullable()
                                            ->afterStateHydrated(function (?string $state, Forms\Components\TextInput $component) {
                                                $component->state(number_format($state, 3));
                                            })
                                            ->afterStateUpdated(function (\Closure $get, \Closure $set) {
                                                RejectInvalidOilJournalEntries::run($get, $set);
                                                CalculateOilUsage::run($get, $set);
                                                CalculateOilRemainder::run($get, $set);
                                            }),
                                    ])
                                    ->columnSpan(2),
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
            'index' => Pages\ListOilJournals::route('/'),
            'create' => Pages\CreateOilJournal::route('/create'),
            'view' => Pages\ViewOilJournal::route('/{record}'),
            'edit' => Pages\EditOilJournal::route('/{record}/edit'),
        ];
    }
}

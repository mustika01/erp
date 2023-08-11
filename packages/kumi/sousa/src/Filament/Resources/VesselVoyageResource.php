<?php

namespace Kumi\Sousa\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Kumi\Sousa\Filament\Resources\VesselVoyageResource\Pages;
use Kumi\Sousa\Filament\Resources\VesselVoyageResource\RelationManagers;
use Kumi\Sousa\Models\Vessel;
use Kumi\Sousa\Models\VesselVoyage;
use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\VoyageState;
use Kumi\Sousa\Models\VoyageCity;

class VesselVoyageResource extends Resource
{
    protected static ?string $model = VesselVoyage::class;

    protected static ?string $modelLabel = 'Voyage';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'sousa';

    protected static ?int $navigationSort = 3004;

    protected static ?string $slug = 'sousa/vessel-voyages';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\Group::make([
                        Forms\Components\Select::make('vessel_id')
                            ->label(__('sousa::filament/resources/vessel-voyage.fields.vessel.label'))
                            ->relationship('vessel', 'name')
                            ->preload()
                            ->default(function (Request $request) {
                                $vessel = Vessel::query()->firstWhere('id', $request->get('vessel_id'));

                                return $vessel ? $request->get('vessel_id') : null;
                            })
                            ->disabled(function (Request $request) {
                                $vessel = Vessel::query()->firstWhere('id', $request->get('vessel_id'));

                                return $vessel ? true : false;
                            })
                            ->searchable()
                            ->required(),
                        Forms\Components\TextInput::make('number')
                            ->label(__('sousa::filament/resources/vessel-voyage.fields.number.label'))
                            ->disabled(function (\Closure $get, string $context) {
                                return (bool) $get('is_returning');
                            })
                            ->required(function (\Closure $get) {
                                return (bool) ! $get('is_returning');
                            }),
                        Forms\Components\TextInput::make('cargo_content')
                            ->label(__('sousa::filament/resources/vessel-voyage.fields.cargo_content.label'))
                            ->disabled(function (\Closure $get) {
                                return (bool) $get('is_returning');
                            })
                            ->required(function (\Closure $get) {
                                return (bool) ! $get('is_returning');
                            }),
                        Forms\Components\Toggle::make('is_returning')
                            ->label(__('sousa::filament/resources/vessel-voyage.fields.is_returning.label'))
                            ->reactive()
                            ->default(false)
                            ->disabled(function (string $context) {
                                return $context === 'edit';
                            })
                            ->afterStateUpdated(function (\Closure $set, bool $state) {
                                if ($state) {
                                    $set('number', null);
                                    $set('number', null);
                                }
                            }),
                    ]),
                    Forms\Components\Group::make([
                        Forms\Components\Select::make('origin_city_id')
                            ->label(__('sousa::filament/resources/vessel-voyage.fields.origin_city.label'))
                            ->relationship('originCity', 'name')
                            ->reactive()
                            ->required()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->label(__('sousa::filament/resources/vessel-voyage.fields.origin_city.modal.fields.name.label'))
                                    ->required(),
                            ])
                            ->afterStateUpdated(function (?string $state) {
                                Session::put('origin_city_id', $state);
                            }),
                        Forms\Components\Select::make('origin_port_id')
                            ->label(__('sousa::filament/resources/vessel-voyage.fields.origin_port.label'))
                            ->relationship('originPort', 'name')
                            ->options(function (\Closure $get) {
                                $cityId = $get('origin_city_id') ?? 0;

                                $city = VoyageCity::find($cityId);

                                if (! $city) {
                                    return [];
                                }

                                return $city->ports()->pluck('name', 'id');
                            })
                            ->required()
                            ->disabled(function (\Closure $get) {
                                return is_null($get('origin_city_id'));
                            })
                            ->createOptionForm([
                                Forms\Components\Select::make('city_id')
                                    ->label(__('sousa::filament/resources/vessel-voyage.fields.origin_port.modal.fields.city_id.label'))
                                    ->relationship('city', 'name')
                                    ->default(function () {
                                        return Session::get('origin_city_id');
                                    })
                                    ->disabled()
                                    ->required(),
                                Forms\Components\TextInput::make('name')
                                    ->label(__('sousa::filament/resources/vessel-voyage.fields.origin_port.modal.fields.name.label'))
                                    ->required(),
                            ]),
                    ]),
                    Forms\Components\Group::make([
                        Forms\Components\Select::make('destination_city_id')
                            ->label(__('sousa::filament/resources/vessel-voyage.fields.destination_city.label'))
                            ->relationship('destinationCity', 'name')
                            ->reactive()
                            ->required()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->label(__('sousa::filament/resources/vessel-voyage.fields.destination_city.modal.fields.name.label'))
                                    ->required(),
                            ])
                            ->afterStateUpdated(function (?string $state) {
                                Session::put('destination_city_id', $state);
                            }),
                        Forms\Components\Select::make('destination_port_id')
                            ->label(__('sousa::filament/resources/vessel-voyage.fields.destination_port.label'))
                            ->relationship('destinationPort', 'name')
                            ->options(function (\Closure $get) {
                                $cityId = $get('destination_city_id') ?? 0;

                                $city = VoyageCity::find($cityId);

                                if (! $city) {
                                    return [];
                                }

                                return $city->ports()->pluck('name', 'id');
                            })
                            ->required()
                            ->disabled(function (\Closure $get) {
                                return is_null($get('destination_city_id'));
                            })
                            ->createOptionForm([
                                Forms\Components\Select::make('city_id')
                                    ->label(__('sousa::filament/resources/vessel-voyage.fields.destination_port.modal.fields.city_id.label'))
                                    ->relationship('city', 'name')
                                    ->default(function () {
                                        return Session::get('destination_city_id');
                                    })
                                    ->disabled()
                                    ->required(),
                                Forms\Components\TextInput::make('name')
                                    ->label(__('sousa::filament/resources/vessel-voyage.fields.destination_port.modal.fields.name.label'))
                                    ->required(),
                            ]),
                    ]),
                ])->columns(3),

                Forms\Components\Grid::make(4)
                    ->schema([
                        Forms\Components\Section::make('upload_file_origin')
                            ->heading(__('sousa::filament/resources/vessel-voyage.fields.upload_file_origin.label'))
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('origin_nor')
                                    ->label(__('sousa::filament/resources/vessel-voyage.fields.origin_nor.label'))
                                    ->collection('origin_nor')
                                    ->enableDownload()
                                    ->preserveFilenames()
                                    ->columnSpanFull(),

                                SpatieMediaLibraryFileUpload::make('origin_sof')
                                    ->label(__('sousa::filament/resources/vessel-voyage.fields.origin_sof.label'))
                                    ->collection('origin_sof')
                                    ->enableDownload()
                                    ->preserveFilenames()
                                    ->columnSpanFull(),

                                SpatieMediaLibraryFileUpload::make('origin_spb')
                                    ->label(__('sousa::filament/resources/vessel-voyage.fields.origin_spb.label'))
                                    ->collection('origin_spb')
                                    ->enableDownload()
                                    ->preserveFilenames()
                                    ->columnSpanFull(),

                                SpatieMediaLibraryFileUpload::make('origin_report')
                                    ->label(__('sousa::filament/resources/vessel-voyage.fields.origin_report.label'))
                                    ->collection('origin_report')
                                    ->enableDownload()
                                    ->preserveFilenames()
                                    ->columnSpanFull(),
                            ])->columnSpan(2)->collapsible(),

                        Forms\Components\Section::make('upload_file_destination')
                            ->heading(__('sousa::filament/resources/vessel-voyage.fields.upload_file_destination.label'))
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('destination_nor')
                                    ->label(__('sousa::filament/resources/vessel-voyage.fields.destination_nor.label'))
                                    ->collection('destination_nor')
                                    ->enableDownload()
                                    ->preserveFilenames()
                                    ->columnSpanFull(),

                                SpatieMediaLibraryFileUpload::make('destination_sof')
                                    ->label(__('sousa::filament/resources/vessel-voyage.fields.destination_sof.label'))
                                    ->collection('destination_sof')
                                    ->enableDownload()
                                    ->preserveFilenames()
                                    ->columnSpanFull(),

                                SpatieMediaLibraryFileUpload::make('destination_spb')
                                    ->label(__('sousa::filament/resources/vessel-voyage.fields.destination_spb.label'))
                                    ->collection('destination_spb')
                                    ->enableDownload()
                                    ->preserveFilenames()
                                    ->columnSpanFull(),

                                SpatieMediaLibraryFileUpload::make('destination_report')
                                    ->label(__('sousa::filament/resources/vessel-voyage.fields.destination_report.label'))
                                    ->collection('destination_report')
                                    ->enableDownload()
                                    ->preserveFilenames()
                                    ->columnSpanFull(),
                            ])->columnSpan(2)->collapsible(),
                    ])->columnSpan(2),
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('vessel.name')
                    ->label(__('sousa::filament/resources/vessel-voyage.columns.vessel.label'))
                    ->description(function (Model $record) {
                        return $record->cargo_content;
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('number')
                    ->label(__('sousa::filament/resources/vessel-voyage.columns.number.label'))
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('originCity.name')
                    ->label(__('sousa::filament/resources/vessel-voyage.columns.origin.label'))
                    ->formatStateUsing(function (Model $record) {
                        $city = $record->originCity->name;
                        $port = $record->originPort->name;

                        return "{$city} / {$port}";
                    })
                    ->description(function (Model $record) {
                        $departedStatus = $record->departedStatus;

                        return $departedStatus ? $departedStatus->executed_at->format('d F Y') : 'N/A';
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
                        $arrivedStatus = $record->arrivedStatus;

                        return $arrivedStatus ? $arrivedStatus->executed_at->format('d F Y') : 'N/A';
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
            ->actions([
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
            RelationManagers\StatusesRelationManager::class,
            RelationManagers\LoadingCargoLogsRelationManager::class,
            RelationManagers\UnloadingCargoLogsRelationManager::class,
            RelationManagers\ActivitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVesselVoyages::route('/'),
            'create' => Pages\CreateVesselVoyage::route('/create'),
            'view' => Pages\ViewVesselVoyage::route('/{record}'),
            'edit' => Pages\EditVesselVoyage::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()->latest('id');
    }
}

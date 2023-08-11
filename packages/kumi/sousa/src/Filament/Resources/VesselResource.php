<?php

namespace Kumi\Sousa\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Kumi\Kanshi\Filament\RelationManagers\ActivitiesRelationManager;
use Kumi\Sousa\Filament\Resources\VesselResource\Pages;
use Kumi\Sousa\Filament\Resources\VesselResource\RelationManagers;
use Kumi\Sousa\Filament\Resources\VesselResource\Tables\Actions;
use Kumi\Sousa\Models\Vessel;
use Kumi\Sousa\Support\Enums\VesselClassification;
use Kumi\Sousa\Support\Enums\VesselStatus;
use Kumi\Sousa\Support\Enums\VesselType;

class VesselResource extends Resource
{
    protected static ?string $model = Vessel::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'sousa';

    protected static ?int $navigationSort = 3002;

    protected static ?string $slug = 'sousa/vessels';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\Section::make('')
                            ->heading(__('sousa::filament/resources/vessel.sections.basic-details'))
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label(__('sousa::filament/resources/vessel.fields.name.label'))
                                    ->required(),
                                Forms\Components\TextInput::make('properties.registration_number')
                                    ->label(__('sousa::filament/resources/vessel.fields.registration_number.label'))
                                    ->nullable(),
                                Forms\Components\Select::make('properties.vessel_type')
                                    ->label(__('sousa::filament/resources/vessel.fields.vessel_type.label'))
                                    ->options([
                                        VesselType::MOTOR_VESSEL => __('sousa::filament/resources/vessel.fields.vessel_type.options.' . VesselType::MOTOR_VESSEL),
                                        VesselType::TUG_BOAT => __('sousa::filament/resources/vessel.fields.vessel_type.options.' . VesselType::TUG_BOAT),
                                        VesselType::BARGE => __('sousa::filament/resources/vessel.fields.vessel_type.options.' . VesselType::BARGE),
                                        VesselType::TANKER => __('sousa::filament/resources/vessel.fields.vessel_type.options.' . VesselType::TANKER),
                                    ])
                                    ->required(),
                                Forms\Components\TextInput::make('properties.imo_number')
                                    ->label(__('sousa::filament/resources/vessel.fields.imo_number.label'))
                                    ->nullable(),
                                Forms\Components\TextInput::make('properties.registration_port')
                                    ->label(__('sousa::filament/resources/vessel.fields.registration_port.label'))
                                    ->required(),
                                Forms\Components\TextInput::make('properties.call_sign')
                                    ->label(__('sousa::filament/resources/vessel.fields.call_sign.label'))
                                    ->nullable(),
                                Forms\Components\TextInput::make('properties.flag_nationality')
                                    ->label(__('sousa::filament/resources/vessel.fields.flag_nationality.label'))
                                    ->default('Indonesia')
                                    ->disabled(),
                                Forms\Components\Select::make('properties.classification')
                                    ->label(__('sousa::filament/resources/vessel.fields.classification.label'))
                                    ->options([
                                        VesselClassification::BKI => __('sousa::filament/resources/vessel.fields.classification.options.' . VesselClassification::BKI),
                                    ])
                                    ->nullable(),
                            ])
                            ->columnSpan(2)
                            ->columns(2),
                        Forms\Components\Section::make('')
                            ->heading(__('sousa::filament/resources/vessel.sections.construction-and-status'))
                            ->schema([
                                Forms\Components\Select::make('properties.status')
                                    ->label(__('sousa::filament/resources/vessel.fields.status.label'))
                                    ->options([
                                        VesselStatus::OPERATIONAL => __('sousa::filament/resources/vessel.fields.status.options.' . VesselStatus::OPERATIONAL),
                                        VesselStatus::SOLD => __('sousa::filament/resources/vessel.fields.status.options.' . VesselStatus::SOLD),
                                        VesselStatus::SCRAPPED => __('sousa::filament/resources/vessel.fields.status.options.' . VesselStatus::SCRAPPED),
                                    ])
                                    ->default(VesselStatus::OPERATIONAL)
                                    ->required(),
                                Forms\Components\TextInput::make('properties.year_built')
                                    ->label(__('sousa::filament/resources/vessel.fields.year_built.label'))
                                    ->numeric()
                                    ->default(2000)
                                    ->mask(
                                        fn (Forms\Components\TextInput\Mask $mask) => $mask
                                            ->numeric()
                                            ->integer() // Disallow decimal numbers.
                                            ->minValue(1950) // Set the minimum value that the number can be.
                                            ->maxValue(Carbon::now()->year) // Set the maximum value that the number can be.
                                    )
                                    ->required(),
                                Forms\Components\TextInput::make('properties.builder_name')
                                    ->label(__('sousa::filament/resources/vessel.fields.builder_name.label'))
                                    ->nullable(),
                                Forms\Components\TextInput::make('properties.hull_material')
                                    ->label(__('sousa::filament/resources/vessel.fields.hull_material.label'))
                                    ->nullable(),
                            ])
                            ->columnSpan(1),
                        Forms\Components\Section::make('')
                            ->heading(__('sousa::filament/resources/vessel.sections.engine-and-other-details'))
                            ->schema([
                                Forms\Components\RichEditor::make('properties.main_engine')
                                    ->label(__('sousa::filament/resources/vessel.fields.main_engine.label'))
                                    ->toolbarButtons([
                                        'bold',
                                        'italic',
                                        'redo',
                                        'undo',
                                    ])
                                    ->extraInputAttributes([
                                        'style' => 'height: 132px',
                                    ])
                                    ->required(),
                                Forms\Components\RichEditor::make('properties.aux_engine')
                                    ->label(__('sousa::filament/resources/vessel.fields.aux_engine.label'))
                                    ->toolbarButtons([
                                        'bold',
                                        'italic',
                                        'redo',
                                        'undo',
                                    ])
                                    ->extraInputAttributes([
                                        'style' => 'height: 132px',
                                    ]),
                                Forms\Components\RichEditor::make('properties.crane_description')
                                    ->label(__('sousa::filament/resources/vessel.fields.crane_description.label'))
                                    ->toolbarButtons([
                                        'bold',
                                        'italic',
                                        'redo',
                                        'undo',
                                    ])
                                    ->extraInputAttributes([
                                        'style' => 'height: 98px',
                                    ]),
                                Forms\Components\Group::make([
                                    Forms\Components\TextInput::make('properties.average_cruise_speed')
                                        ->label(__('sousa::filament/resources/vessel.fields.average_cruise_speed.label'))
                                        ->suffix('kn')
                                        ->numeric()
                                        ->mask(
                                            fn (Forms\Components\TextInput\Mask $mask) => $mask
                                                ->numeric()
                                                ->decimalPlaces(2) // Set the number of digits after the decimal point.
                                                ->decimalSeparator('.') // Add a separator for decimal numbers.
                                                ->normalizeZeros() // Append or remove zeros at the end of the number.
                                                ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
                                        ),
                                    Forms\Components\DatePicker::make('properties.last_docked_at')
                                        ->label(__('sousa::filament/resources/vessel.fields.last_docked_at.label'))
                                        ->displayFormat('d F Y'),
                                    Forms\Components\DatePicker::make('properties.next_docked_at')
                                        ->label(__('sousa::filament/resources/vessel.fields.next_docked_at.label'))
                                        ->displayFormat('d F Y'),
                                ]),
                                Forms\Components\SpatieMediaLibraryFileUpload::make('properties.featured_image')
                                    ->label(__('sousa::filament/resources/vessel.fields.featured_image.label'))
                                    ->collection('featured_image')
                                    ->image()
                                    ->panelAspectRatio('16:9')
                                    ->panelLayout('integrated')
                                    ->columnSpan(2),
                            ])
                            ->columns(2)
                            ->columnSpan(2),
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make('')
                                    ->heading(__('sousa::filament/resources/vessel.sections.dimension'))
                                    ->schema([
                                        Forms\Components\TextInput::make('properties.length')
                                            ->label(__('sousa::filament/resources/vessel.fields.length.label'))
                                            ->suffix('m')
                                            ->numeric()
                                            ->mask(
                                                fn (Forms\Components\TextInput\Mask $mask) => $mask
                                                    ->numeric()
                                                    ->decimalPlaces(2) // Set the number of digits after the decimal point.
                                                    ->decimalSeparator('.') // Add a separator for decimal numbers.
                                                    ->normalizeZeros() // Append or remove zeros at the end of the number.
                                                    ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
                                            )
                                            ->required(),
                                        Forms\Components\TextInput::make('properties.breadth')
                                            ->label(__('sousa::filament/resources/vessel.fields.breadth.label'))
                                            ->suffix('m')
                                            ->numeric()
                                            ->mask(
                                                fn (Forms\Components\TextInput\Mask $mask) => $mask
                                                    ->numeric()
                                                    ->decimalPlaces(2) // Set the number of digits after the decimal point.
                                                    ->decimalSeparator('.') // Add a separator for decimal numbers.
                                                    ->normalizeZeros() // Append or remove zeros at the end of the number.
                                                    ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
                                            )
                                            ->required(),
                                        Forms\Components\TextInput::make('properties.depth')
                                            ->label(__('sousa::filament/resources/vessel.fields.depth.label'))
                                            ->suffix('m')
                                            ->numeric()
                                            ->mask(
                                                fn (Forms\Components\TextInput\Mask $mask) => $mask
                                                    ->numeric()
                                                    ->decimalPlaces(2) // Set the number of digits after the decimal point.
                                                    ->decimalSeparator('.') // Add a separator for decimal numbers.
                                                    ->normalizeZeros() // Append or remove zeros at the end of the number.
                                                    ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
                                            )
                                            ->required(),
                                        Forms\Components\TextInput::make('properties.draft')
                                            ->label(__('sousa::filament/resources/vessel.fields.draft.label'))
                                            ->suffix('m')
                                            ->numeric()
                                            ->mask(
                                                fn (Forms\Components\TextInput\Mask $mask) => $mask
                                                    ->numeric()
                                                    ->decimalPlaces(2) // Set the number of digits after the decimal point.
                                                    ->decimalSeparator('.') // Add a separator for decimal numbers.
                                                    ->normalizeZeros() // Append or remove zeros at the end of the number.
                                                    ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
                                            )
                                            ->required(),
                                    ])
                                    ->columnSpan(1),
                                Forms\Components\Section::make('')
                                    ->heading(__('sousa::filament/resources/vessel.sections.tonnage'))
                                    ->schema([
                                        Forms\Components\TextInput::make('properties.gross_tonnage')
                                            ->label(__('sousa::filament/resources/vessel.fields.gross_tonnage.label'))
                                            ->suffix('t')
                                            ->mask(
                                                fn (Forms\Components\TextInput\Mask $mask) => $mask
                                                    ->numeric()
                                                    ->decimalPlaces(0) // Set the number of digits after the decimal point.
                                                    ->decimalSeparator(',') // Add a separator for decimal numbers.
                                                    ->integer() // Disallow decimal numbers.
                                                    ->mapToDecimalSeparator([',']) // Map additional characters to the decimal separator.
                                                    ->minValue(0) // Set the minimum value that the number can be.
                                                    ->maxValue(100_000) // Set the maximum value that the number can be.
                                                    ->normalizeZeros() // Append or remove zeros at the end of the number.
                                                    ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
                                                    ->thousandsSeparator(','), // Add a separator for thousands.
                                            )
                                            ->required(),
                                        Forms\Components\TextInput::make('properties.nett_tonnage')
                                            ->label(__('sousa::filament/resources/vessel.fields.nett_tonnage.label'))
                                            ->suffix('t')
                                            ->mask(
                                                fn (Forms\Components\TextInput\Mask $mask) => $mask
                                                    ->numeric()
                                                    ->decimalPlaces(0) // Set the number of digits after the decimal point.
                                                    ->decimalSeparator(',') // Add a separator for decimal numbers.
                                                    ->integer() // Disallow decimal numbers.
                                                    ->mapToDecimalSeparator([',']) // Map additional characters to the decimal separator.
                                                    ->minValue(0) // Set the minimum value that the number can be.
                                                    ->maxValue(100_000) // Set the maximum value that the number can be.
                                                    ->normalizeZeros() // Append or remove zeros at the end of the number.
                                                    ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
                                                    ->thousandsSeparator(','), // Add a separator for thousands.
                                            ),
                                        Forms\Components\TextInput::make('properties.dead_weight_tonnage')
                                            ->label(__('sousa::filament/resources/vessel.fields.dead_weight_tonnage.label'))
                                            ->suffix('t')
                                            ->mask(
                                                fn (Forms\Components\TextInput\Mask $mask) => $mask
                                                    ->numeric()
                                                    ->decimalPlaces(0) // Set the number of digits after the decimal point.
                                                    ->decimalSeparator(',') // Add a separator for decimal numbers.
                                                    ->integer() // Disallow decimal numbers.
                                                    ->mapToDecimalSeparator([',']) // Map additional characters to the decimal separator.
                                                    ->minValue(0) // Set the minimum value that the number can be.
                                                    ->maxValue(100_000) // Set the maximum value that the number can be.
                                                    ->normalizeZeros() // Append or remove zeros at the end of the number.
                                                    ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
                                                    ->thousandsSeparator(','), // Add a separator for thousands.
                                            )
                                            ->required(),
                                    ])
                                    ->columnSpan(1),
                            ]),
                    ]),
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->label(__('sousa::filament/resources/vessel.columns.name.label'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('properties.year_built')
                    ->label(__('sousa::filament/resources/vessel.columns.year_built.label')),
                Tables\Columns\TextColumn::make('properties.length')
                    ->label(__('sousa::filament/resources/vessel.columns.length.label'))
                    ->formatStateUsing(function (?string $state) {
                        return $state ? number_format($state, 2) : null;
                    }),
                Tables\Columns\TextColumn::make('properties.breadth')
                    ->label(__('sousa::filament/resources/vessel.columns.breadth.label'))
                    ->formatStateUsing(function (?string $state) {
                        return $state ? number_format($state, 2) : null;
                    }),
                Tables\Columns\TextColumn::make('properties.depth')
                    ->label(__('sousa::filament/resources/vessel.columns.depth.label'))
                    ->formatStateUsing(function (?string $state) {
                        return $state ? number_format($state, 2) : null;
                    }),
                Tables\Columns\TextColumn::make('properties.draft')
                    ->label(__('sousa::filament/resources/vessel.columns.draft.label'))
                    ->formatStateUsing(function (?string $state) {
                        return $state ? number_format($state, 2) : null;
                    }),
                Tables\Columns\TextColumn::make('properties.last_docked_at')
                    ->label(__('sousa::filament/resources/vessel.columns.last_docked_at.label'))
                    ->formatStateUsing(function (?string $state) {
                        return $state ? Carbon::parse($state)->format('d F Y') : null;
                    }),
            ])
            // ->defaultSort('name')
            ->filters([
                SelectFilter::make('status')
                    ->label(__('sousa::filament/resources/vessel.filters.status.label'))
                    ->options([
                        VesselStatus::OPERATIONAL => __('sousa::filament/resources/vessel.filters.status.options.' . VesselStatus::OPERATIONAL),
                        VesselStatus::SOLD => __('sousa::filament/resources/vessel.filters.status.options.' . VesselStatus::SOLD),
                        VesselStatus::SCRAPPED => __('sousa::filament/resources/vessel.filters.status.options.' . VesselStatus::SCRAPPED),
                    ])
                    ->default(VesselStatus::OPERATIONAL)
                    ->query(function (Builder $query, array $data): Builder {
                        if (empty($data['value'])) {
                            return $query;
                        }

                        return $query->where('properties->status', $data['value']);
                    }),
                // ->query(fn (Builder $query, array $data): Builder => $query->where('properties->status', $data['value'])),
            ])
            ->actions([
                Actions\DashboardAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])

        ;
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\DocumentsRelationManager::class,
            RelationManagers\VoyagesRelationManager::class,
            ActivitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVessels::route('/'),
            'create' => Pages\CreateVessel::route('/create'),
            'view' => Pages\ViewVessel::route('/{record}'),
            'edit' => Pages\EditVessel::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query();
    }
}

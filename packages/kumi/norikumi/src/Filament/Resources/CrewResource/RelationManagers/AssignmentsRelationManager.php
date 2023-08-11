<?php

namespace Kumi\Norikumi\Filament\Resources\CrewResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Kumi\Jinzai\Support\Enums\BloodType;
use Kumi\Jinzai\Support\Enums\Gender;
use Kumi\Jinzai\Support\Enums\MaritalStatus;
use Kumi\Jinzai\Support\Enums\Religion;
use Kumi\Norikumi\Support\Enums\Position;
use Kumi\Norikumi\Support\Enums\ShipOwner;
use Livewire\Component as Livewire;

class AssignmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'assignments';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\Section::make('')
                            ->heading(__('norikumi::filament/resources/assignment.sections.vessel'))
                            ->schema([
                                Forms\Components\TextInput::make('seafare_code')
                                    ->label(__('norikumi::filament/resources/assignment.fields.seafare_code.label'))
                                    ->required(),
                                Forms\Components\Select::make('vessel_id')
                                    ->relationship('vessel', 'name')
                                    ->preload()
                                    ->searchable()
                                    ->label(__('norikumi::filament/resources/assignment.fields.vessel.label'))
                                    ->required(),
                                Forms\Components\Select::make('ship_owner')
                                    ->label(__('norikumi::filament/resources/assignment.fields.ship_owner.label'))
                                    ->options(self::getShipOwnerOptions())
                                    ->required(),
                            ])->columns(2),
                    ])->columnSpan(2),

                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\Section::make('')
                            ->heading(__('norikumi::filament/resources/assignment.sections.crew'))
                            ->schema([
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
                                Forms\Components\TextInput::make('premi')
                                    ->label(__('norikumi::filament/resources/assignment.fields.premi.label'))
                                    ->prefix('IDR')
                                    ->extraInputAttributes(['class' => 'text-right'])
                                    ->mask(
                                        fn (Forms\Components\TextInput\Mask $mask) => $mask
                                            ->numeric()
                                            ->decimalPlaces(0) // Set the number of digits after the decimal point.
                                            ->decimalSeparator(',') // Add a separator for decimal numbers.
                                            ->integer() // Disallow decimal numbers.
                                            ->mapToDecimalSeparator([',']) // Map additional characters to the decimal separator.
                                            ->minValue(0) // Set the minimum value that the number can be.
                                            ->maxValue(1_000_000_000) // Set the maximum value that the number can be.
                                            ->normalizeZeros() // Append or remove zeros at the end of the number.
                                            ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
                                            ->thousandsSeparator(','),// Add a separator for thousands.
                                    )
                                    ->required(),
                                Forms\Components\DatePicker::make('assigned_at')
                                    ->label(__('norikumi::filament/resources/assignment.fields.assigned_at.label'))
                                    ->displayFormat('d F Y')
                                    ->closeOnDateSelection()
                                    ->required(),
                            ])->columns(2),
                    ])->columnSpan(2),

                Forms\Components\Grid::make(4)
                    ->schema([
                        Forms\Components\Section::make('')
                            ->heading(__('norikumi::filament/resources/assignment.sections.sijil'))
                            ->schema([
                                Forms\Components\TextInput::make('place')
                                    ->label(__('norikumi::filament/resources/assignment.fields.place.label')),
                                Forms\Components\DatePicker::make('sijil_date')
                                    ->label(__('norikumi::filament/resources/assignment.fields.sijil_date.label'))
                                    ->displayFormat('d F Y')
                                    ->closeOnDateSelection(),
                            ])->columns(2),
                    ])->columnSpan(2),
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('vessel.name')
                    ->label(__('norikumi::filament/resources/assignment.columns.vessel.label')),
                Tables\Columns\TextColumn::make('position')
                    ->label(__('norikumi::filament/resources/assignment.columns.position.label'))
                    ->formatStateUsing(function (string $state) {
                        return __('norikumi::filament/resources/assignment.columns.position.options.' . $state);
                    }),
                Tables\Columns\TextColumn::make('grade')
                    ->label(__('norikumi::filament/resources/assignment.columns.grade.label'))
                    ->formatStateUsing(function (?string $state) {
                        return match ($state) {
                            1 => 'I',
                            2 => 'II',
                            3 => 'III',
                            4 => 'IV',
                            5 => 'V',
                            default => 'N/A',
                        };
                    }),
                Tables\Columns\TextColumn::make('assigned_at_formatted')
                    ->label(__('norikumi::filament/resources/assignment.columns.assigned_at_formatted.label')),
                Tables\Columns\TextColumn::make('retracted_at_formatted')
                    ->label(__('norikumi::filament/resources/assignment.columns.retracted_at_formatted.label')),
                Tables\Columns\TextColumn::make('seafare_code')
                    ->label(__('norikumi::filament/resources/assignment.columns.seafare_code.label'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('ship_owner')
                    ->label(__('norikumi::filament/resources/assignment.columns.ship_owner.label'))
                    ->formatStateUsing(function (string $state) {
                        return __('norikumi::filament/resources/assignment.columns.ship_owner.options.' . $state);
                    })
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('premi')
                    ->label(__('norikumi::filament/resources/assignment.columns.premi.label'))
                    ->formatStateUsing(function (?string $state) {
                        return is_null($state) ? null : number_format($state);
                    })
                    ->alignLeft()
                    ->extraAttributes(['class' => 'font-mono'])
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('place')
                    ->label(__('norikumi::filament/resources/assignment.columns.place.label'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('sijil_date_formatted')
                    ->label(__('norikumi::filament/resources/assignment.columns.sijil_date_formatted.label'))
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->visible(function (Livewire $livewire) {
                        $assignment = $livewire
                            ->getOwnerRecord()
                            ->assignments()
                            ->getQuery()
                            ->latest()
                            ->first()
                        ;

                        return is_null($assignment)
                            ? true
                            : isset($assignment->retracted_at);
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->hidden(function (Model $record) {
                        return isset($record->retracted_at);
                    }),
                Tables\Actions\DeleteAction::make()
                    ->hidden(function (Model $record) {
                        return isset($record->retracted_at);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
        ;
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }

    protected function getTableQuery(): Builder|Relation
    {
        return parent::getTableQuery()->orderBy('assigned_at');
    }

    protected static function getGenderOptions(): array
    {
        return [
            Gender::MALE => __('norikumi::filament/resources/assignment.fields.gender.options.' . Gender::MALE),
            Gender::FEMALE => __('norikumi::filament/resources/assignment.fields.gender.options.' . Gender::FEMALE),
        ];
    }

    protected static function getReligionOptions(): array
    {
        return [
            Religion::CATHOLIC => __('norikumi::filament/resources/assignment.fields.religion.options.' . Religion::CATHOLIC),
            Religion::ISLAM => __('norikumi::filament/resources/assignment.fields.religion.options.' . Religion::ISLAM),
            Religion::CHRISTIAN => __('norikumi::filament/resources/assignment.fields.religion.options.' . Religion::CHRISTIAN),
            Religion::BUDDHA => __('norikumi::filament/resources/assignment.fields.religion.options.' . Religion::BUDDHA),
            Religion::HINDU => __('norikumi::filament/resources/assignment.fields.religion.options.' . Religion::HINDU),
            Religion::CONFUCIOUS => __('norikumi::filament/resources/assignment.fields.religion.options.' . Religion::CONFUCIOUS),
            Religion::OTHERS => __('norikumi::filament/resources/assignment.fields.religion.options.' . Religion::OTHERS),
        ];
    }

    protected static function getBloodTypeOptions(): array
    {
        return [
            BloodType::TYPE_A => __('norikumi::filament/resources/assignment.fields.blood_type.options.' . BloodType::TYPE_A),
            BloodType::TYPE_B => __('norikumi::filament/resources/assignment.fields.blood_type.options.' . BloodType::TYPE_B),
            BloodType::TYPE_AB => __('norikumi::filament/resources/assignment.fields.blood_type.options.' . BloodType::TYPE_AB),
            BloodType::TYPE_O => __('norikumi::filament/resources/assignment.fields.blood_type.options.' . BloodType::TYPE_O),
        ];
    }

    protected static function getMaritalStatusOptions(): array
    {
        return [
            MaritalStatus::SINGLE => __('norikumi::filament/resources/employee.fields.marital_status.options.' . MaritalStatus::SINGLE),
            MaritalStatus::MARRIED => __('norikumi::filament/resources/employee.fields.marital_status.options.' . MaritalStatus::MARRIED),
            MaritalStatus::WIDOW => __('norikumi::filament/resources/employee.fields.marital_status.options.' . MaritalStatus::WIDOW),
            MaritalStatus::WIDOWER => __('norikumi::filament/resources/employee.fields.marital_status.options.' . MaritalStatus::WIDOWER),
        ];
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
            Position::MESS_BOY => __('norikumi::filament/resources/assignment.fields.position.options.' . Position::MESS_BOY),
        ];
    }

    protected static function getShipOwnerOptions(): array
    {
        return [
            ShipOwner::PT_LBN => __('norikumi::filament/resources/assignment.fields.ship_owner.options.' . ShipOwner::PT_LBN),
            ShipOwner::PT_LAI => __('norikumi::filament/resources/assignment.fields.ship_owner.options.' . ShipOwner::PT_LAI),
        ];
    }
}

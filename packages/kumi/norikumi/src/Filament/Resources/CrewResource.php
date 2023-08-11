<?php

namespace Kumi\Norikumi\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Kumi\Jinzai\Support\Enums\BloodType;
use Kumi\Jinzai\Support\Enums\Gender;
use Kumi\Jinzai\Support\Enums\MaritalStatus;
use Kumi\Jinzai\Support\Enums\Religion;
use Kumi\Norikumi\Filament\Resources\CrewResource\Pages;
use Kumi\Norikumi\Filament\Resources\CrewResource\RelationManagers;
use Kumi\Norikumi\Models\Crew;
use Kumi\Sousa\Models\Vessel;

class CrewResource extends Resource
{
    protected static ?string $model = Crew::class;

    protected static ?string $navigationGroup = 'norikumi';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 2101;

    protected static ?string $slug = 'norikumi/crews';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema(self::getPersonalInformationSchema()),
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('norikumi::filament/resources/crew.columns.name.label'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mobile')
                    ->label(__('norikumi::filament/resources/crew.columns.mobile.label'))
                    ->formatStateUsing(function (?string $state) {
                        return $state ? "+{$state}" : null;
                    })
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('gender')
                    ->label(__('norikumi::filament/resources/crew.columns.gender.label'))
                    ->formatStateUsing(function (?string $state) {
                        return $state ? __('norikumi::filament/resources/crew.fields.gender.options.' . $state) : null;
                    })
                    ->toggleable(),
                Tables\Columns\TextColumn::make('marital_status')
                    ->label(__('norikumi::filament/resources/crew.columns.marital_status.label'))
                    ->formatStateUsing(function (?string $state) {
                        return $state ? __('norikumi::filament/resources/crew.fields.marital_status.options.' . $state) : null;
                    })
                    ->toggleable(),
                Tables\Columns\TextColumn::make('religion')
                    ->label(__('norikumi::filament/resources/crew.columns.religion.label'))
                    ->formatStateUsing(function (?string $state) {
                        return $state ? __('norikumi::filament/resources/crew.fields.religion.options.' . $state) : null;
                    })
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('gender')
                    ->label(__('norikumi::filament/resources/crew.filters.gender.label'))
                    ->options(self::getGenderOptions()),
                SelectFilter::make('marital_status')
                    ->label(__('norikumi::filament/resources/crew.filters.marital_status.label'))
                    ->options(self::getMaritalStatusOptions()),
                SelectFilter::make('religion')
                    ->label(__('norikumi::filament/resources/crew.filters.religion.label'))
                    ->options(self::getReligionOptions()),
                SelectFilter::make('vessel')
                    ->label(__('norikumi::filament/resources/crew.filters.vessel.label'))
                    ->options(self::getVesselOptions())
                    ->query(function (Builder $query, array $data): Builder {
                        $vessel = $data['value'];

                        return $vessel
                            ? $query->byVessel($vessel)
                            : $query;
                    }),
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
            RelationManagers\PersonalIdentitiesRelationManager::class,
            RelationManagers\DocumentsRelationManager::class,
            RelationManagers\AddressesRelationManager::class,
            RelationManagers\RelativesRelationManager::class,
            RelationManagers\ContractsRelationManager::class,
            RelationManagers\AssignmentsRelationManager::class,
            RelationManagers\ActivitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCrews::route('/'),
            'create' => Pages\CreateCrew::route('/create'),
            'view' => Pages\ViewCrew::route('/{record}'),
            'edit' => Pages\EditCrew::route('/{record}/edit'),
        ];
    }

    public static function getPersonalInformationSchema(): array
    {
        return [
            Forms\Components\Grid::make(4)
                ->schema([
                    Forms\Components\View::make('norikumi::filament.forms.layouts.generic')
                        ->schema([
                            Forms\Components\SpatieMediaLibraryFileUpload::make('avatar')
                                ->avatar(),
                        ])
                        ->extraAttributes(['class' => 'h-full flex items-center justify-center']),
                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\Group::make([
                                Forms\Components\TextInput::make('name')
                                    ->label(__('norikumi::filament/resources/crew.fields.name.label'))
                                    ->required(),
                            ])
                                ->columns(2)
                                ->columnSpan(2),
                            Forms\Components\TextInput::make('mobile')
                                ->label(__('norikumi::filament/resources/crew.fields.mobile.label'))
                                ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask->pattern('+{62}00000000000'))
                                ->numeric()
                                ->required(),
                            Forms\Components\TextInput::make('landline')
                                ->label(__('norikumi::filament/resources/crew.fields.landline.label'))
                                ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask->pattern('+{62}00000000000'))
                                ->numeric()
                                ->nullable(),
                        ])->columnSpan(3),
                ]),
            Forms\Components\Grid::make(4)
                ->schema([
                    Forms\Components\Select::make('gender')
                        ->label(__('norikumi::filament/resources/crew.fields.gender.label'))
                        ->options(self::getGenderOptions())
                        ->required(),
                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\TextInput::make('place_of_birth')
                                ->label(__('norikumi::filament/resources/crew.fields.place_of_birth.label'))
                                ->nullable(),
                            Forms\Components\DatePicker::make('date_of_birth')
                                ->label(__('norikumi::filament/resources/crew.fields.date_of_birth.label'))
                                ->displayFormat('d F Y')
                                ->closeOnDateSelection()
                                ->required(),
                        ])->columnSpan(3),
                ]),
            Forms\Components\Grid::make(4)
                ->schema([
                    Forms\Components\View::make('norikumi::filament.forms.layouts.generic')
                        ->schema([
                            Forms\Components\Select::make('blood_type')
                                ->label(__('norikumi::filament/resources/crew.fields.blood_type.label'))
                                ->options(self::getBloodTypeOptions())
                                ->nullable(),
                        ]),
                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\Select::make('marital_status')
                                ->label(__('norikumi::filament/resources/crew.fields.marital_status.label'))
                                ->options(self::getMaritalStatusOptions())
                                ->required(),
                            Forms\Components\Select::make('religion')
                                ->label(__('norikumi::filament/resources/crew.fields.religion.label'))
                                ->options(self::getReligionOptions())
                                ->nullable(),
                        ])->columnSpan(3),
                ]),
        ];
    }

    protected static function getGenderOptions(): array
    {
        return [
            Gender::MALE => __('norikumi::filament/resources/crew.fields.gender.options.' . Gender::MALE),
            Gender::FEMALE => __('norikumi::filament/resources/crew.fields.gender.options.' . Gender::FEMALE),
        ];
    }

    protected static function getBloodTypeOptions(): array
    {
        return [
            BloodType::TYPE_A => __('norikumi::filament/resources/crew.fields.blood_type.options.' . BloodType::TYPE_A),
            BloodType::TYPE_B => __('norikumi::filament/resources/crew.fields.blood_type.options.' . BloodType::TYPE_B),
            BloodType::TYPE_AB => __('norikumi::filament/resources/crew.fields.blood_type.options.' . BloodType::TYPE_AB),
            BloodType::TYPE_O => __('norikumi::filament/resources/crew.fields.blood_type.options.' . BloodType::TYPE_O),
        ];
    }

    protected static function getMaritalStatusOptions(): array
    {
        return [
            MaritalStatus::SINGLE => __('norikumi::filament/resources/crew.fields.marital_status.options.' . MaritalStatus::SINGLE),
            MaritalStatus::MARRIED => __('norikumi::filament/resources/crew.fields.marital_status.options.' . MaritalStatus::MARRIED),
            MaritalStatus::WIDOW => __('norikumi::filament/resources/crew.fields.marital_status.options.' . MaritalStatus::WIDOW),
            MaritalStatus::WIDOWER => __('norikumi::filament/resources/crew.fields.marital_status.options.' . MaritalStatus::WIDOWER),
        ];
    }

    protected static function getReligionOptions(): array
    {
        return [
            Religion::CATHOLIC => __('norikumi::filament/resources/crew.fields.religion.options.' . Religion::CATHOLIC),
            Religion::ISLAM => __('norikumi::filament/resources/crew.fields.religion.options.' . Religion::ISLAM),
            Religion::CHRISTIAN => __('norikumi::filament/resources/crew.fields.religion.options.' . Religion::CHRISTIAN),
            Religion::BUDDHA => __('norikumi::filament/resources/crew.fields.religion.options.' . Religion::BUDDHA),
            Religion::HINDU => __('norikumi::filament/resources/crew.fields.religion.options.' . Religion::HINDU),
            Religion::CONFUCIOUS => __('norikumi::filament/resources/crew.fields.religion.options.' . Religion::CONFUCIOUS),
            Religion::OTHERS => __('norikumi::filament/resources/crew.fields.religion.options.' . Religion::OTHERS),
        ];
    }

    protected static function getVesselOptions(): array
    {
        return Vessel::operational()->get()
            ->pluck('name', 'id')
            ->toArray()
        ;
    }
}

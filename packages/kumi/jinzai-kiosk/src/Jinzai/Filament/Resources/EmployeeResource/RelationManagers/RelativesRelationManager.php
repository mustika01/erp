<?php

namespace Kumi\Jinzai\Filament\Resources\EmployeeResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Kumi\Jinzai\Support\Enums\Gender;
use Kumi\Jinzai\Support\Enums\Religion;
use Kumi\Jinzai\Support\Enums\BloodType;
use Kumi\Jinzai\Support\Enums\MaritalStatus;
use Filament\Resources\RelationManagers\RelationManager;

class RelativesRelationManager extends RelationManager
{
    protected static string $relationship = 'relatives';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('jinzai::filament/resources/relative.fields.name.label'))
                    ->required()
                    ->columnSpan(2),
                Forms\Components\TextInput::make('identity_card_number')
                    ->label(__('jinzai::filament/resources/relative.fields.identity_card_number.label'))
                    ->required()
                    ->columnSpan(2),
                Forms\Components\Select::make('gender')
                    ->label(__('jinzai::filament/resources/relative.fields.gender.label'))
                    ->options(self::getGenderOptions())
                    ->required(),
                Forms\Components\DatePicker::make('date_of_birth')
                    ->label(__('jinzai::filament/resources/relative.fields.date_of_birth.label'))
                    ->displayFormat('d F Y')
                    ->closeOnDateSelection()
                    ->required(),
                Forms\Components\TextInput::make('place_of_birth')
                    ->label(__('jinzai::filament/resources/relative.fields.place_of_birth.label'))
                    ->nullable()
                    ->columnSpan(2),
                Forms\Components\Select::make('religion')
                    ->label(__('jinzai::filament/resources/relative.fields.religion.label'))
                    ->options(self::getReligionOptions())
                    ->nullable(),
                Forms\Components\Select::make('blood_type')
                    ->label(__('jinzai::filament/resources/relative.fields.blood_type.label'))
                    ->options(self::getBloodTypeOptions())
                    ->nullable(),
                Forms\Components\TextInput::make('occupation')
                    ->label(__('jinzai::filament/resources/relative.fields.occupation.label'))
                    ->nullable()
                    ->columnSpan(2),
                Forms\Components\Select::make('marital_status')
                    ->label(__('jinzai::filament/resources/employee.fields.marital_status.label'))
                    ->options(self::getMaritalStatusOptions())
                    ->nullable(),
                Forms\Components\DatePicker::make('married_at')
                    ->label(__('jinzai::filament/resources/relative.fields.married_at.label'))
                    ->displayFormat('d F Y')
                    ->closeOnDateSelection()
                    ->nullable(),
                Forms\Components\TextInput::make('education')
                    ->label(__('jinzai::filament/resources/relative.fields.education.label'))
                    ->nullable()
                    ->columnSpan(2),
                Forms\Components\TextInput::make('relation')
                    ->label(__('jinzai::filament/resources/relative.fields.relation.label'))
                    ->required(),
                Forms\Components\TextInput::make('nationality')
                    ->label(__('jinzai::filament/resources/relative.fields.nationality.label'))
                    ->nullable(),
                Forms\Components\TextInput::make('passport_number')
                    ->label(__('jinzai::filament/resources/relative.fields.passport_number.label'))
                    ->nullable(),
                Forms\Components\TextInput::make('permanent_resident_card_number')
                    ->label(__('jinzai::filament/resources/relative.fields.permanent_resident_card_number.label'))
                    ->nullable(),
                Forms\Components\TextInput::make('father_name')
                    ->label(__('jinzai::filament/resources/relative.fields.father_name.label'))
                    ->nullable()
                    ->columnSpan(2),
                Forms\Components\TextInput::make('mother_name')
                    ->label(__('jinzai::filament/resources/relative.fields.mother_name.label'))
                    ->nullable()
                    ->columnSpan(2),
            ])
            ->columns(4)
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('jinzai::filament/resources/relative.columns.name.label')),
                Tables\Columns\TextColumn::make('identity_card_number')
                    ->label(__('jinzai::filament/resources/relative.columns.identity_card_number.label'))
                    ->toggleable()
                    ->extraAttributes(['class' => 'font-mono']),
                Tables\Columns\TextColumn::make('gender')
                    ->label(__('jinzai::filament/resources/relative.columns.gender.label'))
                    ->formatStateUsing(function (string $state) {
                        return __("jinzai::filament/resources/relative.columns.gender.options.{$state}");
                    })
                    ->toggleable(),
                Tables\Columns\TextColumn::make('relation')
                    ->label(__('jinzai::filament/resources/relative.columns.relation.label'))
                    ->toggleable(),
            ])
            ->filters([

            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }

    protected static function getGenderOptions(): array
    {
        return [
            Gender::MALE => __('jinzai::filament/resources/relative.fields.gender.options.' . Gender::MALE),
            Gender::FEMALE => __('jinzai::filament/resources/relative.fields.gender.options.' . Gender::FEMALE),
        ];
    }

    protected static function getReligionOptions(): array
    {
        return [
            Religion::CATHOLIC => __('jinzai::filament/resources/relative.fields.religion.options.' . Religion::CATHOLIC),
            Religion::ISLAM => __('jinzai::filament/resources/relative.fields.religion.options.' . Religion::ISLAM),
            Religion::CHRISTIAN => __('jinzai::filament/resources/relative.fields.religion.options.' . Religion::CHRISTIAN),
            Religion::BUDDHA => __('jinzai::filament/resources/relative.fields.religion.options.' . Religion::BUDDHA),
            Religion::HINDU => __('jinzai::filament/resources/relative.fields.religion.options.' . Religion::HINDU),
            Religion::CONFUCIOUS => __('jinzai::filament/resources/relative.fields.religion.options.' . Religion::CONFUCIOUS),
            Religion::OTHERS => __('jinzai::filament/resources/relative.fields.religion.options.' . Religion::OTHERS),
        ];
    }

    protected static function getBloodTypeOptions(): array
    {
        return [
            BloodType::TYPE_A => __('jinzai::filament/resources/relative.fields.blood_type.options.' . BloodType::TYPE_A),
            BloodType::TYPE_B => __('jinzai::filament/resources/relative.fields.blood_type.options.' . BloodType::TYPE_B),
            BloodType::TYPE_AB => __('jinzai::filament/resources/relative.fields.blood_type.options.' . BloodType::TYPE_AB),
            BloodType::TYPE_O => __('jinzai::filament/resources/relative.fields.blood_type.options.' . BloodType::TYPE_O),
        ];
    }

    protected static function getMaritalStatusOptions(): array
    {
        return [
            MaritalStatus::SINGLE => __('jinzai::filament/resources/employee.fields.marital_status.options.' . MaritalStatus::SINGLE),
            MaritalStatus::MARRIED => __('jinzai::filament/resources/employee.fields.marital_status.options.' . MaritalStatus::MARRIED),
            MaritalStatus::WIDOW => __('jinzai::filament/resources/employee.fields.marital_status.options.' . MaritalStatus::WIDOW),
            MaritalStatus::WIDOWER => __('jinzai::filament/resources/employee.fields.marital_status.options.' . MaritalStatus::WIDOWER),
        ];
    }
}

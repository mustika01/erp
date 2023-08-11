<?php

namespace Kumi\Jinzai\Filament\Resources\EmployeeResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Squire\Models\Country;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\RelationManagers\RelationManager;

class AddressesRelationManager extends RelationManager
{
    protected static string $relationship = 'addresses';

    protected static ?string $recordTitleAttribute = 'label';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('label')
                    ->label(__('jinzai::filament/resources/address.fields.label.label'))
                    ->required()
                    ->columnSpan(2),
                Forms\Components\Select::make('country_code_3')
                    ->label(__('jinzai::filament/resources/address.fields.country_code_3.label'))
                    ->options(Country::all()->pluck('name', 'code_3'))
                    ->default(function () {
                        $indonesia = Country::query()->where('name', 'Indonesia')->first();

                        return $indonesia->code_3;
                    })
                    ->required()
                    ->searchable(),
                Forms\Components\TextInput::make('zip_code')
                    ->label(__('jinzai::filament/resources/address.fields.zip_code.label'))
                    ->required(),
                Forms\Components\TextInput::make('street_line_1')
                    ->label(__('jinzai::filament/resources/address.fields.street_line_1.label'))
                    ->required()
                    ->columnSpan(3),
                Forms\Components\TextInput::make('state')
                    ->label(__('jinzai::filament/resources/address.fields.state.label'))
                    ->required(),
                Forms\Components\TextInput::make('street_line_2')
                    ->label(__('jinzai::filament/resources/address.fields.street_line_2.label'))
                    ->columnSpan(3),
                Forms\Components\TextInput::make('city')
                    ->label(__('jinzai::filament/resources/address.fields.city.label'))
                    ->required(),
            ])
            ->columns(4)
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->label(__('jinzai::filament/resources/address.columns.label.label')),
                Tables\Columns\TextColumn::make('street_line_1')
                    ->label(__('jinzai::filament/resources/address.columns.street_line_1.label'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('country_code_3')
                    ->label(__('jinzai::filament/resources/address.columns.country_code_3.label'))
                    ->formatStateUsing(function (?string $state) {
                        return is_null($state)
                            ? ''
                            : Country::query()->where('code_3', $state)->first()->name;
                    })
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('state')
                    ->label(__('jinzai::filament/resources/address.columns.state.label'))
                    ->toggleable(),
                Tables\Columns\TextColumn::make('city')
                    ->label(__('jinzai::filament/resources/address.columns.city.label'))
                    ->toggleable(),
                Tables\Columns\TextColumn::make('zip_code')
                    ->label(__('jinzai::filament/resources/address.columns.zip_code.label'))
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
}

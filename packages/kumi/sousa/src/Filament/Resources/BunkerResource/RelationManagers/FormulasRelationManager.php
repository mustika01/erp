<?php

namespace Kumi\Sousa\Filament\Resources\BunkerResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Livewire\Component as Livewire;
use Filament\Resources\RelationManagers\RelationManager;

class FormulasRelationManager extends RelationManager
{
    protected static string $relationship = 'formulas';

    protected static ?string $recordTitleAttribute = 'label';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('engine_id')
                    ->options(function (Livewire $livewire) {
                        return $livewire->getOwnerRecord()->engines()->pluck('label', 'id');
                    })
                    ->label(__('sousa::filament/resources/bunker-formula.fields.engine_id.label'))
                    ->required(),
                Forms\Components\TextInput::make('label')
                    ->label(__('sousa::filament/resources/bunker-formula.fields.label.label'))
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label(__('sousa::filament/resources/bunker-formula.fields.description.label'))
                    ->nullable(),
                Forms\Components\TextInput::make('hourly_consumption')
                    ->label(__('sousa::filament/resources/bunker-formula.fields.hourly_consumption.label'))
                    ->numeric()
                    ->suffix('ℓ/h')
                    ->mask(
                        fn (Forms\Components\TextInput\Mask $mask) => $mask
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(1000)
                            ->decimalPlaces(3) // Set the number of digits after the decimal point.
                            ->decimalSeparator('.') // Add a separator for decimal numbers.
                            ->normalizeZeros() // Append or remove zeros at the end of the number.
                            ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
                    )
                    ->required(),
            ])->columns(1)
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('engine.label')
                    ->label(__('sousa::filament/resources/bunker-formula.columns.engine.label')),
                Tables\Columns\TextColumn::make('label')
                    ->label(__('sousa::filament/resources/bunker-formula.columns.label.label')),
                Tables\Columns\TextColumn::make('hourly_consumption')
                    ->label(__('sousa::filament/resources/bunker-formula.columns.hourly_consumption.label'))
                    ->formatStateUsing(function (string $state) {
                        return "{$state} ℓ/h";
                    }),
            ])
            ->filters([

            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->disableCreateAnother()
                    ->modalWidth('sm'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalWidth('sm'),
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
        ;
    }
}

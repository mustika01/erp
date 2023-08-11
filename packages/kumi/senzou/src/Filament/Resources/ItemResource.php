<?php

namespace Kumi\Senzou\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Kumi\Senzou\Filament\Resources\ItemResource\Pages;
use Kumi\Senzou\Filament\Resources\ItemResource\RelationManagers\EntriesRelationManager;
use Kumi\Senzou\Models\Item;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $navigationGroup = 'senzou';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 4003;

    protected static ?string $slug = 'senzou/items';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('senzou::filament/resources/item.fields.name.label'))
                    ->nullable()
                    ->required()
                    ->columnSpan(2),
                Forms\Components\TextInput::make('unit_of_measurement')
                    ->label(__('senzou::filament/resources/item.fields.unit_of_measurement.label'))
                    ->nullable()
                    ->required(),
                Forms\Components\Textinput::make('measurement_symbol')
                    ->label(__('senzou::filament/resources/item.fields.measurement_symbol.label'))
                    ->nullable()
                    ->required(),
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('senzou::filament/resources/item.columns.name.label'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('unit_of_measurement')
                    ->label(__('senzou::filament/resources/item.columns.unit_of_measurement.label'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('measurement_symbol')
                    ->label(__('senzou::filament/resources/item.columns.measurement_symbol.label'))
                    ->searchable(),
            ])
            ->filters([
            ])
            ->actions([
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
            EntriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListItems::route('/'),
            // 'create' => Pages\CreateItem::route('/create'),
            'view' => Pages\ViewItem::route('/{record}'),
        ];
    }
}

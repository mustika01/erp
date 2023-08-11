<?php

namespace Kumi\Yoyaku\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Kumi\Yoyaku\Filament\Resources\BookableResource\Pages;
use Kumi\Yoyaku\Filament\Resources\BookableResource\Tables\Actions;
use Kumi\Yoyaku\Models\Bookable;

class BookableResource extends Resource
{
    protected static ?string $model = Bookable::class;

    protected static ?string $navigationGroup = 'yoyaku';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 5001;

    protected static ?string $slug = 'yoyaku/bookables';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('yoyaku::filament/resources/bookable.fields.name.label'))
                    ->required(),
            ])
            ->columns(1)
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('yoyaku::filament/resources/bookable.columns.name.label')),
            ])
            ->filters([
            ])
            ->actions([
                Actions\CalendarAction::make(),
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
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookables::route('/'),
            // 'create' => Pages\CreateBookable::route('/create'),
            // 'edit' => Pages\EditBookable::route('/{record}/edit'),
        ];
    }
}

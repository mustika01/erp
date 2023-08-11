<?php

namespace Kumi\Senzou\Filament\Resources\RequestNoteResource\RelationManagers;

use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class RequestNoteApprovedItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'approved_items';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('item.name')
                    ->label(__('senzou::filament/resources/request-note-approve-item.columns.name.label')),
                Tables\Columns\TextColumn::make('quantity')
                    ->label(__('senzou::filament/resources/request-note-approve-item.columns.quantity.label')),
                Tables\Columns\TextColumn::make('stock_on_vessel')
                    ->label(__('senzou::filament/resources/request-note-approve-item.columns.stock_on_vessel.label')),
                Tables\Columns\TextColumn::make('reason')
                    ->label(__('senzou::filament/resources/request-note-approve-item.columns.reason.label')),
            ])
            ->filters([
            ])
            ->headerActions([
            ])
            ->actions([
            ])
            ->bulkActions([
            ])
        ;
    }
}

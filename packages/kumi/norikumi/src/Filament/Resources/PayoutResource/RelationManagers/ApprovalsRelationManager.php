<?php

namespace Kumi\Norikumi\Filament\Resources\PayoutResource\RelationManagers;

use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class ApprovalsRelationManager extends RelationManager
{
    protected static string $relationship = 'approvals';

    protected static ?string $recordTitleAttribute = 'user.name';

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
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('norikumi::filament/resources/approval.columns.name.label')),
                Tables\Columns\TextColumn::make('created_date')
                    ->label(__('norikumi::filament/resources/approval.columns.created_date.label'))
                    ->alignRight(),
                Tables\Columns\TextColumn::make('created_time')
                    ->label(__('norikumi::filament/resources/approval.columns.created_time.label'))
                    ->alignRight(),
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

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}

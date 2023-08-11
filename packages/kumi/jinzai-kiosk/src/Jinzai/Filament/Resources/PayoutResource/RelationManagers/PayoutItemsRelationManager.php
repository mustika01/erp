<?php

namespace Kumi\Jinzai\Filament\Resources\PayoutResource\RelationManagers;

use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Kumi\Jinzai\Filament\Resources\PayoutResource\RelationManagers\Tables\Actions as TableActions;

class PayoutItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $recordTitleAttribute = 'description';

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
                Tables\Columns\TextColumn::make('description')
                    ->label(__('jinzai::filament/resources/payout.columns.description.label')),
                Tables\Columns\TextColumn::make('amount_formatted')
                    ->label(__('jinzai::filament/resources/payout.columns.amount.label'))
                    ->alignRight()
                    ->extraAttributes(['class' => 'font-mono text-right']),
            ])
            ->filters([
            ])
            ->headerActions([
                TableActions\CreateLoanAction::make(),
                TableActions\CreateAdjustmentAction::make(),
            ])
            ->actions([
                TableActions\EditAdjustmentAction::make(),
                TableActions\DeleteAdjustmentAction::make(),
                TableActions\EditLoanAction::make(),
                TableActions\DeleteLoanAction::make(),
            ])
            ->bulkActions([
            ])
            ->defaultSort('id')
        ;
    }

    protected function getTableHeading(): ?string
    {
        return $this->ownerRecord->description;
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}

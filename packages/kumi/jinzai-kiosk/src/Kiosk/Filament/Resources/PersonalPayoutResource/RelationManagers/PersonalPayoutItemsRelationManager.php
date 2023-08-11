<?php

namespace Kumi\Kiosk\Filament\Resources\PersonalPayoutResource\RelationManagers;

use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\RelationManagers\RelationManager;

class PersonalPayoutItemsRelationManager extends RelationManager
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
                    ->extraAttributes(['class' => 'font-mono']),
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

    protected function getTableHeading(): ?string
    {
        return $this->ownerRecord->description;
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}

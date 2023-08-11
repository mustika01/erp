<?php

namespace Kumi\Norikumi\Filament\Resources\PayrollResource\RelationManagers;

use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Kumi\Norikumi\Filament\Resources\PayoutResource;

class PayoutsRelationManager extends RelationManager
{
    protected static string $relationship = 'payouts';

    protected static ?string $recordTitleAttribute = 'label';

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
                    ->label(__('norikumi::filament/resources/payout.columns.description.label')),
                Tables\Columns\TextColumn::make('finalized_at')
                    ->label(__('norikumi::filament/resources/payout.columns.finalized_at.label'))
                    ->formatStateUsing(function (Carbon $state) {
                        return $state->format('d F Y');
                    }),
                Tables\Columns\TextColumn::make('take_home_pay_amount_formatted')
                    ->label(__('norikumi::filament/resources/payout.columns.take_home_pay_amount.label')),
            ])
            ->filters([
            ])
            ->headerActions([
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->url(function (Model $record) {
                        return PayoutResource::getUrl('view', [$record]);
                    }),
            ])
            ->bulkActions([
            ])
        ;
    }

    protected function getTableQuery(): Builder
    {
        $query = $this->getRelationship()->getQuery();

        return $query->latest();
    }
}

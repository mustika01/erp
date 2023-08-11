<?php

namespace Kumi\Norikumi\Filament\Resources\PayoutResource\RelationManagers;

use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Kumi\Norikumi\Support\Enums\DisbursementStatus;

class DisbursementsRelationManager extends RelationManager
{
    protected static string $relationship = 'disbursements';

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
                Tables\Columns\TextColumn::make('disbursement_method.bankShortCode')
                    ->label(__('norikumi::filament/resources/disbursement.columns.bank_name.label')),
                Tables\Columns\TextColumn::make('disbursement_method.bankAccountNo')
                    ->label(__('norikumi::filament/resources/disbursement.columns.account_number.label')),
                Tables\Columns\TextColumn::make('disbursement_method.bankAccountHoldername')
                    ->label(__('norikumi::filament/resources/disbursement.columns.account_name.label')),
                Tables\Columns\TextColumn::make('amount_formatted')
                    ->label(__('norikumi::filament/resources/disbursement.columns.amount.label')),
                Tables\Columns\BadgeColumn::make('status')
                    ->label(__('norikumi::filament/resources/disbursement.columns.status.label'))
                    ->enum([
                        DisbursementStatus::PENDING => __('jinzai::filament/resources/disbursement.columns.status.options.' . DisbursementStatus::PENDING),
                        DisbursementStatus::PROCESSING => __('jinzai::filament/resources/disbursement.columns.status.options.' . DisbursementStatus::PROCESSING),
                        DisbursementStatus::FAILED => __('jinzai::filament/resources/disbursement.columns.status.options.' . DisbursementStatus::FAILED),
                        DisbursementStatus::COMPLETED => __('jinzai::filament/resources/disbursement.columns.status.options.' . DisbursementStatus::COMPLETED),
                    ])
                    ->colors([
                        'primary' => fn (string $state) => $state === DisbursementStatus::PENDING || $state === DisbursementStatus::PROCESSING,
                        'danger' => fn (string $state) => $state === DisbursementStatus::FAILED,
                        'success' => fn (string $state) => $state === DisbursementStatus::COMPLETED,
                    ]),
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

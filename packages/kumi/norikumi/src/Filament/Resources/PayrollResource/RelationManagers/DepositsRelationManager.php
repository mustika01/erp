<?php

namespace Kumi\Norikumi\Filament\Resources\PayrollResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Carbon;
use Kumi\Norikumi\Actions\CalculateDepositAmountFinalDate;
use Kumi\Norikumi\Filament\Resources\PayrollResource\RelationManagers\DepositsRelationManager\Actions as TableActions;

class DepositsRelationManager extends RelationManager
{
    protected static string $relationship = 'deposits';

    protected static ?string $recordTitleAttribute = 'label';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(1)
                    ->schema([
                        Forms\Components\DatePicker::make('started_at')
                            ->label(__('norikumi::filament/resources/deposit.fields.started_at.label'))
                            ->displayFormat('d F Y')
                            // ->minDate(Carbon::now()->startOfMonth()->startOfDay())
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function (\Closure $get, \Closure $set) {
                                CalculateDepositAmountFinalDate::run($get, $set);
                            })
                            ->closeOnDateSelection(),
                        Forms\Components\DatePicker::make('finalized_at')
                            ->label(__('norikumi::filament/resources/deposit.fields.finalized_at.label'))
                            ->displayFormat('d F Y')
                            ->required()
                            ->disabled(),
                    ])->columnSpan(1),
                Forms\Components\Grid::make(1)
                    ->schema([
                        Forms\Components\TextInput::make('deposit_amount')
                            ->label(__('norikumi::filament/resources/deposit.fields.deposit_amount.label'))
                            ->prefix('IDR')
                            ->default(0)
                            ->required()
                            ->reactive()
                            ->extraInputAttributes(['class' => 'text-right'])
                            ->mask(
                                fn (Forms\Components\TextInput\Mask $mask) => $mask
                                    ->numeric()
                                    ->decimalPlaces(0) // Set the number of digits after the decimal point.
                                    ->decimalSeparator(',') // Add a separator for decimal numbers.
                                    ->integer() // Disallow decimal numbers.
                                    ->mapToDecimalSeparator([',']) // Map additional characters to the decimal separator.
                                    ->minValue(0) // Set the minimum value that the number can be.
                                    ->maxValue(5_000_000_000) // Set the maximum value that the number can be.
                                    ->normalizeZeros() // Append or remove zeros at the end of the number.
                                    ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
                                    ->thousandsSeparator(','), // Add a separator for thousands.
                            )
                            ->afterStateUpdated(function (\Closure $get, \Closure $set) {
                                CalculateDepositAmountFinalDate::run($get, $set);
                            }),
                        Forms\Components\TextInput::make('installment_amount')
                            ->label(__('norikumi::filament/resources/deposit.fields.installment_amount.label'))
                            ->prefix('IDR')
                            ->default(0)
                            ->required()
                            ->reactive()
                            ->extraInputAttributes(['class' => 'text-right'])
                            ->mask(
                                fn (Forms\Components\TextInput\Mask $mask) => $mask
                                    ->numeric()
                                    ->decimalPlaces(0) // Set the number of digits after the decimal point.
                                    ->decimalSeparator(',') // Add a separator for decimal numbers.
                                    ->integer() // Disallow decimal numbers.
                                    ->mapToDecimalSeparator([',']) // Map additional characters to the decimal separator.
                                    ->minValue(0) // Set the minimum value that the number can be.
                                    ->maxValue(100_000_000) // Set the maximum value that the number can be.
                                    ->normalizeZeros() // Append or remove zeros at the end of the number.
                                    ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
                                    ->thousandsSeparator(','), // Add a separator for thousands.
                            )
                            ->afterStateUpdated(function (\Closure $get, \Closure $set) {
                                CalculateDepositAmountFinalDate::run($get, $set);
                            }),
                    ])->columnSpan(1),
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('started_at')
                    ->label(__('norikumi::filament/resources/deposit.columns.started_at.label'))
                    ->formatStateUsing(function (Carbon $state) {
                        return $state->format('d F Y');
                    }),
                Tables\Columns\TextColumn::make('finalized_at')
                    ->label(__('norikumi::filament/resources/deposit.columns.finalized_at.label'))
                    ->formatStateUsing(function (Carbon $state) {
                        return $state->format('d F Y');
                    }),
                Tables\Columns\TextColumn::make('deposit_amount_formatted')
                    ->label(__('norikumi::filament/resources/deposit.columns.deposit_amount.label'))
                    ->alignRight()
                    ->extraAttributes(['class' => 'font-mono']),
                Tables\Columns\TextColumn::make('installment_amount_formatted')
                    ->label(__('norikumi::filament/resources/deposit.columns.installment_amount.label'))
                    ->alignRight()
                    ->extraAttributes(['class' => 'font-mono']),
            ])
            ->filters([
            ])
            ->headerActions([
                TableActions\CreateAction::make(),
            ])
            ->actions([
                TableActions\ApproveAction::make(),
                TableActions\DeleteAction::make(),
            ])
            ->bulkActions([
            ])
        ;
    }
}

<?php

namespace Kumi\Norikumi\Filament\Resources\PayoutResource\RelationManagers\Schemas;

use Filament\Forms;
use Kumi\Norikumi\Models\PayoutItem;

trait InteractsWithPayoutItemLoanSchema
{
    protected function getPayoutItemLoanSchema(): array
    {
        return [
            Forms\Components\Grid::make(4)
                ->schema([
                    Forms\Components\TextInput::make('description')
                        ->label(__('norikumi::filament/resources/payout-item.fields.description.label'))
                        ->default('Loan Payment')
                        ->columnSpan(3),
                    Forms\Components\TextInput::make('amount')
                        ->label(__('norikumi::filament/resources/payout-item.fields.amount.label'))
                        ->prefix('IDR')
                        ->default(0)
                        ->required()
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
                        ),
                    Forms\Components\Textarea::make('remarks')
                        ->label(__('norikumi::filament/resources/payout-item.fields.remarks.label'))
                        ->columnSpan(4),
                ]),
        ];
    }

    protected function getPayoutItemTypeOptions(): array
    {
        return [
            PayoutItem::TYPE_LOAN => __('norikumi::filament/resources/payout-item.fields.type.options.' . PayoutItem::TYPE_LOAN),
        ];
    }
}

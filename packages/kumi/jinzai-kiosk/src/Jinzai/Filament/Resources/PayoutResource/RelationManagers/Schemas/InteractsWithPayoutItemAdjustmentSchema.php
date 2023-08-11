<?php

namespace Kumi\Jinzai\Filament\Resources\PayoutResource\RelationManagers\Schemas;

use Filament\Forms;
use Illuminate\Database\Eloquent\Model;
use Kumi\Jinzai\Models\PayoutItem;

trait InteractsWithPayoutItemAdjustmentSchema
{
    protected function getPayoutItemAdjustmentSchema(): array
    {
        return [
            Forms\Components\Grid::make(4)
                ->schema([
                    Forms\Components\Select::make('type')
                        ->label(__('jinzai::filament/resources/payout-item.fields.type.label'))
                        ->options($this->getPayoutItemTypeOptions())
                        ->reactive()
                        ->afterStateUpdated(function (\Closure $set) {
                            $set('days_count', 0);
                            $set('amount', 0);
                        }),
                    Forms\Components\TextInput::make('days_count')
                        ->label(__('jinzai::filament/resources/payout-item.fields.days_count.label'))
                        ->numeric()
                        ->default(0)
                        ->required()
                        ->rules(['not_in:0'])
                        ->afterStateHydrated(function (\Closure $set, ?Model $record) {
                            $set('days_count', $record->properties['days_count'] ?? 0);
                        })
                        ->visible(function (\Closure $get) {
                            return $get('type') == PayoutItem::TYPE_ADJUSTMENT;
                        }),
                    Forms\Components\TextInput::make('amount')
                        ->label(__('jinzai::filament/resources/payout-item.fields.amount.label'))
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
                        )
                        ->visible(function (\Closure $get) {
                            return $get('type') == PayoutItem::TYPE_ATTENDANCE;
                        }),
                    Forms\Components\Textarea::make('remarks')
                        ->label(__('jinzai::filament/resources/payout-item.fields.remarks.label'))
                        ->columnSpan(4),
                ]),
        ];
    }

    protected function getPayoutItemTypeOptions(): array
    {
        return [
            PayoutItem::TYPE_ADJUSTMENT => __('jinzai::filament/resources/payout-item.fields.type.options.' . PayoutItem::TYPE_ADJUSTMENT),
            PayoutItem::TYPE_ATTENDANCE => __('jinzai::filament/resources/payout-item.fields.type.options.' . PayoutItem::TYPE_ATTENDANCE),
        ];
    }
}

<?php

namespace Kumi\Sousa\Filament\Resources\VesselVoyageResource\Traits;

use Filament\Forms;
use Filament\Tables;
use Illuminate\Support\Carbon;

trait InteractsWithCargoLogSchema
{
    protected static function getCargoLogSchema(bool $isLoading): array
    {
        return [
            Forms\Components\Hidden::make('is_loading')
                ->default($isLoading),
            Forms\Components\TextInput::make('tonnage_amount')
                ->label(__('sousa::filament/resources/cargo-log.fields.tonnage_amount.label'))
                ->numeric()
                ->required()
                ->mask(
                    fn (Forms\Components\TextInput\Mask $mask) => $mask
                        ->numeric()
                        ->decimalPlaces(2) // Set the number of digits after the decimal point.
                        ->decimalSeparator('.') // Add a separator for decimal numbers.
                        ->minValue(1) // Set the minimum value that the number can be.
                        ->maxValue(100_000) // Set the maximum value that the number can be.
                        ->normalizeZeros() // Append or remove zeros at the end of the number.
                        ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
                        ->thousandsSeparator(','), // Add a separator for thousands.
                )
                ->suffix('t'),
            Forms\Components\DatePicker::make('executed_at')
                ->label(__('sousa::filament/resources/cargo-log.fields.executed_at.label'))
                ->displayFormat('d F Y')
                ->required(),
            Forms\Components\RichEditor::make('remarks')
                ->label(__('sousa::filament/resources/cargo-log.fields.remarks.label'))
                ->nullable()
                ->toolbarButtons([
                    'bold',
                    'italic',
                    'redo',
                    'undo',
                ])
                ->columnSpan(2)
                ->extraInputAttributes(['style' => 'height: 192px;']),
        ];
    }

    protected static function getCargoLogTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('executed_at')
                ->label(__('sousa::filament/resources/cargo-log.columns.executed_at.label'))
                ->formatStateUsing(function (Carbon $state) {
                    return $state->format('d F Y');
                }),
            Tables\Columns\TextColumn::make('tonnage_amount_formatted')
                ->label(__('sousa::filament/resources/cargo-log.columns.tonnage_amount_formatted.label')),
        ];
    }
}

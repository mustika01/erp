<?php

namespace Kumi\Senzou\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Kumi\Senzou\Models\Item;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition()
    {
        $name = fake()->word();

        $unitOfMeasurement = fake()->randomElement([
            'litre',
            'meter',
            'kilogram',
            'tonnage',
        ]);

        $measurementSymbols = [
            'litre' => 'ℓ',
            'meter' => 'm',
            'kilogram' => 'Kg',
            'tonnage' => 't',
        ];

        return [
            'name' => "Item {$name}",
            'unit_of_measurement' => $unitOfMeasurement,
            'measurement_symbol' => $measurementSymbols[$unitOfMeasurement],
        ];
    }
}

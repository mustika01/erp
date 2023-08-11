<?php

namespace Kumi\Senzou\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Kumi\Senzou\Models\RequestNoteItem;
use Kumi\Senzou\Support\Enums\RequestNoteItemStatus;

class RequestNoteItemFactory extends Factory
{
    protected $model = RequestNoteItem::class;

    public function definition()
    {
        return [
            'name' => fake()->word(),
            'quantity' => fake()->numberBetween(1, 100),
            'stock_on_vessel' => fake()->numberBetween(1, 100),
            'reason' => fake()->sentence(),
            'status' => RequestNoteItemStatus::PENDING,
        ];
    }
}

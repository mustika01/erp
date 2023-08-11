<?php

namespace Kumi\Senzou\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Kumi\Senzou\Models\DeliveryNote;
use Kumi\Senzou\Models\DeliveryNoteEntry;
use Kumi\Senzou\Models\Item;
use Kumi\Senzou\Support\Enums\DeliveryNoteEntryRemarks;

class DeliveryNoteEntryFactory extends Factory
{
    protected $model = DeliveryNoteEntry::class;

    public function definition()
    {
        return [
            'delivery_note_id' => DeliveryNote::factory(),
            'item_id' => Item::factory(),
            'quantity' => fake()->numberBetween(0, 100),
            'remarks' => fake()->randomElement([
                DeliveryNoteEntryRemarks::DECK,
                DeliveryNoteEntryRemarks::ENGINE,
            ]),
        ];
    }

    /**
     * Indicate that the model is for deck.
     */
    public function deck()
    {
        return $this->state(function (array $attributes) {
            return [
                'remarks' => DeliveryNoteEntryRemarks::DECK,
            ];
        });
    }

    /**
     * Indicate that the model is for engine.
     */
    public function engine()
    {
        return $this->state(function (array $attributes) {
            return [
                'remarks' => DeliveryNoteEntryRemarks::ENGINE,
            ];
        });
    }
}

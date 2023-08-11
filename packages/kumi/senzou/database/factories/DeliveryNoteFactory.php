<?php

namespace Kumi\Senzou\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Kumi\Senzou\Models\DeliveryNote;

class DeliveryNoteFactory extends Factory
{
    protected $model = DeliveryNote::class;

    public function definition()
    {
        return [
            'date' => fake()->dateTimeBetween('-3 months'),
            'committed_at' => null,
        ];
    }

    /**
     * Indicate that the model has been committed.
     */
    public function committed()
    {
        return $this->state(function (array $attributes) {
            return [
                'committed_at' => now(),
            ];
        });
    }
}

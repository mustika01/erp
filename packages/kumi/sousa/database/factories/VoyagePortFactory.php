<?php

namespace Kumi\Sousa\Database\Factories;

use Kumi\Sousa\Models\VoyageCity;
use Kumi\Sousa\Models\VoyagePort;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class VoyagePortFactory extends Factory
{
    protected $model = VoyagePort::class;

    public function definition()
    {
        return [
            'city_id' => VoyageCity::factory(),

            'name' => 'Port ' . $this->faker->lastName,
        ];
    }
}

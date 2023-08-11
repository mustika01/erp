<?php

namespace Kumi\Sousa\Database\Factories;

use Kumi\Sousa\Models\VoyageCity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class VoyageCityFactory extends Factory
{
    protected $model = VoyageCity::class;

    public function definition()
    {
        return [

            'name' => $this->faker->lastName . ' City',

        ];
    }
}

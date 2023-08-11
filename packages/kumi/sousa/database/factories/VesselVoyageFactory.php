<?php

namespace Kumi\Sousa\Database\Factories;

use Kumi\Sousa\Models\Vessel;
use Kumi\Sousa\Models\VoyagePort;
use Kumi\Sousa\Models\VesselVoyage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\WaitingForDeparture;
use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\WaitingForInstructions;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class VesselVoyageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model|TModel>
     */
    protected $model = VesselVoyage::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $return = false;
        $number = $this->faker->numberBetween(100, 999);
        $content = $this->faker->randomElement(['Cement', 'Steel Plates', 'Mixed']);
        $originPort = VoyagePort::factory()->create();
        $destinationPort = VoyagePort::factory()->create();

        return [
            'vessel_id' => Vessel::factory(),

            'number' => $number,
            'is_returning' => $return,
            'cargo_content' => $content,

            'origin_city_id' => $originPort->city_id,
            'origin_port_id' => $originPort->id,
            'destination_city_id' => $destinationPort->city_id,
            'destination_port_id' => $destinationPort->id,

            'status' => $return ? WaitingForDeparture::class : WaitingForInstructions::class,
        ];
    }

    public function return()
    {
        return $this->state(function (array $attributes) {
            return [
                'number' => null,
                'is_returning' => true,
                'cargo_content' => null,
            ];
        });
    }
}

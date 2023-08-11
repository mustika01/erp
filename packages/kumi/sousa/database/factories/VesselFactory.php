<?php

namespace Kumi\Sousa\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Kumi\Sousa\Models\Vessel;
use Kumi\Sousa\Support\Enums\VesselClassification;
use Kumi\Sousa\Support\Enums\VesselStatus;
use Kumi\Sousa\Support\Enums\VesselType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class VesselFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model|TModel>
     */
    protected $model = Vessel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->name;

        return [
            'name' => $name,
            'slug' => Str::slug($name),

            'properties' => [
                'vessel_type' => $this->faker->randomElement([
                    VesselType::MOTOR_VESSEL,
                    VesselType::TUG_BOAT,
                    VesselType::BARGE,
                    VesselType::TANKER,
                ]),
                'registration_port' => $this->faker->randomElement(['Batam', 'Cilegon']),
                'flag_nationality' => 'Indonesia',

                'registration_number' => null,
                'imo_number' => null,
                'call_sign' => null,
                'classification' => $this->faker->randomElement([
                    VesselClassification::BKI,
                    null,
                ]),

                'status' => $this->faker->randomElement([
                    VesselStatus::OPERATIONAL,
                    VesselStatus::SOLD,
                    VesselStatus::SCRAPPED,
                ]),
                'year_built' => $this->faker->numberBetween(2000, 2010),
                'builder_name' => null,
                'hull_material' => null,

                'length' => $this->faker->randomFloat(2, 60, 80),
                'breadth' => $this->faker->randomFloat(2, 10, 15),
                'depth' => $this->faker->randomFloat(2, 4, 5),
                'draft' => $this->faker->randomFloat(2, 3, 4),

                'gross_tonnage' => $tonnage = $this->faker->numberBetween(500, 1000),
                'nett_tonnage' => $tonnage - $this->faker->numberBetween(50, 100),
                'dead_weight_tonnage' => $tonnage - $this->faker->numberBetween(50, 100),

                'main_engine' => 'MAIN ENGINE',
                'aux_engine' => null,
                'crane_description' => 'CRANE',
                'average_cruise_speed' => $this->faker->randomFloat(1, 10, 20),

                'last_docked_at' => Carbon::parse($this->faker->dateTimeBetween('-3 months'))->toDateString(),
                'next_docked_at' => Carbon::parse($this->faker->dateTimeBetween('+2 years', '+3 years'))->toDateString(),
            ],
        ];
    }

    public function operational()
    {
        return $this->state(function (array $attributes) {
            return [
                'properties' => [
                    'status' => VesselStatus::OPERATIONAL,
                ],
            ];
        });
    }

    public function sold()
    {
        return $this->state(function (array $attributes) {
            return [
                'properties' => [
                    'status' => VesselStatus::SOLD,
                ],
            ];
        });
    }

    public function scrapped()
    {
        return $this->state(function (array $attributes) {
            return [
                'properties' => [
                    'status' => VesselStatus::SCRAPPED,
                ],
            ];
        });
    }
}

<?php

namespace Kumi\Norikumi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Kumi\Norikumi\Models\Contract;
use Kumi\Norikumi\Models\Crew;
use Kumi\Norikumi\Support\Enums\Position;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ContractFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model|TModel>
     */
    protected $model = Contract::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'crew_id' => Crew::factory(),
            'position' => $this->faker->randomElement([
                Position::NAHKODA,
                Position::MUALIM,
                Position::KKM,
                Position::MASINIS,
                Position::BOSUN,
                Position::KELASI,
                Position::MANDOR,
                Position::JURU_MUDI,
                Position::JURU_MINYAK,
                Position::JURU_MASAK,
                Position::CADET_DECK,
                Position::CADET_ENGINE,
                Position::WIPER,
                Position::CRANE_OPERATOR,
            ]),
            'started_at' => $this->faker->dateTimeBetween('-2 years', '-1 years'),
            'ended_at' => $this->faker->dateTimeBetween('-1 years', 'now'),
        ];
    }
}

<?php

namespace Kumi\Norikumi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use Kumi\Norikumi\Models\Crew;
use Kumi\Norikumi\Models\Identity;
use Kumi\Norikumi\Support\Enums\IdentityGroup;
use Kumi\Norikumi\Support\Enums\IdentityType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class IdentityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model|TModel>
     */
    protected $model = Identity::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'crew_id' => Crew::factory(),
            'group' => IdentityGroup::PERSONAL,
        ];
    }

    public function expired()
    {
        return $this->state([
            'expired_at' => $this->faker->dateTimeBetween('-5 years', 'now'),
        ]);
    }

    public function passport()
    {
        return $this->state([
            'type' => IdentityType::PASSPORT,
            'number' => Collection::make([
                strtoupper($this->faker->randomLetter()),
                strtoupper($this->faker->randomLetter()),
                ' ',
                $this->faker->numberBetween(100000, 999999),
            ])->implode(''),
            'expired_at' => $this->faker->dateTimeBetween('now', '+5 years'),
            'group' => IdentityGroup::PERSONAL,
        ]);
    }

    public function family_card()
    {
        return $this->state([
            'type' => IdentityType::FAMILY_CARD,
            'number' => Collection::make([
                $this->faker->numberBetween(1000, 9999),
                $this->faker->numberBetween(1000, 9999),
                $this->faker->numberBetween(1000, 9999),
                $this->faker->numberBetween(1000, 9999),
            ])->implode(''),
            'group' => IdentityGroup::PERSONAL,
        ]);
    }

    public function identity_card()
    {
        return $this->state([
            'type' => IdentityType::IDENTITY_CARD,
            'number' => Collection::make([
                $this->faker->numberBetween(1000, 9999),
                $this->faker->numberBetween(1000, 9999),
                $this->faker->numberBetween(1000, 9999),
                $this->faker->numberBetween(1000, 9999),
            ])->implode(''),
            'group' => IdentityGroup::PERSONAL,
        ]);
    }

    public function driving_license()
    {
        return $this->state([
            'type' => IdentityType::DRIVING_LICENSE,
            'number' => Collection::make([
                $this->faker->numberBetween(1000, 9999),
                '-',
                $this->faker->numberBetween(100000, 999999),
            ])->implode(''),
            'expired_at' => $this->faker->dateTimeBetween('now', '+5 years'),
            'group' => IdentityGroup::PERSONAL,
        ]);
    }
}

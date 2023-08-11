<?php

namespace Kumi\Jinzai\Database\Factories;

use Kumi\Jinzai\Models\Employee;
use Kumi\Jinzai\Models\Identity;
use Illuminate\Support\Collection;
use Kumi\Jinzai\Support\Enums\IdentityType;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'employee_id' => Employee::factory(),
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
        ]);
    }
}

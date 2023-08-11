<?php

namespace Kumi\Norikumi\Database\Factories;

use Kumi\Norikumi\Models\Crew;
use Illuminate\Support\Collection;
use Kumi\Norikumi\Models\Relative;
use Kumi\Jinzai\Support\Enums\Gender;
use Kumi\Jinzai\Support\Enums\Religion;
use Kumi\Jinzai\Support\Enums\BloodType;
use Kumi\Jinzai\Support\Enums\MaritalStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class RelativeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model|TModel>
     */
    protected $model = Relative::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'crew_id' => Crew::factory(),

            'name' => $this->faker->name,
            'identity_card_number' => Collection::make([
                $this->faker->numberBetween(1000, 9999),
                $this->faker->numberBetween(1000, 9999),
                $this->faker->numberBetween(1000, 9999),
                $this->faker->numberBetween(1000, 9999),
            ])->implode(''),
            'gender' => $this->faker->randomElement([
                Gender::MALE,
                Gender::FEMALE,
            ]),
            'place_of_birth' => $this->faker->city(),
            'date_of_birth' => $this->faker->date('Y-m-d', '31 December 1950'),
            'religion' => $this->faker->randomElement([
                Religion::CATHOLIC,
                Religion::ISLAM,
                Religion::CHRISTIAN,
                Religion::BUDDHA,
                Religion::HINDU,
                Religion::CONFUCIOUS,
                Religion::OTHERS,
            ]),
            'blood_type' => $this->faker->randomElement([
                BloodType::TYPE_A,
                BloodType::TYPE_B,
                BloodType::TYPE_AB,
                BloodType::TYPE_O,
            ]),
            'marital_status' => $this->faker->randomElement([
                MaritalStatus::SINGLE,
                MaritalStatus::MARRIED,
                MaritalStatus::WIDOW,
                MaritalStatus::WIDOWER,
            ]),
            'married_at' => function (array $attributes) {
                return $attributes['marital_status'] === MaritalStatus::SINGLE
                    ? null
                    : $this->faker->date('Y-m-d', '31 December 1975', '31 December 2000');
            },
            'relation' => $this->faker->randomElement([
                'Family Head',
                'House Wife',
                'Child',
            ]),
            'nationality' => 'Indonesian',
            'father_name' => $this->faker->name,
            'mother_name' => $this->faker->name,
        ];
    }

    public function family_head()
    {
        return $this->state([
            'gender' => Gender::MALE,
            'relation' => 'Family Head',
        ]);
    }

    public function house_wife()
    {
        return $this->state([
            'gender' => Gender::FEMALE,
            'relation' => 'House Wife',
        ]);
    }

    public function children()
    {
        return $this->state([
            'relation' => 'Child',
        ]);
    }
}

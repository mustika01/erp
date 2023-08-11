<?php

namespace Kumi\Jinzai\Database\Factories;

use Kumi\Tobira\Models\User;
use Kumi\Jinzai\Models\Employee;
use Kumi\Jinzai\Support\Enums\Gender;
use Kumi\Jinzai\Models\OnboardingLink;
use Kumi\Jinzai\Support\Enums\Religion;
use Kumi\Jinzai\Support\Enums\BloodType;
use Kumi\Jinzai\Support\Enums\MaritalStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model|TModel>
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),

            'mobile' => '62' . $this->faker->randomElement(['812', '823', '834']) . $this->faker->numberBetween(0, 99999999),
            'landline' => '62' . $this->faker->randomElement(['21', '31', '41']) . $this->faker->numberBetween(0, 9999999),
            'place_of_birth' => $this->faker->city(),
            'date_of_birth' => $this->faker->date('Y-m-d', '31 December 2000'),
            'gender' => $this->faker->randomElement([
                Gender::MALE,
                Gender::FEMALE,
            ]),
            'marital_status' => $this->faker->randomElement([
                MaritalStatus::SINGLE,
                MaritalStatus::MARRIED,
                MaritalStatus::WIDOW,
                MaritalStatus::WIDOWER,
            ]),
            'blood_type' => $this->faker->randomElement([
                BloodType::TYPE_A,
                BloodType::TYPE_B,
                BloodType::TYPE_AB,
                BloodType::TYPE_O,
            ]),
            'religion' => $this->faker->randomElement([
                Religion::CATHOLIC,
                Religion::ISLAM,
                Religion::CHRISTIAN,
                Religion::BUDDHA,
                Religion::HINDU,
                Religion::CONFUCIOUS,
                Religion::OTHERS,
            ]),
        ];
    }

    public function onboarded()
    {
        return $this->state([
            'onboarded_at' => $this->faker->dateTimeBetween('-5 years'),
        ])->has(OnboardingLink::factory(), 'onboardingLink');
    }
}

<?php

namespace Kumi\Jinzai\Database\Factories;

use Illuminate\Support\Str;
use Kumi\Jinzai\Models\Employee;
use Kumi\Jinzai\Models\OnboardingLink;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class OnboardingLinkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model|TModel>
     */
    protected $model = OnboardingLink::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'employee_id' => Employee::factory(),

            'token' => Str::random(32),
            'expired_at' => $this->faker->dateTimeBetween('now', '+1 month'),
        ];
    }

    public function expired()
    {
        return $this->state([
            'expired_at' => $this->faker->dateTimeBetween('-5 years'),
        ]);
    }
}

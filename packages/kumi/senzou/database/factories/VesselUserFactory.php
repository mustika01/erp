<?php

namespace Kumi\Senzou\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Kumi\Senzou\Models\VesselUser;
use Kumi\Senzou\Support\Enums\Position;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class VesselUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model|TModel>
     */
    protected $model = VesselUser::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'position' => $this->faker->randomElement([
                Position::NAHKODA,
                Position::KKM,
                Position::CHIEF_OFFICER,
            ]),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];
    }

    public function nahkoda()
    {
        return $this->state([
            'position' => Position::NAHKODA,
        ]);
    }

    public function kkm()
    {
        return $this->state([
            'position' => Position::KKM,
        ]);
    }

    public function chief_officer()
    {
        return $this->state([
            'position' => Position::CHIEF_OFFICER,
        ]);
    }
}

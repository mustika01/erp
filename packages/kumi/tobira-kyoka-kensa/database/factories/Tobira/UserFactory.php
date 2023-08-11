<?php

namespace Kumi\Tobira\Database\Factories;

use Illuminate\Support\Str;
use Kumi\Tobira\Models\User;
use Laravel\Fortify\RecoveryCode;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model|TModel>
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'activated_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the model's email address should be inactive.
     *
     * @return static
     */
    public function inactive()
    {
        return $this->state(function (array $attributes) {
            return [
                'activated_at' => null,
            ];
        });
    }

    /**
     * Indicate that the model has two factor authentication enabled.
     *
     * @return static
     */
    public function two_factor_authentication_enabled()
    {
        return $this->state(function (array $attributes) {
            return [
                'two_factor_secret' => encrypt('THISIS4THESECRET'),
                'two_factor_recovery_codes' => encrypt(
                    json_encode(
                        Collection::times(8, function () {
                            return RecoveryCode::generate();
                        })->all()
                    )
                ),
                'two_factor_confirmed_at' => now(),
            ];
        });
    }
}

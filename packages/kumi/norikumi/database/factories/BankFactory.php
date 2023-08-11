<?php

namespace Kumi\Norikumi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Kumi\Norikumi\Models\Bank;
use Kumi\Norikumi\Models\Payroll;
use Kumi\Norikumi\Support\Enums\BankProvider;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class BankFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model|TModel>
     */
    protected $model = Bank::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'payroll_id' => Payroll::factory(),

            'bank_name' => $this->faker->randomElement([
                BankProvider::BCA,
                BankProvider::MANDIRI,
                BankProvider::BNI,
                BankProvider::BRI,
                BankProvider::BSI,
                BankProvider::BTN,
            ]),
            'account_number' => $this->faker->numberBetween(1_000_000_000, 2_000_000_000),
            'account_holder_name' => $this->faker->name(),
            'is_primary' => false,
        ];
    }

    /**
     * Indicate that the bank is primary.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function primary()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_primary' => true,
            ];
        });
    }
}

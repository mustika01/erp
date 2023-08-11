<?php

namespace Kumi\Norikumi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Kumi\Norikumi\Models\Crew;
use Kumi\Norikumi\Models\Payroll;
use Kumi\Norikumi\Support\Enums\CoveringEntity;
use Kumi\Norikumi\Support\Enums\NonTaxableIncomeStatus;
use Kumi\Norikumi\Support\Enums\SalaryType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PayrollFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model|TModel>
     */
    protected $model = Payroll::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $salary = $this->faker->numberBetween(10, 500) * 100_000;

        return [
            'crew_id' => Crew::factory(),

            'salary' => $salary,

            'salary_type' => $this->faker->randomElement([
                SalaryType::MONTHLY,
                SalaryType::WEEKLY,
                SalaryType::DAILY,
            ]),
            'salary_grade' => $this->faker->numberBetween(10, 20),

            'tax_number' => Str::of('')
                ->append($this->faker->numberBetween(10, 99))
                ->append('.')
                ->append($this->faker->numberBetween(100, 999))
                ->append('.')
                ->append($this->faker->numberBetween(100, 999))
                ->append('.')
                ->append($this->faker->numberBetween(1, 9))
                ->append('-')
                ->append($this->faker->numberBetween(100, 999))
                ->append('.')
                ->append('000')
                ->toString(),
            'non_taxable_income_status' => $this->faker->randomElement([
                NonTaxableIncomeStatus::SINGLE_ZERO_DEPENDANT,
                NonTaxableIncomeStatus::SINGLE_ONE_DEPENDANT,
                NonTaxableIncomeStatus::SINGLE_TWO_DEPENDANTS,
                NonTaxableIncomeStatus::SINGLE_THREE_DEPENDANTS,
                NonTaxableIncomeStatus::MARRIED_ZERO_DEPENDANT,
                NonTaxableIncomeStatus::MARRIED_ONE_DEPENDANT,
                NonTaxableIncomeStatus::MARRIED_TWO_DEPENDANTS,
                NonTaxableIncomeStatus::MARRIED_THREE_DEPENDANTS,
            ]),

            'social_security_number' => Collection::make([
                $this->faker->numberBetween(1000, 9999),
                $this->faker->numberBetween(1000, 9999),
                $this->faker->numberBetween(1000, 9999),
                $this->faker->numberBetween(1000, 9999),
            ])->implode(''),

            'health_care_number' => Collection::make([
                '0',
                $this->faker->numberBetween(1000, 9999),
                $this->faker->numberBetween(1000, 9999),
                $this->faker->numberBetween(1000, 9999),
            ])->implode(''),
            'health_care_family_count' => $this->faker->numberBetween(0, 10),
            'health_care_covering_entity' => $this->faker->randomElement([
                CoveringEntity::COMPANY,
                CoveringEntity::CREW,
            ]),
        ];
    }
}

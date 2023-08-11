<?php

namespace Kumi\Jinzai\Database\Factories;

use Kumi\Jinzai\Models\Employee;
use Kumi\Jinzai\Models\Department;
use Kumi\Jinzai\Models\Employment;
use Kumi\Jinzai\Models\JobPosition;
use Kumi\Jinzai\Support\Enums\EmploymentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class EmploymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model|TModel>
     */
    protected $model = Employment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'employee_id' => Employee::factory(),
            'department_id' => Department::factory(),
            'job_position_id' => JobPosition::factory(),

            'status' => $this->faker->randomElement([
                EmploymentStatus::PERMANENT,
                EmploymentStatus::CONTRACT,
                EmploymentStatus::PROBATION,
            ]),
            'joined_at' => $this->faker->dateTimeBetween('-2 years'),
        ];
    }
}

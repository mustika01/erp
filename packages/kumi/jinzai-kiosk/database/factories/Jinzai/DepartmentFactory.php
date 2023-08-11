<?php

namespace Kumi\Jinzai\Database\Factories;

use Kumi\Jinzai\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class DepartmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model|TModel>
     */
    protected $model = Department::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'Marketing',
                'Sales',
                'Finance',
                'Human Resource',
                'Purchasing',
                'Operational',
            ]),
        ];
    }
}

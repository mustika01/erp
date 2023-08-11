<?php

namespace Kumi\Jinzai\Database\Factories;

use Kumi\Jinzai\Models\Department;
use Kumi\Jinzai\Models\JobPosition;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class JobPositionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model|TModel>
     */
    protected $model = JobPosition::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'department_id' => Department::factory(),

            'name' => $this->faker->jobTitle(),
            'level' => 1,
        ];
    }
}

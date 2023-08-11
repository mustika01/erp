<?php

namespace Kumi\Sousa\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Kumi\Sousa\Models\BunkerFormula;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class BunkerFormulaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model|TModel>
     */
    protected $model = BunkerFormula::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'label' => 'Sailing',
            'description' => 'Sailing',
            'hourly_consumption' => 150,
        ];
    }
}

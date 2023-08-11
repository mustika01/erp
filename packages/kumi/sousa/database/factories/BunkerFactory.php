<?php

namespace Kumi\Sousa\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Kumi\Sousa\Models\Bunker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class BunkerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model|TModel>
     */
    protected $model = Bunker::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'rob_amount' => 0,
        ];
    }
}

<?php

namespace Kumi\Jinzai\Database\Factories;

use Kumi\Tobira\Models\User;
use Kumi\Kiosk\Models\PersonalTicket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PersonalTicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model|TModel>
     */
    protected $model = PersonalTicket::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'employee_id' => User::factory(),

        ];
    }
}

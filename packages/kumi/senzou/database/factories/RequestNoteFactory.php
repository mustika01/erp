<?php

namespace Kumi\Senzou\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Kumi\Senzou\Models\RequestNote;
use Kumi\Senzou\Models\VesselUser;
use Kumi\Senzou\Support\Enums\RequestNoteDeliveryRequirements;
use Kumi\Senzou\Support\Enums\RequestNoteRemarks;
use Kumi\Senzou\Support\Enums\RequestNoteStatus;

class RequestNoteFactory extends Factory
{
    protected $model = RequestNote::class;

    public function definition()
    {
        return [
            'vessel_user_id' => VesselUser::factory(),

            'location' => fake()->randomElement([
                'Jakarta',
                'Surabaya',
            ]),

            'voyage_number' => fake()->numberBetween(1, 100),

            // 'remarks' => fake()->randomElement([
            //     RequestNoteRemarks::DECK,
            //     RequestNoteRemarks::ENGINE,
            // ]),

            'delivery_requirement' => fake()->randomElement([
                RequestNoteDeliveryRequirements::NORMAL,
                RequestNoteDeliveryRequirements::URGENT,
            ]),

            'status' => RequestNoteStatus::PENDING,
        ];
    }

    public function engine()
    {
        return $this->state(function () {
            return [
                'remarks' => RequestNoteRemarks::ENGINE,
            ];
        });
    }

    public function deck()
    {
        return $this->state(function () {
            return [
                'remarks' => RequestNoteRemarks::DECK,
            ];
        });
    }
}

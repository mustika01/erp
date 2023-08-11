<?php

namespace Kumi\Senzou\Database\Seeders;

use Illuminate\Database\Seeder;
use Kumi\Senzou\Models\RequestNote;
use Kumi\Senzou\Models\RequestNoteItem;
use Kumi\Senzou\Models\VesselUser;
use Kumi\Senzou\Support\Enums\Position;

class RequestNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VesselUser::query()
            ->where('position', Position::KKM)
            ->get()
            ->each(function (VesselUser $user) {
                RequestNote::factory()
                    ->count(3)
                    ->has(RequestNoteItem::factory()->count(3), 'items')
                    ->engine()
                    ->create([
                        'vessel_user_id' => $user->id,
                    ])
                ;
            })
        ;

        VesselUser::query()
            ->where('position', Position::CHIEF_OFFICER)
            ->get()
            ->each(function (VesselUser $user) {
                RequestNote::factory()
                    ->count(3)
                    ->has(RequestNoteItem::factory()->count(3), 'items')
                    ->deck()
                    ->create([
                        'vessel_user_id' => $user->id,
                    ])
                ;
            })
        ;
    }
}

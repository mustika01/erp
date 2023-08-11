<?php

namespace Kumi\Senzou\Database\Seeders;

use Illuminate\Database\Seeder;
use Kumi\Senzou\Models\VesselUser;
use Kumi\Sousa\Models\Vessel;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VesselUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vessels = Vessel::query()->inRandomOrder()->take(2)->get();

        $vesselA = $vessels->first();
        $vesselB = $vessels->last();

        VesselUser::factory()->nahkoda()->create([
            'vessel_id' => $vesselA,
            'email' => 'jack@example.com',
        ]);

        VesselUser::factory()->kkm()->create([
            'vessel_id' => $vesselA,
            'email' => 'will@example.com',
        ]);

        VesselUser::factory()->chief_officer()->create([
            'vessel_id' => $vesselA,
            'email' => 'elizabeth@example.com',
        ]);

        VesselUser::factory()->nahkoda()->create([
            'vessel_id' => $vesselB,
            'email' => 'red@example.com',
        ]);

        VesselUser::factory()->kkm()->create([
            'vessel_id' => $vesselB,
            'email' => 'green@example.com',
        ]);

        VesselUser::factory()->chief_officer()->create([
            'vessel_id' => $vesselB,
            'email' => 'blue@example.com',
        ]);
    }
}

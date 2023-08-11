<?php

namespace Kumi\Senzou\Database\Seeders;

use Illuminate\Database\Seeder;
use Kumi\Senzou\Models\DeliveryNote;
use Kumi\Senzou\Models\DeliveryNoteEntry;
use Kumi\Sousa\Models\Vessel;

class DeliveryNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vesselA = Vessel::query()->inRandomOrder()->first();
        $vesselB = Vessel::query()->inRandomOrder()->first();

        DeliveryNote::factory()
            ->count(5)
            ->has(
                DeliveryNoteEntry::factory()
                    ->count(3),
                'entries'
            )
            ->create([
                'vessel_id' => $vesselA->id,
            ])
        ;

        DeliveryNote::factory()
            ->count(5)
            ->has(
                DeliveryNoteEntry::factory()
                    ->count(3),
                'entries'
            )
            ->create([
                'vessel_id' => $vesselB->id,
            ])
        ;
    }
}

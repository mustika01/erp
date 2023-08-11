<?php

namespace Kumi\Sousa\Database\Seeders;

use Illuminate\Database\Seeder;
use Kumi\Sousa\Models\Bunker;
use Kumi\Sousa\Models\BunkerEngine;
use Kumi\Sousa\Models\BunkerFormula;
use Kumi\Sousa\Models\Vessel;

class BunkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vessel::all()->each(function (Vessel $vessel) {
            $bunker = Bunker::factory()->create([
                'vessel_id' => $vessel->id,
            ]);

            $engine = BunkerEngine::factory()->make();

            $bunker->engines()->save($engine);

            $formula = BunkerFormula::factory()->make([
                'engine_id' => $engine->id,
            ]);

            $bunker->formulas()->save($formula);
        });
    }
}

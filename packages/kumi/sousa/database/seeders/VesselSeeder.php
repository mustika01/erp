<?php

namespace Kumi\Sousa\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Kumi\Sousa\Models\Vessel;
use Kumi\Sousa\Models\VesselVoyage;

class VesselSeeder extends Seeder
{
    protected array $vessels = [
        [
            'name' => 'STB 14',
            'tracking_asset_id' => 2619847,
            'tracking_provider_name' => 'vessel-pro',
        ],
        [
            'name' => 'Bahari 25',
            'tracking_asset_id' => 2639028,
            'tracking_provider_name' => 'vessel-pro',
        ],
        [
            'name' => 'Bahari 38',
            'tracking_asset_id' => 4318076,
            'tracking_provider_name' => 'vessel-pro',
        ],
        [
            'name' => 'HTS 88',
            'tracking_asset_id' => 4321557,
            'tracking_provider_name' => 'vessel-pro',
        ],
        [
            'name' => 'STB 28',
            'tracking_asset_id' => 4326681,
            'tracking_provider_name' => 'vessel-pro',
        ],
        [
            'name' => 'HTS 23',
            'tracking_asset_id' => 4328509,
            'tracking_provider_name' => 'vessel-pro',
        ],
        [
            'name' => 'HTS 68',
            'tracking_asset_id' => 4345904,
            'tracking_provider_name' => 'vessel-pro',
        ],
        [
            'name' => 'Bahari 27',
            'tracking_asset_id' => 50554,
            'tracking_provider_name' => 'vessel-pro',
        ],

        [
            'name' => 'LBN 3',
            'tracking_asset_id' => 69,
            'tracking_provider_name' => 'geo-track',
        ],
        [
            'name' => 'HTS 38',
            'tracking_asset_id' => 70,
            'tracking_provider_name' => 'geo-track',
        ],
        [
            'name' => 'Cakra 17',
            'tracking_asset_id' => 71,
            'tracking_provider_name' => 'geo-track',
        ],
        [
            'name' => 'STB 16',
            'tracking_asset_id' => 72,
            'tracking_provider_name' => 'geo-track',
        ],
        [
            'name' => 'HTS 67',
            'tracking_asset_id' => 75,
            'tracking_provider_name' => 'geo-track',
        ],
        [
            'name' => 'LBN 1',
            'tracking_asset_id' => 77,
            'tracking_provider_name' => 'geo-track',
        ],
        [
            'name' => 'HTS 30',
            'tracking_asset_id' => 79,
            'tracking_provider_name' => 'geo-track',
        ],
        [
            'name' => 'Delta 1',
            'tracking_asset_id' => 87,
            'tracking_provider_name' => 'geo-track',
        ],
        [
            'name' => 'STB 23',
            'tracking_asset_id' => 338,
            'tracking_provider_name' => 'geo-track',
        ],
        [
            'name' => 'AKIRA',
            'tracking_asset_id' => 728,
            'tracking_provider_name' => 'geo-track',
        ],
        [
            'name' => 'LBN 5',
            'tracking_asset_id' => 729,
            'tracking_provider_name' => 'geo-track',
        ],
        [
            'name' => 'ARLYN',
            'tracking_asset_id' => 753,
            'tracking_provider_name' => 'geo-track',
        ],
        [
            'name' => 'LBN 2',
            'tracking_asset_id' => 535947,
            'tracking_provider_name' => 'argos-monitoring',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Collection::make($this->vessels)->each(function (array $attributes) {
            $attributes['slug'] = Str::slug($attributes['name']);

            Vessel::factory()
                ->has(VesselVoyage::factory()->count(random_int(1, 5)), 'voyages')
                ->create($attributes)
            ;
        });
    }
}

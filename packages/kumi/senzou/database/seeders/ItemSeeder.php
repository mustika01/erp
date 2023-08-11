<?php

namespace Kumi\Senzou\Database\Seeders;

use Illuminate\Database\Seeder;
use Kumi\Senzou\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::factory()->count(10)->create();
    }
}

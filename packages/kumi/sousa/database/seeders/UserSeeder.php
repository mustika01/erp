<?php

namespace Kumi\Sousa\Database\Seeders;

use Illuminate\Database\Seeder;
use Kumi\Kyoka\Support\DefaultRoles as KyokaRoles;
use Kumi\Sousa\Support\DefaultRoles as SousaRoles;
use Kumi\Tobira\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $norikumi = User::factory()->create([
            'name' => 'Subasa',
            'email' => 'subasa.om@example.com',
        ]);

        $norikumi->assignRole(SousaRoles::OPERATIONAL_MANAGER);
        $norikumi->assignRole(KyokaRoles::FILAMENT_USER);

        $norikumi = User::factory()->create([
            'name' => 'Masaki',
            'email' => 'masaki.aoa@example.com',
        ]);

        $norikumi->assignRole(SousaRoles::OPERATIONAL_ASSISTANT);
        $norikumi->assignRole(KyokaRoles::FILAMENT_USER);
    }
}

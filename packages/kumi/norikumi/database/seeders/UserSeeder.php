<?php

namespace Kumi\Norikumi\Database\Seeders;

use Illuminate\Database\Seeder;
use Kumi\Kyoka\Support\DefaultRoles as KyokaRoles;
use Kumi\Norikumi\Support\DefaultRoles as NorikumiRoles;
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
            'name' => 'Naruto',
            'email' => 'naruto.crm@example.com',
        ]);

        $norikumi->assignRole(NorikumiRoles::CREWING_MANAGER);
        $norikumi->assignRole(KyokaRoles::FILAMENT_USER);

        $norikumi = User::factory()->create([
            'name' => 'Sasuke',
            'email' => 'sasuke.cra@example.com',
        ]);

        $norikumi->assignRole(NorikumiRoles::CREWING_ASSISTANT);
        $norikumi->assignRole(KyokaRoles::FILAMENT_USER);

        $norikumi = User::factory()->create([
            'name' => 'Konoha',
            'email' => 'konoha.cru@example.com',
        ]);

        $norikumi->assignRole(NorikumiRoles::CREWING_USER);
        $norikumi->assignRole(KyokaRoles::FILAMENT_USER);
    }
}

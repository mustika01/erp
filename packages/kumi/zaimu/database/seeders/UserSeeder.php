<?php

namespace Kumi\Zaimu\Database\Seeders;

use Kumi\Tobira\Models\User;
use Illuminate\Database\Seeder;
use Kumi\Kyoka\Support\DefaultRoles as KyokaDefaultRoles;
use Kumi\Zaimu\Support\DefaultRoles as ZaimuDefaultRoles;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $red = User::factory()->create([
            'name' => 'Red Finance',
            'email' => 'red.finance@example.com',
        ]);

        $red->assignRole(ZaimuDefaultRoles::FINANCE_MANAGER);
        $red->assignRole(KyokaDefaultRoles::FILAMENT_USER);

        $green = User::factory()->create([
            'name' => 'Green Finance',
            'email' => 'green.finance@example.com',
        ]);

        $green->assignRole(ZaimuDefaultRoles::FINANCE_ASSISTANT);
        $green->assignRole(KyokaDefaultRoles::FILAMENT_USER);

        $blue = User::factory()->create([
            'name' => 'Blue Finance',
            'email' => 'blue.finance@example.com',
        ]);

        $blue->assignRole(ZaimuDefaultRoles::FINANCE_USER);
        $blue->assignRole(KyokaDefaultRoles::FILAMENT_USER);
    }
}

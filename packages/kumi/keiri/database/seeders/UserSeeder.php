<?php

namespace Kumi\Keiri\Database\Seeders;

use Kumi\Tobira\Models\User;
use Illuminate\Database\Seeder;
use Kumi\Keiri\Support\DefaultRoles as KeiriDefaultRoles;
use Kumi\Kyoka\Support\DefaultRoles as KyokaDefaultRoles;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $red = User::factory()->create([
            'name' => 'Appetizer',
            'email' => 'appetizer.accounting@example.com',
        ]);

        $red->assignRole(KeiriDefaultRoles::ACCOUNTING_MANAGER);
        $red->assignRole(KyokaDefaultRoles::FILAMENT_USER);

        $green = User::factory()->create([
            'name' => 'Main Course',
            'email' => 'main.accounting@example.com',
        ]);

        $green->assignRole(KeiriDefaultRoles::ACCOUNTING_ASSISTANT);
        $green->assignRole(KyokaDefaultRoles::FILAMENT_USER);

        $blue = User::factory()->create([
            'name' => 'Dessert',
            'email' => 'dessert.accounting@example.com',
        ]);

        $blue->assignRole(KeiriDefaultRoles::ACCOUNTING_USER);
        $blue->assignRole(KyokaDefaultRoles::FILAMENT_USER);
    }
}

<?php

namespace Kumi\Tobira\Database\Seeders;

use Illuminate\Database\Seeder;
use Kumi\Kyoka\Support\DefaultRoles;
use Kumi\Tobira\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jack = User::factory()->create([
            'name' => 'Jack Sparrow',
            'email' => 'jack@example.com',
        ]);

        $jack->assignRole(DefaultRoles::SUPER_ADMINISTRATOR);
        $jack->assignRole(DefaultRoles::FILAMENT_USER);

        $will = User::factory()->create([
            'name' => 'Will Turner',
            'email' => 'will@example.com',
        ]);

        $will->assignRole(DefaultRoles::ADMINISTRATOR);
        $will->assignRole(DefaultRoles::FILAMENT_USER);

        $swann = User::factory()->create([
            'name' => 'Elizabeth Swann',
            'email' => 'swann@example.com',
        ]);

        $swann->assignRole(DefaultRoles::FILAMENT_USER);

        $gibbs = User::factory()->unverified()->inactive()->create([
            'name' => 'Joshamee Gibbs',
            'email' => 'gibbs@example.com',
        ]);

        $gibbs->assignRole(DefaultRoles::FILAMENT_USER);
    }
}

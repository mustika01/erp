<?php

namespace Kumi\Jinzai\Database\Seeders;

use Illuminate\Database\Seeder;
use Kumi\Jinzai\Support\DefaultRoles as JinzaiRoles;
use Kumi\Kyoka\Support\DefaultRoles as KyokaRoles;
use Kumi\Tobira\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $anna = User::factory()->create([
            'name' => 'Anna HC',
            'email' => 'anna.hc@example.com',
        ]);

        $anna->assignRole(JinzaiRoles::HUMAN_CAPITAL_MANAGER);
        $anna->assignRole(KyokaRoles::FILAMENT_USER);

        $elsa = User::factory()->create([
            'name' => 'Elsa HC',
            'email' => 'elsa.hc@example.com',
        ]);

        $elsa->assignRole(JinzaiRoles::HUMAN_CAPITAL_ASSISTANT);
        $elsa->assignRole(KyokaRoles::FILAMENT_USER);

        $kristoff = User::factory()->create([
            'name' => 'Kristoff HC',
            'email' => 'kristoff.hc@example.com',
        ]);

        $kristoff->assignRole(JinzaiRoles::HUMAN_CAPITAL_USER);
        $kristoff->assignRole(KyokaRoles::FILAMENT_USER);

        $zeno = User::factory()->create([
            'name' => 'Zeno Zup',
            'email' => 'zeno@example.com',
        ]);

        $zeno->assignRole(JinzaiRoles::LEGAL_OFFICER);
        $zeno->assignRole(KyokaRoles::FILAMENT_USER);
    }
}

<?php

namespace Kumi\Norikumi\Database\Seeders;

use Illuminate\Database\Seeder;
use Kumi\Norikumi\Models\Address;
use Kumi\Norikumi\Models\Bank;
use Kumi\Norikumi\Models\Crew;
use Kumi\Norikumi\Models\Identity;
use Kumi\Norikumi\Models\Payroll;
use Kumi\Norikumi\Models\Relative;

class CrewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Crew::factory()
            ->count(10)
            ->has(Identity::factory()->passport())
            ->has(Identity::factory()->family_card())
            ->has(Identity::factory()->identity_card())
            ->has(Identity::factory()->driving_license())
            ->has(Relative::factory()->family_head())
            ->has(Relative::factory()->house_wife())
            ->has(Relative::factory()->children()->count(2))
            ->has(Address::factory())
            ->has(
                Payroll::factory()
                    ->has(Bank::factory())
                    ->has(Bank::factory()->primary())
            )
            ->create()
        ;
    }
}

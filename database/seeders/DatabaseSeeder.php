<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Kumi\Jinzai\Database\Seeders\DepartmentSeeder;
use Kumi\Jinzai\Database\Seeders\EmployeeSeeder;
use Kumi\Jinzai\Database\Seeders\UserSeeder as JinzaiUserSeeder;
use Kumi\Kanri\Database\Seeders\EmployeeSeeder as KanriEmployeeSeeder;
use Kumi\Kanshi\Database\Seeders\ActivitySeeder;
use Kumi\Keiri\Database\Seeders\UserSeeder as KeiriUserSeeder;
use Kumi\Norikumi\Database\Seeders\CrewSeeder;
use Kumi\Norikumi\Database\Seeders\UserSeeder as NorikumiUserSeeder;
use Kumi\Senzou\Database\Seeders\DeliveryNoteSeeder;
use Kumi\Senzou\Database\Seeders\ItemSeeder as SenzouItemSeeder;
use Kumi\Senzou\Database\Seeders\RequestNoteSeeder;
use Kumi\Senzou\Database\Seeders\VesselUserSeeder;
use Kumi\Sousa\Database\Seeders\BunkerSeeder;
use Kumi\Sousa\Database\Seeders\EmployeeSeeder as SousaEmployeeSeeder;
use Kumi\Sousa\Database\Seeders\UserSeeder as SousaUserSeeder;
use Kumi\Sousa\Database\Seeders\VesselSeeder;
use Kumi\Tobira\Database\Seeders\UserSeeder;
use Kumi\Zaimu\Database\Seeders\UserSeeder as ZaimuUserSeeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(JinzaiUserSeeder::class);
        $this->call(ZaimuUserSeeder::class);
        $this->call(KeiriUserSeeder::class);
        $this->call(NorikumiUserSeeder::class);

        $this->call(DepartmentSeeder::class);

        $this->call(EmployeeSeeder::class);
        $this->call(KanriEmployeeSeeder::class);
        $this->call(SousaEmployeeSeeder::class);

        $this->call(ActivitySeeder::class);

        $this->call(VesselSeeder::class);
        $this->call(BunkerSeeder::class);
        $this->call(SousaUserSeeder::class);

        $this->call(CrewSeeder::class);

        $this->call(VesselUserSeeder::class);
        $this->call(RequestNoteSeeder::class);
        $this->call(DeliveryNoteSeeder::class);

        $this->call(SenzouItemSeeder::class);
    }
}

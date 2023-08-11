<?php

namespace Kumi\Kanshi\Database\Seeders;

use Kumi\Tobira\Models\User;
use Illuminate\Database\Seeder;
use Kumi\Kanshi\Models\Activity;
use Kumi\Kyoka\Support\DefaultRoles;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::role(DefaultRoles::FILAMENT_USER)->get();

        Activity::factory()
            ->count(100)
            ->afterCreating(function (Activity $activity) use ($users) {
                $activity->subject()->associate($users->random());
                $activity->causer()->associate($users->random());
                $activity->save();
            })
            ->create()
        ;
    }
}

<?php

namespace Kumi\Sousa\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Kumi\Jinzai\Models\Address;
use Kumi\Jinzai\Models\Bank;
use Kumi\Jinzai\Models\Department;
use Kumi\Jinzai\Models\Employee;
use Kumi\Jinzai\Models\Employment;
use Kumi\Jinzai\Models\Identity;
use Kumi\Jinzai\Models\Payroll;
use Kumi\Jinzai\Models\Relative;
use Kumi\Kyoka\Support\DefaultRoles;
use Kumi\Sousa\Support\DefaultRoles as SousaDefaultRoles;

class EmployeeSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::factory()
            ->onboarded()
            ->has(Identity::factory()->passport())
            ->has(Identity::factory()->family_card())
            ->has(Identity::factory()->identity_card())
            ->has(Identity::factory()->driving_license())
            ->has(Relative::factory()->family_head())
            ->has(Relative::factory()->house_wife())
            ->has(Relative::factory()->children()->count(2))
            ->has(
                Payroll::factory()
                    ->has(Bank::factory())
            )
            ->has(Address::factory())
            ->afterCreating(function (Employee $employee) {
                $user = $employee->user;
                $user->assignRole(DefaultRoles::FILAMENT_USER);
                $user->assignRole(SousaDefaultRoles::OPERATIONAL_MONITORING_USER);

                $user->forceFill([
                    'name' => 'tsubasa',
                    'email' => 'tsubasa@example.com',
                ])->save();

                $department = Department::query()->inRandomOrder()->first();
                $position = $department->positions->random();
                $employment = Employment::factory()->make([
                    'employee_id' => $employee->id,
                    'department_id' => $department->id,
                    'job_position_id' => $position->id,

                    'contract_ended_at' => Carbon::now()->addMonth(),
                ]);

                $employee->employments()->save($employment);
            })
            ->create()
        ;
    }
}

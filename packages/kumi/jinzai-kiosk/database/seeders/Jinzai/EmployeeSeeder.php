<?php

namespace Kumi\Jinzai\Database\Seeders;

use Kumi\Jinzai\Models\Bank;
use Illuminate\Database\Seeder;
use Kumi\Jinzai\Models\Address;
use Kumi\Jinzai\Models\Payroll;
use Kumi\Jinzai\Models\Employee;
use Kumi\Jinzai\Models\Identity;
use Kumi\Jinzai\Models\Relative;
use Kumi\Jinzai\Models\Department;
use Kumi\Jinzai\Models\Employment;
use Kumi\Kyoka\Support\DefaultRoles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Kumi\Kiosk\Support\DefaultRoles as KioskDefaultRoles;

class EmployeeSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::factory()
            ->count(5)
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
                    ->has(Bank::factory()->primary())
            )
            ->has(Address::factory())
            ->afterCreating(function (Employee $employee) {
                $user = $employee->user;
                $user->assignRole(DefaultRoles::FILAMENT_USER);
                $user->assignRole(KioskDefaultRoles::EMPLOYEE);

                $department = Department::query()->inRandomOrder()->first();
                $position = $department->positions->random();
                $employment = Employment::factory()->make([
                    'employee_id' => $employee->id,
                    'department_id' => $department->id,
                    'job_position_id' => $position->id,
                ]);

                $employee->employments()->save($employment);
            })
            ->create()
        ;

        Employee::factory()
            ->count(5)
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
                    ->has(Bank::factory()->primary())
            )
            ->has(Address::factory())
            ->afterCreating(function (Employee $employee) {
                $user = $employee->user;
                $user->assignRole(DefaultRoles::FILAMENT_USER);
                $user->assignRole(KioskDefaultRoles::EMPLOYEE);

                $department = Department::query()->inRandomOrder()->first();
                $position = $department->positions->random();
                $employment = Employment::factory()->make([
                    'employee_id' => $employee->id,
                    'department_id' => $department->id,
                    'job_position_id' => $position->id,
                ]);

                $employee->employments()->save($employment);
            })
            ->create()
        ;

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
                    ->has(Bank::factory()->primary())
            )
            ->has(Address::factory())
            ->afterCreating(function (Employee $employee) {
                $user = $employee->user;
                $user->assignRole(DefaultRoles::FILAMENT_USER);
                $user->assignRole(KioskDefaultRoles::EMPLOYEE);

                $user->forceFill([
                    'name' => 'John Doe',
                    'email' => 'john@example.com',
                ])->save();

                $department = Department::query()->inRandomOrder()->first();
                $position = $department->positions->random();
                $employment = Employment::factory()->make([
                    'employee_id' => $employee->id,
                    'department_id' => $department->id,
                    'job_position_id' => $position->id,
                ]);

                $employee->employments()->save($employment);
            })
            ->create()
        ;

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
                    ->has(Bank::factory()->primary())
            )
            ->has(Address::factory())
            ->afterCreating(function (Employee $employee) {
                $user = $employee->user;
                $user->assignRole(DefaultRoles::FILAMENT_USER);
                $user->assignRole(KioskDefaultRoles::EMPLOYEE);

                $user->forceFill([
                    'name' => 'Jane Doe',
                    'email' => 'jane@example.com',
                ])->save();

                $department = Department::query()->inRandomOrder()->first();
                $position = $department->positions->random();
                $employment = Employment::factory()->make([
                    'employee_id' => $employee->id,
                    'department_id' => $department->id,
                    'job_position_id' => $position->id,
                ]);

                $employee->employments()->save($employment);
            })
            ->create()
        ;
    }
}

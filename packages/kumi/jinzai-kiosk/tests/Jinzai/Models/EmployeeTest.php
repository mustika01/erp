<?php

namespace Kumi\Jinzai\Tests\Models;

use Kumi\Jinzai\Models\Employee;
use Kumi\Jinzai\Models\Department;
use Kumi\Jinzai\Models\Employment;
use Kumi\Jinzai\Models\JobPosition;
use Kumi\AbstractJinzaiKiosk\Tests\TestCase;

/**
 * @internal
 */
class EmployeeTest extends TestCase
{
    /** @test */
    public function it_can_get_activity_log_name_attribute(): void
    {
        $employee = Employee::factory()->make();

        $this->assertEquals($employee->user->name, $employee->activity_log_name);
    }

    /** @test */
    public function it_can_get_internal_id_attribute(): void
    {
        $employee = Employee::factory()
            ->afterCreating(function (Employee $employee) {
                $department = Department::factory()
                    ->has(JobPosition::factory(), 'positions')
                    ->create()
                ;
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

        $employment = $employee->latestActiveEmployment;
        $department = $employment->department->code;
        $position = $employment->position->code;

        $expected = "{$department}.{$position}.{$employee->code}";

        $this->assertEquals($expected, $employee->internal_id);
    }
}

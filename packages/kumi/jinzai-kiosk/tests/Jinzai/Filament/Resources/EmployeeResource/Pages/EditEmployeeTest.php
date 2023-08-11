<?php

namespace Kumi\Jinzai\Tests\Filament\Resources\EmployeeResource\Pages;

use Livewire\Livewire;
use Kumi\Tobira\Models\User;
use Kumi\Jinzai\Models\Employee;
use Kumi\Jinzai\Filament\Resources\EmployeeResource;
use Kumi\AbstractJinzaiKiosk\Tests\AdministratorTestCase;
use Kumi\Jinzai\Filament\Resources\EmployeeResource\Pages\EditEmployee;

/**
 * @internal
 */
class EditEmployeeTest extends AdministratorTestCase
{
    /** @test */
    public function it_can_render_edit_employee_form(): void
    {
        $response = $this->get(EmployeeResource::getUrl('edit', [
            'record' => Employee::factory()->create(),
        ]));

        $response->assertOk();
    }

    /** @test */
    public function it_can_retrieve_employee_data(): void
    {
        $employee = Employee::factory()->create();
        $user = $employee->user;

        Livewire::test(EditEmployee::class, [
            'record' => $employee->getKey(),
        ])
            ->assertSet('data.user.name', $user->name)
            ->assertSet('data.user.email', $user->email)
            ->assertSet('data.mobile', $employee->mobile)
            ->assertSet('data.landline', $employee->landline)
            ->assertSet('data.place_of_birth', $employee->place_of_birth)
            ->assertSet('data.date_of_birth', $employee->date_of_birth)
            ->assertSet('data.gender', $employee->gender)
            ->assertSet('data.marital_status', $employee->marital_status)
            ->assertSet('data.religion', $employee->religion)
        ;
    }

    /** @test */
    public function it_can_update_employee_data(): void
    {
        $employee = Employee::factory()->create();
        $employeeData = Employee::factory()->make();
        $userData = User::factory()->make();

        Livewire::test(EditEmployee::class, [
            'record' => $employee->getKey(),
        ])
            ->set('data.user.name', $userData->name)
            ->set('data.user.email', $userData->email)
            ->set('data.mobile', $employeeData->mobile)
            ->set('data.landline', $employeeData->landline)
            ->set('data.place_of_birth', $employeeData->place_of_birth)
            ->set('data.date_of_birth', $employeeData->date_of_birth)
            ->set('data.gender', $employeeData->gender)
            ->set('data.marital_status', $employeeData->marital_status)
            ->set('data.religion', $employeeData->religion)
            ->call('save')
            ->assertHasNoErrors()
        ;

        tap($employee->fresh(), function (Employee $employee) use ($employeeData, $userData) {
            $user = $employee->user;

            $this->assertEquals($userData->name, $user->name);
            $this->assertEquals($userData->email, $user->email);
            $this->assertEquals($employeeData->mobile, $employee->mobile);
            $this->assertEquals($employeeData->landline, $employee->landline);
            $this->assertEquals($employeeData->place_of_birth, $employee->place_of_birth);
            $this->assertEquals($employeeData->date_of_birth, $employee->date_of_birth);
            $this->assertEquals($employeeData->gender, $employee->gender);
            $this->assertEquals($employeeData->marital_status, $employee->marital_status);
            $this->assertEquals($employeeData->religion, $employee->religion);
        });
    }

    /** @test */
    public function it_can_validate_employee_data(): void
    {
        $employee = Employee::factory()->create();
        $employeeData = Employee::factory()->make();
        $userData = User::factory()->make();

        // required name attribute
        Livewire::test(EditEmployee::class, [
            'record' => $employee->getKey(),
        ])
            ->set('data.user.name', null)
            ->set('data.user.email', $userData->email)
            ->set('data.date_of_birth', $employeeData->date_of_birth)
            ->set('data.gender', $employeeData->gender)
            ->set('data.marital_status', $employeeData->marital_status)
            ->call('save')
            ->assertHasErrors(['data.user.name' => ['required']])
        ;

        // required email attribute
        Livewire::test(EditEmployee::class, [
            'record' => $employee->getKey(),
        ])
            ->set('data.user.name', $userData->name)
            ->set('data.user.email', null)
            ->set('data.date_of_birth', $employeeData->date_of_birth)
            ->set('data.gender', $employeeData->gender)
            ->set('data.marital_status', $employeeData->marital_status)
            ->call('save')
            ->assertHasErrors(['data.user.email' => ['required']])
        ;

        // valid email attribute
        Livewire::test(EditEmployee::class, [
            'record' => $employee->getKey(),
        ])
            ->set('data.user.name', $userData->name)
            ->set('data.user.email', 'invalid-email')
            ->set('data.date_of_birth', $employeeData->date_of_birth)
            ->set('data.gender', $employeeData->gender)
            ->set('data.marital_status', $employeeData->marital_status)
            ->call('save')
            ->assertHasErrors(['data.user.email' => ['email']])
        ;

        // required date of birth attribute
        Livewire::test(EditEmployee::class, [
            'record' => $employee->getKey(),
        ])
            ->set('data.user.name', $userData->name)
            ->set('data.user.email', $userData->email)
            ->set('data.date_of_birth', null)
            ->set('data.gender', $employeeData->gender)
            ->set('data.marital_status', $employeeData->marital_status)
            ->call('save')
            ->assertHasErrors(['data.date_of_birth' => ['required']])
        ;

        // valid date of birth attribute
        Livewire::test(EditEmployee::class, [
            'record' => $employee->getKey(),
        ])
            ->set('data.user.name', $userData->name)
            ->set('data.user.email', $userData->email)
            ->set('data.date_of_birth', 'invalid-date')
            ->set('data.gender', $employeeData->gender)
            ->set('data.marital_status', $employeeData->marital_status)
            ->call('save')
            ->assertHasErrors(['data.date_of_birth' => ['date']])
        ;

        // required gender attribute
        Livewire::test(EditEmployee::class, [
            'record' => $employee->getKey(),
        ])
            ->set('data.user.name', $userData->name)
            ->set('data.user.email', $userData->email)
            ->set('data.date_of_birth', $employeeData->date_of_birth)
            ->set('data.gender', null)
            ->set('data.marital_status', $employeeData->marital_status)
            ->call('save')
            ->assertHasErrors(['data.gender' => ['required']])
        ;

        // required marital status attribute
        Livewire::test(EditEmployee::class, [
            'record' => $employee->getKey(),
        ])
            ->set('data.user.name', $userData->name)
            ->set('data.user.email', $userData->email)
            ->set('data.date_of_birth', $employeeData->date_of_birth)
            ->set('data.gender', $employeeData->gender)
            ->set('data.marital_status', null)
            ->call('save')
            ->assertHasErrors(['data.marital_status' => ['required']])
        ;
    }

    /** @test */
    public function it_can_delete_employee(): void
    {
        $employee = Employee::factory()->create();

        Livewire::test(EditEmployee::class, [
            'record' => $employee->getKey(),
        ])->call('delete');

        $this->assertDatabaseMissing($employee, $employee->toArray());
    }
}

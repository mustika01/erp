<?php

namespace Kumi\Jinzai\Tests\Filament\Resources\EmployeeResource\Pages;

use Kumi\AbstractJinzaiKiosk\Tests\AdministratorTestCase;
use Kumi\Jinzai\Actions\GenerateEmployeeEmail;
use Kumi\Jinzai\Filament\Resources\EmployeeResource;
use Kumi\Jinzai\Filament\Resources\EmployeeResource\Pages\CreateEmployee;
use Kumi\Jinzai\Models\Employee;
use Kumi\Kyoka\Support\DefaultRoles;
use Kumi\Tobira\Models\User;
use Livewire\Livewire;

/**
 * @internal
 */
class CreateEmployeeTest extends AdministratorTestCase
{
    /** @test */
    public function it_can_render_create_employee_form(): void
    {
        $response = $this->get(EmployeeResource::getUrl('create'));

        $response->assertOk();
    }

    /** @test */
    public function it_can_save_employee_data(): void
    {
        $userData = User::factory()->make();
        $employeeData = Employee::factory()->make();

        Livewire::test(CreateEmployee::class)
            ->set('data.user.name', $userData->name)
            ->set('data.date_of_birth', $employeeData->date_of_birth)
            ->set('data.gender', $employeeData->gender)
            ->set('data.marital_status', $employeeData->marital_status)
            ->call('create')
            ->assertHasNoErrors()
        ;

        $email = GenerateEmployeeEmail::run($userData->name);
        $user = User::query()->with('employee')->where('email', $email)->first();
        $employee = $user->employee;

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($userData->name, $user->name);
        $this->assertTrue($user->hasRole(DefaultRoles::FILAMENT_USER));
        $this->assertTrue($user->isActivated());
        $this->assertEquals($employeeData->date_of_birth->toDateString(), $employee->date_of_birth->toDateString());
        $this->assertEquals($employeeData->gender, $employee->gender);
        $this->assertEquals($employeeData->marital_status, $employee->marital_status);
    }

    /** @test */
    public function it_can_validate_employee_data(): void
    {
        $userData = User::factory()->make();
        $employeeData = Employee::factory()->make();

        // required name attribute
        Livewire::test(CreateEmployee::class)
            ->set('data.user.name', null)
            ->set('data.user.email', $userData->email)
            ->set('data.date_of_birth', $employeeData->date_of_birth)
            ->set('data.gender', $employeeData->gender)
            ->set('data.marital_status', $employeeData->marital_status)
            ->call('create')
            ->assertHasErrors(['data.user.name' => ['required']])
        ;

        // required email attribute
        Livewire::test(CreateEmployee::class)
            ->set('data.user.name', $userData->name)
            ->set('data.user.email', null)
            ->set('data.date_of_birth', $employeeData->date_of_birth)
            ->set('data.gender', $employeeData->gender)
            ->set('data.marital_status', $employeeData->marital_status)
            ->call('create')
            ->assertHasErrors(['data.user.email' => ['required']])
        ;

        // valid email attribute
        Livewire::test(CreateEmployee::class)
            ->set('data.user.name', $userData->name)
            ->set('data.user.email', 'invalid-email')
            ->set('data.date_of_birth', $employeeData->date_of_birth)
            ->set('data.gender', $employeeData->gender)
            ->set('data.marital_status', $employeeData->marital_status)
            ->call('create')
            ->assertHasErrors(['data.user.email' => ['email']])
        ;

        // required date of birth attribute
        Livewire::test(CreateEmployee::class)
            ->set('data.user.name', $userData->name)
            ->set('data.user.email', $userData->email)
            ->set('data.date_of_birth', null)
            ->set('data.gender', $employeeData->gender)
            ->set('data.marital_status', $employeeData->marital_status)
            ->call('create')
            ->assertHasErrors(['data.date_of_birth' => ['required']])
        ;

        // valid date of birth attribute
        Livewire::test(CreateEmployee::class)
            ->set('data.user.name', $userData->name)
            ->set('data.user.email', $userData->email)
            ->set('data.date_of_birth', 'invalid-date')
            ->set('data.gender', $employeeData->gender)
            ->set('data.marital_status', $employeeData->marital_status)
            ->call('create')
            ->assertHasErrors(['data.date_of_birth' => ['date']])
        ;

        // required gender attribute
        Livewire::test(CreateEmployee::class)
            ->set('data.user.name', $userData->name)
            ->set('data.user.email', $userData->email)
            ->set('data.date_of_birth', $employeeData->date_of_birth)
            ->set('data.gender', null)
            ->set('data.marital_status', $employeeData->marital_status)
            ->call('create')
            ->assertHasErrors(['data.gender' => ['required']])
        ;

        // required marital status attribute
        Livewire::test(CreateEmployee::class)
            ->set('data.user.name', $userData->name)
            ->set('data.user.email', $userData->email)
            ->set('data.date_of_birth', $employeeData->date_of_birth)
            ->set('data.gender', $employeeData->gender)
            ->set('data.marital_status', null)
            ->call('create')
            ->assertHasErrors(['data.marital_status' => ['required']])
        ;
    }
}

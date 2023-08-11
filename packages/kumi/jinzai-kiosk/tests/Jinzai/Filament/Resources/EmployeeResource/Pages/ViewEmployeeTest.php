<?php

namespace Kumi\Jinzai\Tests\Filament\Resources\EmployeeResource\Pages;

use Livewire\Livewire;
use Kumi\Jinzai\Models\Employee;
use Kumi\Jinzai\Filament\Resources\EmployeeResource;
use Kumi\AbstractJinzaiKiosk\Tests\AdministratorTestCase;
use Kumi\Jinzai\Filament\Resources\EmployeeResource\Pages\ViewEmployee;

/**
 * @internal
 */
class ViewEmployeeTest extends AdministratorTestCase
{
    /** @test */
    public function it_can_render_view_employee_page(): void
    {
        $employee = Employee::factory()->create();

        $response = $this->get(EmployeeResource::getUrl('view', [
            'record' => $employee,
        ]));

        $response->assertOk();
    }

    /** @test */
    public function it_can_retrieve_employee_data(): void
    {
        $employee = Employee::factory()->create();
        $user = $employee->user;

        Livewire::test(ViewEmployee::class, [
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
}

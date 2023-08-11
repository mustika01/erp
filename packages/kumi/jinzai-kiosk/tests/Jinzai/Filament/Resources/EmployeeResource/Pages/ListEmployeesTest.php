<?php

namespace Kumi\Jinzai\Tests\Filament\Resources\EmployeeResource\Pages;

use Livewire\Livewire;
use Illuminate\Http\Response;
use Kumi\Jinzai\Models\Employee;
use Kumi\AbstractJinzaiKiosk\Tests\AdministratorTestCase;
use Kumi\Jinzai\Filament\Resources\EmployeeResource\Pages\ListEmployees;

/**
 * @internal
 */
class ListEmployeesTest extends AdministratorTestCase
{
    /** @test */
    public function it_can_list_employees(): void
    {
        Employee::factory()->count(3)->create();

        $response = Livewire::test(ListEmployees::class);
        $response->assertStatus(Response::HTTP_OK);

        $this->assertCount(Employee::count(), $response->instance()->getTableRecords()->items());
    }

    /** @test */
    public function it_can_bulk_delete_employees(): void
    {
        $employees = Employee::factory()->count(3)->create();

        Livewire::test(ListEmployees::class, [
            'selectedTableRecords' => $employees->pluck('id')->toArray(),
        ])->call('bulkDelete');

        $this->assertDatabaseCount(Employee::class, 0);
    }
}

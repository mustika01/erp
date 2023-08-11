<?php

namespace Kumi\Jinzai\Tests\Filament\Resources\DepartmentResource\Pages;

use Livewire\Livewire;
use Illuminate\Http\Response;
use Kumi\Jinzai\Models\Department;
use Kumi\AbstractJinzaiKiosk\Tests\AdministratorTestCase;
use Kumi\Jinzai\Filament\Resources\DepartmentResource\Pages\ListDepartments;

/**
 * @internal
 */
class ListDepartmentsTest extends AdministratorTestCase
{
    /** @test */
    public function it_can_list_departments(): void
    {
        Department::factory()->count(3)->create();

        $response = Livewire::test(ListDepartments::class);
        $response->assertStatus(Response::HTTP_OK);

        $this->assertCount(Department::count(), $response->instance()->getTableRecords()->items());
    }

    /** @test */
    public function it_can_bulk_delete_departments(): void
    {
        $departments = Department::factory()->count(3)->create();

        Livewire::test(ListDepartments::class, [
            'selectedTableRecords' => $departments->pluck('id')->toArray(),
        ])->call('bulkDelete');

        $this->assertDatabaseCount(Department::class, 0);
    }
}

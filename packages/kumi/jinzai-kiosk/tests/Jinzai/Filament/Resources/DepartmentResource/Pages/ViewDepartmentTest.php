<?php

namespace Kumi\Jinzai\Tests\Filament\Resources\DepartmentResource\Pages;

use Livewire\Livewire;
use Kumi\Jinzai\Models\Department;
use Kumi\Jinzai\Filament\Resources\DepartmentResource;
use Kumi\AbstractJinzaiKiosk\Tests\AdministratorTestCase;
use Kumi\Jinzai\Filament\Resources\DepartmentResource\Pages\ViewDepartment;

/**
 * @internal
 */
class ViewDepartmentTest extends AdministratorTestCase
{
    /** @test */
    public function it_can_render_view_department_page(): void
    {
        $department = Department::factory()->create();

        $response = $this->get(DepartmentResource::getUrl('view', [
            'record' => $department,
        ]));

        $response->assertOk();
    }

    /** @test */
    public function it_can_retrieve_department_data(): void
    {
        $department = Department::factory()->create();

        Livewire::test(ViewDepartment::class, [
            'record' => $department->getKey(),
        ])
            ->assertSet('data.name', $department->name)
        ;
    }
}

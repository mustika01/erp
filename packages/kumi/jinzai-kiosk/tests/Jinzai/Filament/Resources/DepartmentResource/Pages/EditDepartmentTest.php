<?php

namespace Kumi\Jinzai\Tests\Filament\Resources\DepartmentResource\Pages;

use Livewire\Livewire;
use Kumi\Jinzai\Models\Department;
use Kumi\Jinzai\Filament\Resources\DepartmentResource;
use Kumi\AbstractJinzaiKiosk\Tests\AdministratorTestCase;
use Kumi\Jinzai\Filament\Resources\DepartmentResource\Pages\EditDepartment;

/**
 * @internal
 */
class EditDepartmentTest extends AdministratorTestCase
{
    /** @test */
    public function it_can_render_edit_department_form(): void
    {
        $response = $this->get(DepartmentResource::getUrl('edit', [
            'record' => Department::factory()->create(),
        ]));

        $response->assertOk();
    }

    /** @test */
    public function it_can_retrieve_department_data(): void
    {
        $department = Department::factory()->create();

        Livewire::test(EditDepartment::class, [
            'record' => $department->getKey(),
        ])
            ->assertSet('data.name', $department->name)
        ;
    }

    /** @test */
    public function it_can_update_department_data(): void
    {
        $department = Department::factory()->create();
        $data = Department::factory()->make();

        Livewire::test(EditDepartment::class, [
            'record' => $department->getKey(),
        ])
            ->set('data.name', $data->name)
            ->call('save')
            ->assertHasNoErrors()
        ;

        $this->assertEquals($data->name, $department->fresh()->name);
    }

    /** @test */
    public function it_can_validate_department_data(): void
    {
        $department = Department::factory()->create();
        $data = Department::factory()->make();

        // required name attribute
        Livewire::test(EditDepartment::class, [
            'record' => $department->getKey(),
        ])
            ->set('data.name', null)
            ->call('save')
            ->assertHasErrors(['data.name' => ['required']])
        ;
    }

    /** @test */
    public function it_can_delete_department(): void
    {
        $department = Department::factory()->create();

        Livewire::test(EditDepartment::class, [
            'record' => $department->getKey(),
        ])->call('delete');

        $this->assertDatabaseMissing($department, $department->toArray());
    }
}

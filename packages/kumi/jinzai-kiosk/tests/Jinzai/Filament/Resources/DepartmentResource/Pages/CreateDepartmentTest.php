<?php

namespace Kumi\Jinzai\Tests\Filament\Resources\DepartmentResource\Pages;

use Livewire\Livewire;
use Kumi\Jinzai\Models\Department;
use Kumi\Jinzai\Filament\Resources\DepartmentResource;
use Kumi\AbstractJinzaiKiosk\Tests\AdministratorTestCase;
use Kumi\Jinzai\Filament\Resources\DepartmentResource\Pages\CreateDepartment;

/**
 * @internal
 */
class CreateDepartmentTest extends AdministratorTestCase
{
    /** @test */
    public function it_can_render_create_department_form(): void
    {
        $response = $this->get(DepartmentResource::getUrl('create'));

        $response->assertOk();
    }

    /** @test */
    public function it_can_save_department_data(): void
    {
        $data = Department::factory()->make();

        Livewire::test(CreateDepartment::class)
            ->set('data.name', $data->name)
            ->call('create')
            ->assertHasNoErrors()
        ;

        $department = Department::query()->first();

        $this->assertEquals($data->name, $department->name);
    }

    /** @test */
    public function it_can_validate_department_data(): void
    {
        $data = Department::factory()->make();

        // required name attribute
        Livewire::test(CreateDepartment::class)
            ->set('data.name', null)
            ->call('create')
            ->assertHasErrors(['data.name' => ['required']])
        ;
    }
}

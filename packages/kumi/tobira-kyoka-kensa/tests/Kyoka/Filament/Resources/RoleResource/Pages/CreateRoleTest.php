<?php

namespace Kumi\Kyoka\Tests\Filament\Resources\RoleResource\Pages;

use Livewire\Livewire;
use Kumi\Kyoka\Models\Role;
use Kumi\Kensa\AdministratorTestCase;
use Kumi\Kyoka\Filament\Resources\RoleResource;
use Kumi\Kyoka\Filament\Resources\RoleResource\Pages\CreateRole;

/**
 * @internal
 */
class CreateRoleTest extends AdministratorTestCase
{
    /** @test */
    public function it_can_render_create_role_form(): void
    {
        $response = $this->get(RoleResource::getUrl('create'));

        $response->assertOk();
    }

    /** @test */
    public function it_can_save_role_data(): void
    {
        $data = Role::factory()->make();

        Livewire::test(CreateRole::class)
            ->set('data.label', $data->label)
            ->set('data.description', $data->description)
            ->call('create')
            ->assertHasNoErrors()
        ;

        $this->assertDatabaseHas(Role::class, [
            'name' => $data->name,
        ]);

        $data = Role::factory()->make();

        Livewire::test(CreateRole::class)
            ->set('data.label', $data->label)
            ->call('create')
            ->assertHasNoErrors()
        ;

        $this->assertDatabaseHas(Role::class, [
            'name' => $data->name,
            'label' => $data->label,
            'description' => $data->description,
        ]);
    }

    /** @test */
    public function it_can_validate_role_data(): void
    {
        Livewire::test(CreateRole::class)
            ->set('data.label', null)
            ->call('create')
            ->assertHasErrors(['data.label' => ['required']])
        ;
    }
}

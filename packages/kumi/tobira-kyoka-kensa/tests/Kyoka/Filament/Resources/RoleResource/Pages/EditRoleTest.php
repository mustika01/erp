<?php

namespace Kumi\Kyoka\Tests\Filament\Resources\RoleResource\Pages;

use Livewire\Livewire;
use Kumi\Kyoka\Models\Role;
use Kumi\Kensa\AdministratorTestCase;
use Kumi\Kyoka\Filament\Resources\RoleResource;
use Kumi\Kyoka\Filament\Resources\RoleResource\Pages\EditRole;

/**
 * @internal
 */
class EditRoleTest extends AdministratorTestCase
{
    /** @test */
    public function it_can_render_edit_role_form(): void
    {
        $response = $this->get(RoleResource::getUrl('edit', [
            'record' => Role::factory()->editable()->create(),
        ]));

        $response->assertOk();
    }

    /** @test */
    public function it_can_retrieve_role_data(): void
    {
        $role = Role::factory()->editable()->create();

        Livewire::test(EditRole::class, [
            'record' => $role->getKey(),
        ])
            ->assertSet('data.label', $role->label)
            ->assertSet('data.description', $role->description)
        ;
    }

    /** @test */
    public function it_can_update_role_data(): void
    {
        $role = Role::factory()->editable()->create();
        $data = Role::factory()->editable()->make();

        Livewire::test(EditRole::class, [
            'record' => $role->getKey(),
        ])
            ->set('data.label', $data->label)
            ->set('data.description', $data->description)
            ->call('save')
            ->assertHasNoErrors()
        ;

        tap($role->fresh(), function (Role $role) use ($data) {
            $this->assertEquals($data->name, $role->name);
            $this->assertEquals($data->label, $role->label);
            $this->assertEquals($data->description, $role->description);
        });
    }

    /** @test */
    public function it_can_validate_role_data(): void
    {
        $role = Role::factory()->editable()->create();

        Livewire::test(EditRole::class, [
            'record' => $role->getKey(),
        ])
            ->set('data.label', null)
            ->call('save')
            ->assertHasErrors(['data.label' => ['required']])
        ;
    }

    /** @test */
    public function it_can_delete_role(): void
    {
        $role = Role::factory()->editable()->create();

        Livewire::test(EditRole::class, [
            'record' => $role->getKey(),
        ])->call('delete');

        $this->assertDatabaseMissing($role, [
            'name' => $role->name,
        ]);
    }

    /** @test */
    public function it_can_handle_non_editable_role_with_forbidden_http_exception(): void
    {
        $role = Role::factory()->create();

        $response = Livewire::test(EditRole::class, [
            'record' => $role->getKey(),
        ]);

        $response->assertForbidden();
    }
}

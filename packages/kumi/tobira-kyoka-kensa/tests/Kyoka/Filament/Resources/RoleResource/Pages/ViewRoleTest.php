<?php

namespace Kumi\Kyoka\Tests\Filament\Resources\RoleResource\Pages;

use Livewire\Livewire;
use Kumi\Kyoka\Models\Role;
use Kumi\Kensa\AdministratorTestCase;
use Kumi\Kyoka\Filament\Resources\RoleResource;
use Kumi\Kyoka\Filament\Resources\RoleResource\Pages\ViewRole;

/**
 * @internal
 */
class ViewRoleTest extends AdministratorTestCase
{
    /** @test */
    public function it_can_render_view_role_page(): void
    {
        $role = Role::factory()->create();

        $response = $this->get(RoleResource::getUrl('view', [
            'record' => $role,
        ]));

        $response->assertOk();
    }

    /** @test */
    public function it_can_retrieve_role_data(): void
    {
        $role = Role::factory()->create();

        Livewire::test(ViewRole::class, [
            'record' => $role->getKey(),
        ])
            ->assertSet('data.label', $role->label)
            ->assertSet('data.description', $role->description)
            ->assertDontSee('Edit')
        ;

        $role = Role::factory()->editable()->create();

        Livewire::test(ViewRole::class, [
            'record' => $role->getKey(),
        ])
            ->assertSet('data.label', $role->label)
            ->assertSet('data.description', $role->description)
            ->assertSee('Edit')
        ;
    }
}

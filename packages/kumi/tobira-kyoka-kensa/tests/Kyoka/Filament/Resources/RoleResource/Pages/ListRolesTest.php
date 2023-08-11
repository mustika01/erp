<?php

namespace Kumi\Kyoka\Tests\Filament\Resources\RoleResource\Pages;

use Livewire\Livewire;
use Kumi\Kyoka\Models\Role;
use Illuminate\Http\Response;
use Kumi\Kensa\AdministratorTestCase;
use Kumi\Kyoka\Filament\Resources\RoleResource\Pages\ListRoles;

/**
 * @internal
 */
class ListRolesTest extends AdministratorTestCase
{
    /** @test */
    public function it_can_list_roles(): void
    {
        Role::factory()->count(3)->create();

        $testable = Livewire::test(ListRoles::class);
        $testable->assertStatus(Response::HTTP_OK);

        $this->assertCount(Role::count(), $testable->instance()->getTableRecords()->items());
    }

    /** @test */
    public function it_can_bulk_delete_roles(): void
    {
        $roles = Role::factory()->editable()->count(3)->create();

        Livewire::test(ListRoles::class, [
            'selectedTableRecords' => $roles->pluck('id')->toArray(),
        ])->call('bulkDelete');

        // This should return 8 records from the seeders.
        $this->assertDatabaseCount(Role::class, 8);
    }
}

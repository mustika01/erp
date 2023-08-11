<?php

namespace Kumi\Kyoka\Tests\Filament\Resources\UserResource\Pages;

use Livewire\Livewire;
use Kumi\Tobira\Models\User;
use Illuminate\Http\Response;
use Kumi\Kensa\AdministratorTestCase;
use Kumi\Kyoka\Filament\Resources\UserResource\Pages\ListUsers;

/**
 * @internal
 */
class ListUsersTest extends AdministratorTestCase
{
    /** @test */
    public function it_can_list_users(): void
    {
        User::factory()->count(3)->create();

        $response = Livewire::test(ListUsers::class);
        $response->assertStatus(Response::HTTP_OK);

        $this->assertCount(User::withoutSensitive()->count(), $response->instance()->getTableRecords()->items());
    }

    /** @test */
    public function it_can_bulk_delete_users(): void
    {
        $users = User::factory()->count(3)->create();

        Livewire::test(ListUsers::class, [
            'selectedTableRecords' => $users->pluck('id')->toArray(),
        ])->call('bulkDelete');

        // This should return 2 (1 authenticated user, 1 system user) records.
        $this->assertDatabaseCount(User::class, 2);
    }
}

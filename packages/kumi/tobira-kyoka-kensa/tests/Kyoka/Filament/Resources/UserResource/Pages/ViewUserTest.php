<?php

namespace Kumi\Kyoka\Tests\Filament\Resources\UserResource\Pages;

use Livewire\Livewire;
use Kumi\Tobira\Models\User;
use Kumi\Kensa\AdministratorTestCase;
use Kumi\Kyoka\Filament\Resources\UserResource;
use Kumi\Kyoka\Filament\Resources\UserResource\Pages\ViewUser;

/**
 * @internal
 */
class ViewUserTest extends AdministratorTestCase
{
    /** @test */
    public function it_can_render_view_user_page(): void
    {
        $user = User::factory()->create();

        $response = $this->get(UserResource::getUrl('view', [
            'record' => $user,
        ]));

        $response->assertOk();
    }

    /** @test */
    public function it_can_retrieve_user_data(): void
    {
        $user = User::factory()->create();

        Livewire::test(ViewUser::class, [
            'record' => $user->getKey(),
        ])
            ->assertSet('data.name', $user->name)
            ->assertSet('data.email', $user->email)
        ;
    }

    /** @test */
    public function it_can_activate_user(): void
    {
        $user = User::factory()->inactive()->create();

        Livewire::test(ViewUser::class, [
            'record' => $user->getKey(),
        ])->callPageAction('activate');

        $this->assertTrue($user->fresh()->isActivated());
    }

    /** @test */
    public function it_can_deactivate_user(): void
    {
        $user = User::factory()->create();

        Livewire::test(ViewUser::class, [
            'record' => $user->getKey(),
        ])->callPageAction('deactivate');

        $this->assertTrue($user->fresh()->isDeactivated());
    }
}

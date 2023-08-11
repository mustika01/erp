<?php

namespace Kumi\Tobira\Tests\Filament\Pages;

use Livewire\Livewire;
use Kumi\Tobira\Models\User;
use Kumi\Kensa\AuthenticatedTestCase;
use Kumi\Tobira\Filament\Pages\Profile;

/**
 * @internal
 */
class ProfileTest extends AuthenticatedTestCase
{
    /** @test */
    public function it_can_render_profile_page(): void
    {
        Livewire::test(Profile::class)->assertOk();
    }

    /** @test */
    public function it_can_retrieve_user_data(): void
    {
        $user = $this->authenticatedUser;

        Livewire::test(Profile::class)
            ->assertSet('data.name', $user->name)
            ->assertSet('data.email', $user->email)
        ;
    }

    /** @test */
    public function it_can_update_user_profile(): void
    {
        $user = User::factory()->make();

        Livewire::test(Profile::class)
            ->set('data.name', $user->name)
            ->set('data.email', $user->email)
            ->call('update')
        ;

        $this->assertDatabaseHas(User::class, [
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }
}

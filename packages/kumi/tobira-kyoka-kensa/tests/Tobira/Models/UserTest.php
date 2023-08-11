<?php

namespace Kumi\Tobira\Models;

use Kumi\Kensa\TestCase;
use Filament\Facades\Filament;
use Kumi\Kyoka\Support\DefaultRoles;
use Kumi\Kensa\Traits\InteractsWithUserAuthentication;

/**
 * @internal
 */
class UserTest extends TestCase
{
    use InteractsWithUserAuthentication;

    /** @test */
    public function it_can_access_admin_page(): void
    {
        $this->actingAsFilamentUser();

        $response = $this->get(Filament::getUrl());

        $response->assertOk();
    }

    /** @test */
    public function it_can_access_admin_page_as_super_administrator(): void
    {
        $this->actingAsSuperAdministrator();

        $response = $this->get(Filament::getUrl());

        $response->assertOk();
    }

    /** @test */
    public function it_can_handle_redirection_for_inactive_user(): void
    {
        $user = User::factory()->inactive()->create();
        $user->assignRole(DefaultRoles::FILAMENT_USER);

        $this->actingAs($user);

        $response = $this->get(Filament::getUrl());

        $response->assertRedirect(route('filament.account-activation.prompt'));
    }

    /** @test */
    public function it_can_get_activity_log_name_attribute(): void
    {
        $user = User::factory()->make();

        $this->assertEquals($user->name, $user->activity_log_name);
    }
}

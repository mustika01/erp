<?php

namespace Kumi\Tobira\Tests\Actions\Fortify;

use Kumi\Kensa\TestCase;
use Kumi\Tobira\Models\User;

/**
 * @internal
 */
class RedirectIfTwoFactorAuthenticatableTest extends TestCase
{
    /** @test */
    public function it_can_redirect_user_with_two_factor_authentication_enabled(): void
    {
        $user = User::factory()->two_factor_authentication_enabled()->create();

        $response = $this->post(route('filament.session.store'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('filament.two-factor.create'));
    }

    /** @test */
    public function it_can_redirect_user_with_two_factor_authentication_enabled_json_request(): void
    {
        $user = User::factory()->two_factor_authentication_enabled()->create();

        $response = $this->postJson(route('filament.session.store'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertJson([
            'two_factor' => true,
        ]);
    }
}

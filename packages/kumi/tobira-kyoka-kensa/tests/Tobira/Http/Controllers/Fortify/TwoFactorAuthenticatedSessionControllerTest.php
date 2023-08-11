<?php

namespace Kumi\Tobira\Tests\Http\Controllers\Fortify;

use Kumi\Kensa\TestCase;
use Kumi\Kensa\Traits\InteractsWithUserAuthentication;
use Laravel\Fortify\Contracts\TwoFactorAuthenticationProvider;

/**
 * @internal
 */
class TwoFactorAuthenticatedSessionControllerTest extends TestCase
{
    use InteractsWithUserAuthentication;

    /** @test */
    public function it_can_redirect_empty_authentication_request(): void
    {
        $response = $this->get(route('filament.two-factor.create'));

        $response->assertRedirect(route('filament.session.create'));
    }

    /** @test */
    public function it_can_render_two_factor_challenge_page(): void
    {
        $this->twoFactorLogin();

        $response = $this->get(route('filament.two-factor.create'));

        $response
            ->assertOk()
            ->assertViewIs('tobira::two-factor.create')
        ;
    }

    /** @test */
    public function it_can_handle_request_with_recovery_code(): void
    {
        $user = $this->twoFactorLogin();

        $recoveryCode = $user->recoveryCodes()[0];

        $this->post(route('filament.two-factor.store'), [
            'recovery_code' => $recoveryCode,
        ]);

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function it_can_handle_request_with_otp_code(): void
    {
        $user = $this->twoFactorLogin();

        $this->mock(TwoFactorAuthenticationProvider::class)
            ->shouldReceive('verify')
            ->andReturn(true)
        ;

        $this->post(route('filament.two-factor.store'), [
            'code' => '123456',
        ]);

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function it_can_handle_request_with_invalid_otp_code(): void
    {
        $user = $this->twoFactorLogin();

        $response = $this->post(route('filament.two-factor.store'), [
            'code' => '123456',
        ]);

        $response->assertRedirect(route('filament.two-factor.create'))
            ->assertSessionHasErrors([
                'code' => 'The provided two factor authentication code was invalid.',
            ])
        ;

        $this->assertGuest();
    }

    /** @test */
    public function it_can_handle_request_with_invalid_otp_code_json_request(): void
    {
        $this->twoFactorLogin();

        $response = $this->postJson(route('filament.two-factor.store'), [
            'code' => '123456',
        ]);

        $response->assertJsonValidationErrors([
            'code' => 'The provided two factor authentication code was invalid.',
        ]);
    }
}

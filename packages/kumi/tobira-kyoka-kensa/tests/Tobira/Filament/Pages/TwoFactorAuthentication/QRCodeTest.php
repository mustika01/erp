<?php

namespace Kumi\Tobira\Tests\Filament\Pages\TwoFactorAuthentication;

use Livewire\Livewire;
use Kumi\Kensa\AuthenticatedTestCase;
use Kumi\Tobira\Validation\Rules\OTPCode;
use Kumi\Tobira\Support\SessionKey\TwoFactorAuthentication;
use Kumi\Tobira\Filament\Pages\TwoFactorAuthentication\QRCode;

/**
 * @internal
 */
class QRCodeTest extends AuthenticatedTestCase
{
    /** @test */
    public function it_can_redirect_user_with_two_factor_authentication_enabled(): void
    {
        $this->actingAsFilamentUser(true);

        Livewire::test(QRCode::class)
            ->assertRedirect(route('filament.pages.tobira/two-factor-authentication/status'))
        ;
    }

    /** @test */
    public function it_can_render_qr_code_page(): void
    {
        Livewire::test(QRCode::class)
            ->assertOk()
            ->assertViewIs('tobira::filament.pages.two-factor-authentication.qr-code')
        ;
    }

    /** @test */
    public function it_can_validate_otp_code(): void
    {
        $this->confirmPassword();

        $this->mock(OTPCode::class)
            ->shouldReceive('passes')
            ->andReturn(true)
        ;

        $response = Livewire::test(QRCode::class)
            ->set('otp', '123456')
            ->call('handle')
        ;

        $response->assertSessionHas(TwoFactorAuthentication::ONE_TIME_PASSWORD_CONFIRMED, true);

        $response->assertRedirect(route('filament.pages.tobira/two-factor-authentication/recovery-code'));
    }
}

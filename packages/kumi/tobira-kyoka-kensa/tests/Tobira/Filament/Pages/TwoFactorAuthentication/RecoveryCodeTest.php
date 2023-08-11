<?php

namespace Kumi\Tobira\Tests\Filament\Pages\TwoFactorAuthentication;

use Livewire\Livewire;
use Kumi\Kensa\AuthenticatedTestCase;
use Kumi\Tobira\Support\SessionKey\TwoFactorAuthentication;
use Kumi\Tobira\Filament\Pages\TwoFactorAuthentication\RecoveryCode;

/**
 * @internal
 */
class RecoveryCodeTest extends AuthenticatedTestCase
{
    /** @test */
    public function it_can_render_recovery_code_page(): void
    {
        $this->confirmPassword();
        $this->confirmOTP();

        Livewire::test(RecoveryCode::class)
            ->assertOk()
            ->assertViewIs('tobira::filament.pages.two-factor-authentication.recovery-code')
        ;
    }

    /** @test */
    public function it_can_enable_two_factor_authentication(): void
    {
        $this->confirmPassword();
        $this->confirmOTP();

        $this->assertFalse($this->authenticatedUser->hasEnabledTwoFactorAuthentication());

        $response = Livewire::test(RecoveryCode::class)
            ->assertOk()
            ->call('handle')
        ;

        $response->assertSessionMissing([
            TwoFactorAuthentication::ONE_TIME_PASSWORD_CONFIRMED,
            TwoFactorAuthentication::ONE_TIME_PASSWORD_SECRET,
            TwoFactorAuthentication::RECOVERY_CODES,
        ]);

        $this->assertTrue($this->authenticatedUser->hasEnabledTwoFactorAuthentication());
    }

    /** @test */
    public function it_can_redirect_user_with_unconfirmed_otp_code(): void
    {
        $this->confirmPassword();

        Livewire::test(RecoveryCode::class)
            ->assertRedirect(route('filament.pages.tobira/two-factor-authentication/qr-code'))
        ;
    }
}

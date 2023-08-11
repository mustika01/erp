<?php

namespace Kumi\Tobira\Tests\Filament\Pages\TwoFactorAuthentication;

use Livewire\Livewire;
use Kumi\Kensa\AuthenticatedTestCase;
use Kumi\Tobira\Filament\Pages\TwoFactorAuthentication\Status;

/**
 * @internal
 */
class StatusTest extends AuthenticatedTestCase
{
    /** @test */
    public function it_can_render_two_factor_auth_status_page(): void
    {
        $this->actingAsFilamentUser(true);

        Livewire::test(Status::class)
            ->assertOk()
            ->assertViewIs('tobira::filament.pages.two-factor-authentication.status')
        ;
    }

    /** @test */
    public function it_can_disable_two_factor_authentication(): void
    {
        $this->actingAsFilamentUser(true);
        $this->confirmPassword();

        Livewire::test(Status::class)
            ->call('disable')
            ->assertRedirect(route('filament.pages.tobira/two-factor-authentication/qr-code'))
        ;

        $this->assertFalse($this->authenticatedUser->hasEnabledTwoFactorAuthentication());
    }

    /** @test */
    public function it_can_generate_a_new_set_of_recovery_codes(): void
    {
        $this->actingAsFilamentUser(true);
        $this->confirmPassword();

        $recoveryCodes = $this->authenticatedUser->recoveryCodes();

        Livewire::test(Status::class)
            ->call('generate')
        ;

        $this->assertCount(8, array_diff($recoveryCodes, $this->authenticatedUser->fresh()->recoveryCodes()));
    }

    /** @test */
    public function it_can_redirect_user_without_two_factor_authentication(): void
    {
        $this->confirmPassword();

        Livewire::test(Status::class)
            ->assertRedirect(route('filament.pages.tobira/two-factor-authentication/qr-code'))
        ;
    }
}

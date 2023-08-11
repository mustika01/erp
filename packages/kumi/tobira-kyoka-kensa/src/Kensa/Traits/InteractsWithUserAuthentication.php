<?php

namespace Kumi\Kensa\Traits;

use Kumi\Tobira\Models\User;
use Kumi\Kyoka\Support\DefaultRoles;
use Kumi\Tobira\Support\SessionKey\TwoFactorAuthentication;

trait InteractsWithUserAuthentication
{
    protected User $authenticatedUser;

    public function actingAsFilamentUser(bool $enableTwoFactorAuth = false): void
    {
        $factory = User::factory();

        if ($enableTwoFactorAuth) {
            $factory = $factory->two_factor_authentication_enabled();
        }

        $user = $factory->create();
        $user->assignRole(DefaultRoles::FILAMENT_USER);

        $this->authenticatedUser = $user;

        $this->actingAs($this->authenticatedUser, config('filament.auth.guard'));
    }

    public function actingAsAdministrator(): void
    {
        $user = User::factory()->create();
        $user->assignRole(DefaultRoles::ADMINISTRATOR);
        $user->assignRole(DefaultRoles::FILAMENT_USER);

        $this->authenticatedUser = $user;

        $this->actingAs($this->authenticatedUser, config('filament.auth.guard'));
    }

    public function actingAsSuperAdministrator(): void
    {
        $user = User::factory()->create();
        $user->assignRole(DefaultRoles::SUPER_ADMINISTRATOR);

        $this->authenticatedUser = $user;

        $this->actingAs($this->authenticatedUser, config('filament.auth.guard'));
    }

    public function confirmPassword(): void
    {
        $this->withSession(['auth.password_confirmed_at' => time()]);
    }

    public function confirmOTP(): void
    {
        $this->withSession([TwoFactorAuthentication::ONE_TIME_PASSWORD_CONFIRMED => true]);
    }

    public function twoFactorLogin(): User
    {
        $user = User::factory()->two_factor_authentication_enabled()->create();

        $this->withSession(['login.id' => $user->id]);

        return $user;
    }
}

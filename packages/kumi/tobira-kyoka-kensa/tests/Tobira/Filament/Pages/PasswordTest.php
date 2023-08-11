<?php

namespace Kumi\Tobira\Tests\Filament\Pages;

use Livewire\Livewire;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Kumi\Kensa\AuthenticatedTestCase;
use Kumi\Tobira\Filament\Pages\Password;
use Kumi\Tobira\Events\User\PasswordUpdated;
use Laravel\Fortify\Rules\Password as PasswordRule;

/**
 * @internal
 */
class PasswordTest extends AuthenticatedTestCase
{
    /** @test */
    public function it_can_render_password_page(): void
    {
        Livewire::test(Password::class)->assertOk();
    }

    /** @test */
    public function it_can_update_user_password(): void
    {
        Event::fake();

        Livewire::test(Password::class)
            ->set('data.current_password', 'password')
            ->set('data.password', 'PassworD')
            ->set('data.password_confirmation', 'PassworD')
            ->call('update')
            ->assertHasNoErrors()
        ;

        $this->assertTrue(Hash::check('PassworD', $this->authenticatedUser->fresh()->password));

        Event::assertDispatched(PasswordUpdated::class);
    }

    /** @test */
    public function it_can_validate_user_password(): void
    {
        Livewire::test(Password::class)
            ->set('data.current_password', null)
            ->set('data.password', 'PassworD')
            ->set('data.password_confirmation', 'PassworD')
            ->call('update')
            ->assertHasErrors(['data.current_password' => ['required']])
        ;

        Livewire::test(Password::class)
            ->set('data.current_password', 'invalid_current_password')
            ->set('data.password', 'PassworD')
            ->set('data.password_confirmation', 'PassworD')
            ->call('update')
            ->assertHasErrors(['data.current_password'])
        ;

        Livewire::test(Password::class)
            ->set('data.current_password', 'password')
            ->set('data.password', null)
            ->set('data.password_confirmation', 'PassworD')
            ->call('update')
            ->assertHasErrors(['data.password' => ['required']])
        ;

        Livewire::test(Password::class)
            ->set('data.current_password', 'password')
            ->set('data.password', 'secret')
            ->set('data.password_confirmation', 'secret')
            ->call('update')
            ->assertHasErrors(['data.password' => [PasswordRule::class]])
        ;

        Livewire::test(Password::class)
            ->set('data.current_password', 'password')
            ->set('data.password', 'password')
            ->set('data.password_confirmation', null)
            ->call('update')
            ->assertHasErrors(['data.password' => ['confirmed']])
        ;
    }
}

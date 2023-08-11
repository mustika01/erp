<?php

namespace Kumi\Tobira\Tests\Http\Controllers\Fortify;

use Kumi\Kensa\TestCase;
use Kumi\Tobira\Models\User;
use Illuminate\Support\Collection;

/**
 * @internal
 */
class AuthenticatedSessionControllerTest extends TestCase
{
    /** @test */
    public function it_can_render_login_page(): void
    {
        $response = $this->get(route('filament.session.create'));

        $response
            ->assertOk()
            ->assertViewIs('tobira::session.create')
        ;
    }

    /** @test */
    public function it_can_handle_login_request(): void
    {
        $user = User::factory()->create();

        $this->post(route('filament.session.store'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function it_can_throttle_login_request(): void
    {
        $user = User::factory()->create();

        Collection::times(5, function () use ($user) {
            $this->post(route('filament.session.store'), [
                'email' => $user->email,
                'password' => 'wrong-password',
            ]);
        });

        $response = $this->post(route('filament.session.store'), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors([
            'email' => __('auth.throttle', ['seconds' => 60]),
        ]);

        $this->assertGuest();
    }

    /** @test */
    public function it_can_handle_invalid_login_credentials(): void
    {
        $user = User::factory()->create();

        $response = $this->post(route('filament.session.store'), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors([
            'email' => __('auth.failed'),
        ]);

        $this->assertGuest();
    }

    /** @test */
    public function it_can_handle_logout_request(): void
    {
        $this->actingAs(User::factory()->create());

        $this->delete(route('filament.session.destroy'));

        $this->assertGuest();
    }
}

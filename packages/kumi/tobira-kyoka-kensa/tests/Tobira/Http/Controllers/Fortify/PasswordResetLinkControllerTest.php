<?php

namespace Kumi\Tobira\Tests\Http\Controllers\Fortify;

use Kumi\Kensa\TestCase;
use Kumi\Tobira\Models\User;
use Illuminate\Support\Facades\Password;

/**
 * @internal
 */
class PasswordResetLinkControllerTest extends TestCase
{
    /** @test */
    public function it_can_render_password_reset_link_page(): void
    {
        $response = $this->get(route('filament.password-reset-link.create'));

        $response
            ->assertOk()
            ->assertViewIs('tobira::password-reset-link.create')
        ;
    }

    /** @test */
    public function it_can_handle_password_reset_link_request(): void
    {
        $user = User::factory()->create();

        $response = $this->post(route('filament.password-reset-link.store'), [
            'email' => $user->email,
        ]);

        $response->assertSessionHas('status', __(Password::RESET_LINK_SENT));

        $this->assertDatabaseHas('password_resets', [
            'email' => $user->email,
        ]);
    }

    /** @test */
    public function it_can_handle_invalid_user(): void
    {
        $response = $this->post(route('filament.password-reset-link.store'), [
            'email' => 'invalid-user@example.com',
        ]);

        $response->assertSessionHasErrors([
            'email' => __(Password::INVALID_USER),
        ]);
    }
}

<?php

namespace Kumi\Tobira\Tests\Http\Controllers\Fortify;

use Kumi\Kensa\TestCase;
use Kumi\Tobira\Models\User;

/**
 * @internal
 */
class ConfirmablePasswordControllerTest extends TestCase
{
    /** @test */
    public function it_can_render_confirm_password_page(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('filament.confirm-password.show'));

        $response
            ->assertOk()
            ->assertViewIs('tobira::confirm-password.show')
        ;
    }

    /** @test */
    public function it_can_handle_confirm_password_request(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('filament.confirm-password.store'), [
            'password' => 'password',
        ]);

        $response->assertSessionHas('auth.password_confirmed_at');
    }
}

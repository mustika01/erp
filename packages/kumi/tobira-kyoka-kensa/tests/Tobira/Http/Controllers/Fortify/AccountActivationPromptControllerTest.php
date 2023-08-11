<?php

namespace Kumi\Tobira\Tests\Http\Controllers\Fortify;

use Kumi\Kensa\TestCase;
use Kumi\Tobira\Models\User;

/**
 * @internal
 */
class AccountActivationPromptControllerTest extends TestCase
{
    /** @test */
    public function it_can_serve_account_activation_prompt_page(): void
    {
        $user = User::factory()->inactive()->create();

        $this->actingAs($user);

        $response = $this->get(route('filament.account-activation.prompt'));

        $response
            ->assertOk()
            ->assertViewIs('tobira::account-activation.prompt')
        ;
    }

    /** @test */
    public function it_can_redirect_verified_user(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('filament.account-activation.prompt'));

        $response->assertRedirect();
    }
}

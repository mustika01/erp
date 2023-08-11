<?php

namespace Kumi\Tobira\Tests\Http\Controllers\Fortify;

use Kumi\Kensa\TestCase;
use Kumi\Tobira\Models\User;

/**
 * @internal
 */
class EmailVerificationPromptControllerTest extends TestCase
{
    /** @test */
    public function it_can_serve_email_verification_prompt_page(): void
    {
        $user = User::factory()->unverified()->create();

        $this->actingAs($user);

        $response = $this->get(route('filament.email-verification.prompt'));

        $response
            ->assertOk()
            ->assertViewIs('tobira::email-verification.prompt')
        ;
    }

    /** @test */
    public function it_can_redirect_verified_user(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('filament.email-verification.prompt'));

        $response->assertRedirect();
    }
}

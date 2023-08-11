<?php

namespace Kumi\Tobira\Tests\Http\Controllers\Fortify;

use Kumi\Kensa\TestCase;
use Kumi\Tobira\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;

/**
 * @internal
 */
class EmailVerificationNotificationControllerTest extends TestCase
{
    /** @test */
    public function it_can_handle_redirect_for_verified_user(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('filament.email-verification.send'));

        $response->assertRedirect();
    }

    /** @test */
    public function it_can_handle_redirect_for_verified_user_json_request(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->postJson(route('filament.email-verification.send'));

        $response->assertNoContent();
    }

    /** @test */
    public function it_can_handle_resend_email_verification_notification(): void
    {
        Notification::fake();

        $user = User::factory()->unverified()->create();

        $this->actingAs($user);

        $response = $this->post(route('filament.email-verification.send'));

        $response->assertRedirect()
            ->assertSessionHas('status', 'verification-link-sent')
        ;

        Notification::assertSentTo($user, VerifyEmail::class);
    }

    /** @test */
    public function it_can_handle_resend_email_verification_notification_json_request(): void
    {
        Notification::fake();

        $user = User::factory()->unverified()->create();

        $this->actingAs($user);

        $response = $this->postJson(route('filament.email-verification.send'));

        $response->assertStatus(Response::HTTP_ACCEPTED);

        Notification::assertSentTo($user, VerifyEmail::class);
    }

    /** @test */
    public function it_can_throttle_resend_request(): void
    {
        $user = User::factory()->unverified()->create();

        $this->actingAs($user);

        Collection::times(6, function () {
            $response = $this->post(route('filament.email-verification.send'));

            $response->assertRedirect();
        });

        $response = $this->post(route('filament.email-verification.send'));

        $response->assertStatus(Response::HTTP_TOO_MANY_REQUESTS);
    }
}

<?php

namespace Kumi\Tobira\Tests\Http\Controllers\Fortify;

use Kumi\Kensa\TestCase;
use Kumi\Tobira\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\URL;

/**
 * @internal
 */
class VerifyEmailControllerTest extends TestCase
{
    /** @test */
    public function it_can_verify_user_email(): void
    {
        $user = User::factory()->unverified()->create();

        $this->actingAs($user);

        $this->assertFalse($user->hasVerifiedEmail());

        $this->get($this->createTemporarySignedUrl($user));

        $this->assertTrue($user->hasVerifiedEmail());
    }

    /** @test */
    public function it_can_handle_redirect_for_verified_user(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get($this->createTemporarySignedUrl($user));

        $response->assertRedirect();
    }

    /** @test */
    public function it_can_throttle_verify_email_request(): void
    {
        $user = User::factory()->unverified()->create();

        $this->actingAs($user);

        $this->assertFalse($user->hasVerifiedEmail());

        Collection::times(6, function () use ($user) {
            $this->get(route('filament.email-verification.verify', [
                'id' => $user->id,
                'hash' => sha1($user->getEmailForVerification()),
            ]));

            $this->assertFalse($user->hasVerifiedEmail());
        });

        $response = $this->get(route('filament.email-verification.verify', [
            'id' => $user->id,
            'hash' => sha1($user->getEmailForVerification()),
        ]));

        $response->assertStatus(Response::HTTP_TOO_MANY_REQUESTS);

        $this->assertFalse($user->hasVerifiedEmail());
    }

    protected function createTemporarySignedUrl(User $user): string
    {
        return URL::temporarySignedRoute(
            'filament.email-verification.verify',
            now()->addMinutes(config('auth.verification.expire', 60)),
            [
                'id' => $user->getKey(),
                'hash' => sha1($user->getEmailForVerification()),
            ]
        );
    }
}

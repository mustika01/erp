<?php

namespace Kumi\Tobira\Tests\Http\Controllers\Fortify;

use Kumi\Kensa\TestCase;
use Kumi\Tobira\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

/**
 * @internal
 */
class NewPasswordControllerTest extends TestCase
{
    /** @test */
    public function it_can_render_new_password_page(): void
    {
        $user = User::factory()->make();

        $response = $this->get(route('filament.new-password.edit', [
            'token' => 'token',
            'email' => $user->email,
        ]));

        $response
            ->assertOk()
            ->assertViewIs('tobira::new-password.edit')
        ;
    }

    /** @test */
    public function it_can_handle_new_password_request(): void
    {
        $user = User::factory()->create();

        $response = $this->put(route('filament.new-password.update'), [
            'token' => $this->createPasswordResetToken($user),
            'email' => $user->email,
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('status', __(Password::PASSWORD_RESET));

        $this->assertTrue(Hash::check('new-password', $user->fresh()->password));
    }

    /** @test */
    public function it_can_handle_invalid_data(): void
    {
        $user = User::factory()->create();

        $token = $this->createPasswordResetToken($user);

        $response = $this->put(route('filament.new-password.update'), [
            'token' => 'invalid_token',
            'email' => $user->email,
            'password' => 'new_password',
            'password_confirmation' => 'new_password',
        ]);

        $response->assertSessionHasErrors([
            'email' => __(Password::INVALID_TOKEN),
        ]);

        $response = $this->put(route('filament.new-password.update'), [
            'email' => $user->email,
            'password' => 'new_password',
            'password_confirmation' => 'new_password',
        ]);

        $response->assertSessionHasErrors([
            'token' => __('validation.required', ['attribute' => 'token']),
        ]);

        $response = $this->put(route('filament.new-password.update'), [
            'token' => $token,
            'password' => 'new_password',
            'password_confirmation' => 'new_password',
        ]);

        $response->assertSessionHasErrors([
            'email' => __('validation.required', ['attribute' => 'email']),
        ]);

        $response = $this->put(route('filament.new-password.update'), [
            'token' => $token,
            'email' => $user->email,
        ]);

        $response->assertSessionHasErrors([
            'password' => __('validation.required', ['attribute' => 'password']),
        ]);

        $response = $this->put(route('filament.new-password.update'), [
            'token' => $token,
            'email' => $user->email,
            'password' => 'new_password',
        ]);

        $response->assertSessionHasErrors([
            'password' => __('validation.confirmed', ['attribute' => 'password']),
        ]);

        $response = $this->put(route('filament.new-password.update'), [
            'token' => $token,
            'email' => $user->email,
            'password' => 'new_password',
            'password_confirmation' => 'new_password_again',
        ]);

        $response->assertSessionHasErrors([
            'password' => __('validation.confirmed', ['attribute' => 'password']),
        ]);
    }

    protected function createPasswordResetToken(User $user): string
    {
        $token = Password::broker()->createToken($user);

        DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        return $token;
    }
}

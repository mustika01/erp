<?php

namespace Kumi\Tobira\Tests\Http\Controllers\Fortify;

use Kumi\Kensa\TestCase;
use Kumi\Tobira\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * @internal
 */
class RegisteredUserControllerTest extends TestCase
{
    /** @test */
    public function it_can_render_registration_page(): void
    {
        $response = $this->get(route('filament.registration.create'));

        $response
            ->assertOk()
            ->assertViewIs('tobira::registration.create')
        ;
    }

    /** @test */
    public function it_can_handle_registration_request(): void
    {
        $data = User::factory()->raw();

        $this->post(route('filament.registration.store'), [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $user = User::where('email', $data['email'])->first();

        $this->assertEquals($data['name'], $user->name);
        $this->assertEquals($data['email'], $user->email);
        $this->assertTrue(Hash::check('password', $user->password));
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function it_can_handle_invalid_data(): void
    {
        $user = User::factory()->make();

        $response = $this->post(route('filament.registration.store'), [
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors([
            'name' => __('validation.required', ['attribute' => 'name']),
        ]);

        $response = $this->post(route('filament.registration.store'), [
            'name' => $user->name,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors([
            'email' => __('validation.required', ['attribute' => 'email']),
        ]);

        $response = $this->post(route('filament.registration.store'), [
            'name' => $user->name,
            'email' => $user->email,
        ]);

        $response->assertSessionHasErrors([
            'password' => __('validation.required', ['attribute' => 'password']),
        ]);

        $response = $this->post(route('filament.registration.store'), [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors([
            'password' => __('validation.confirmed', ['attribute' => 'password']),
        ]);

        $response = $this->post(route('filament.registration.store'), [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password_again',
        ]);

        $response->assertSessionHasErrors([
            'password' => __('validation.confirmed', ['attribute' => 'password']),
        ]);
    }
}

<?php

namespace Kumi\Kyoka\Tests\Filament\Resources\UserResource\Pages;

use Livewire\Livewire;
use Kumi\Tobira\Models\User;
use Laravel\Fortify\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Kumi\Kensa\AdministratorTestCase;
use Kumi\Tobira\Support\DefaultPermissions;
use Kumi\Kyoka\Filament\Resources\UserResource;
use Kumi\Kyoka\Filament\Resources\UserResource\Pages\CreateUser;

/**
 * @internal
 */
class CreateUserTest extends AdministratorTestCase
{
    /** @test */
    public function it_can_render_create_user_form(): void
    {
        $response = $this->get(UserResource::getUrl('create'));

        $response->assertOk();
    }

    /** @test */
    public function it_can_save_user_data(): void
    {
        $data = User::factory()->make();

        Livewire::test(CreateUser::class)
            ->set('data.name', $data->name)
            ->set('data.email', $data->email)
            ->set('data.password', 'password')
            ->set('data.password_confirmation', 'password')
            ->call('create')
            ->assertHasNoErrors()
        ;

        $user = User::query()->where('email', $data->email)->first();

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($data->name, $user->name);
        $this->assertTrue(Hash::check('password', $user->password));
        $this->assertTrue($user->can(DefaultPermissions::ACCESS_FILAMENT));
    }

    /** @test */
    public function it_can_validate_user_data(): void
    {
        $data = User::factory()->make();

        Livewire::test(CreateUser::class)
            ->set('data.name', null)
            ->set('data.email', $data->email)
            ->set('data.password', 'password')
            ->set('data.password_confirmation', 'password')
            ->call('create')
            ->assertHasErrors(['data.name' => ['required']])
        ;

        Livewire::test(CreateUser::class)
            ->set('data.name', $data->name)
            ->set('data.email', null)
            ->set('data.password', 'password')
            ->set('data.password_confirmation', 'password')
            ->call('create')
            ->assertHasErrors(['data.email' => ['required']])
        ;

        Livewire::test(CreateUser::class)
            ->set('data.name', $data->name)
            ->set('data.email', 'invalid')
            ->set('data.password', 'password')
            ->set('data.password_confirmation', 'password')
            ->call('create')
            ->assertHasErrors(['data.email' => ['email']])
        ;

        Livewire::test(CreateUser::class)
            ->set('data.name', $data->name)
            ->set('data.email', $data->email)
            ->set('data.password', null)
            ->set('data.password_confirmation', 'password')
            ->call('create')
            ->assertHasErrors(['data.password' => ['required']])
        ;

        Livewire::test(CreateUser::class)
            ->set('data.name', $data->name)
            ->set('data.email', $data->email)
            ->set('data.password', 'secret')
            ->set('data.password_confirmation', 'secret')
            ->call('create')
            ->assertHasErrors(['data.password' => [Password::class]])
        ;

        Livewire::test(CreateUser::class)
            ->set('data.name', $data->name)
            ->set('data.email', $data->email)
            ->set('data.password', 'password')
            ->set('data.password_confirmation', null)
            ->call('create')
            ->assertHasErrors(['data.password' => ['confirmed']])
        ;
    }
}

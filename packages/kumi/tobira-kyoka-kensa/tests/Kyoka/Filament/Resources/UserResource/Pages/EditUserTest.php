<?php

namespace Kumi\Kyoka\Tests\Filament\Resources\UserResource\Pages;

use Livewire\Livewire;
use Kumi\Kyoka\Models\Role;
use Kumi\Tobira\Models\User;
use Illuminate\Support\Facades\Hash;
use Kumi\Kyoka\Support\DefaultRoles;
use Kumi\Kensa\AdministratorTestCase;
use Kumi\Kyoka\Filament\Resources\UserResource;
use Kumi\Kyoka\Filament\Resources\UserResource\Pages\EditUser;

/**
 * @internal
 */
class EditUserTest extends AdministratorTestCase
{
    /** @test */
    public function it_can_render_edit_user_form(): void
    {
        $response = $this->get(UserResource::getUrl('edit', [
            'record' => User::factory()->create(),
        ]));

        $response->assertOk();
    }

    /** @test */
    public function it_can_retrieve_user_data(): void
    {
        $user = User::factory()->create();

        Livewire::test(EditUser::class, [
            'record' => $user->getKey(),
        ])
            ->assertSet('data.name', $user->name)
            ->assertSet('data.email', $user->email)
        ;
    }

    /** @test */
    public function it_can_update_user_data(): void
    {
        $user = User::factory()->create();
        $data = User::factory()->make();
        $role = Role::where('name', DefaultRoles::FILAMENT_USER)->first();

        Livewire::test(EditUser::class, [
            'record' => $user->getKey(),
        ])
            ->set('data.name', $data->name)
            ->set('data.email', $data->email)
            ->set('data.roles', [$role->id])
            ->call('save')
            ->assertHasNoErrors()
        ;

        tap($user->fresh(), function (User $user) use ($data) {
            $this->assertEquals($data->name, $user->name);
            $this->assertEquals($data->email, $user->email);
            $this->assertTrue($user->hasRole(DefaultRoles::FILAMENT_USER));
        });
    }

    /** @test */
    public function it_can_update_user_password(): void
    {
        $user = User::factory()->create();
        $data = User::factory()->make();
        $role = Role::where('name', DefaultRoles::FILAMENT_USER)->first();

        Livewire::test(EditUser::class, [
            'record' => $user->getKey(),
        ])
            ->set('data.name', $data->name)
            ->set('data.email', $data->email)
            ->set('data.password', 'new-password')
            ->set('data.password_confirmation', 'new-password')
            ->set('data.roles', [$role->id])
            ->call('save')
            ->assertHasNoErrors()
        ;

        tap($user->fresh(), function (User $user) {
            $this->assertTrue(Hash::check('new-password', $user->password));
        });
    }

    /** @test */
    public function it_can_validate_user_data(): void
    {
        $user = User::factory()->create();
        $data = User::factory()->make();

        Livewire::test(EditUser::class, [
            'record' => $user->getKey(),
        ])
            ->set('data.name', null)
            ->set('data.email', $data->email)
            ->call('save')
            ->assertHasErrors(['data.name' => ['required']])
        ;

        Livewire::test(EditUser::class, [
            'record' => $user->getKey(),
        ])
            ->set('data.name', $data->name)
            ->set('data.email', null)
            ->call('save')
            ->assertHasErrors(['data.email' => ['required']])
        ;

        Livewire::test(EditUser::class, [
            'record' => $user->getKey(),
        ])
            ->set('data.name', $data->name)
            ->set('data.email', 'invalid')
            ->call('save')
            ->assertHasErrors(['data.email' => ['email']])
        ;
    }

    /** @test */
    public function it_can_delete_user(): void
    {
        $user = User::factory()->create();
        $data = $user->toArray();

        Livewire::test(EditUser::class, [
            'record' => $user->getKey(),
        ])->call('delete');

        $this->assertDatabaseMissing($user, $data);
    }
}

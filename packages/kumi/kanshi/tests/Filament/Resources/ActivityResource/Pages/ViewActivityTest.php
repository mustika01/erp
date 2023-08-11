<?php

namespace Kumi\Kanshi\Tests\Filament\Resources\ActivityResource\Pages;

use Livewire\Livewire;
use Kumi\Tobira\Models\User;
use Kumi\Kanshi\Models\Activity;
use Kumi\Kanshi\Tests\Cases\AdministratorTestCase;
use Kumi\Kanshi\Filament\Resources\ActivityResource;
use Kumi\Kanshi\Filament\Resources\ActivityResource\Pages\ViewActivity;

/**
 * @internal
 */
class ViewActivityTest extends AdministratorTestCase
{
    /** @test */
    public function it_can_render_view_employee_page(): void
    {
        $activity = $this->createActivity();

        $response = $this->get(ActivityResource::getUrl('view', [
            'record' => $activity,
        ]));

        $response->assertOk();
    }

    /** @test */
    public function it_can_retrieve_employee_data(): void
    {
        $activity = $this->createActivity();

        Livewire::test(ViewActivity::class, [
            'record' => $activity->getKey(),
        ])
            ->assertSet('data.created_at', $activity->created_at)
            ->assertSet('data.subject.name', $activity->subject->name)
            ->assertSet('data.causer.name', $activity->causer->name)
            ->assertSet('data.description', $activity->description)
        ;
    }

    protected function createActivity(): Activity
    {
        return Activity::factory()
            ->afterCreating(function (Activity $activity) {
                $user = User::factory()->create();

                $activity->subject()->associate($user);
                $activity->causer()->associate($user);
                $activity->save();
            })
            ->create()
        ;
    }
}

<?php

namespace Kumi\Kanshi\Tests\Filament\Resources\ActivityResource\Pages;

use Livewire\Livewire;
use Illuminate\Http\Response;
use Kumi\Kanshi\Models\Activity;
use Kumi\Kanshi\Tests\Cases\AdministratorTestCase;
use Kumi\Kanshi\Filament\Resources\ActivityResource\Pages\ListActivities;

/**
 * @internal
 */
class ListActivitiesTest extends AdministratorTestCase
{
    /** @test */
    public function it_can_list_employees(): void
    {
        Activity::factory()->count(10)->create();

        $response = Livewire::test(ListActivities::class);
        $response->assertStatus(Response::HTTP_OK);

        $this->assertCount(10, $response->instance()->getTableRecords()->items());
    }
}

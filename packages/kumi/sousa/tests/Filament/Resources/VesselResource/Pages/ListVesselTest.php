<?php

namespace Kumi\Sousa\Tests\Filament\Resources\VesselVoyageResource\Pages;

use Livewire\Livewire;
use Kumi\Sousa\Models\Vessel;
use Kumi\Sousa\Support\Enums\VesselStatus;
use Kumi\Sousa\Tests\Cases\AdministratorTestCase;
use Kumi\Sousa\Filament\Resources\VesselResource\Pages\ListVessels;

/**
 * @internal
 */
class ListVesselTest extends AdministratorTestCase
{
    public function test_render_vessels()
    {
        Livewire::test(ListVessels::class)
            ->assertSuccessful()
        ;
    }

    public function test_list_vessels()
    {
        $vessels = Vessel::factory()->operational()->count(5)->create();

        Livewire::test(ListVessels::class)
            ->assertCanSeeTableRecords($vessels)
        ;
    }

    public function test_list_vessel_voyage_name()
    {
        Vessel::factory()->count(5)->create();

        Livewire::test(ListVessels::class)
            ->assertCanRenderTableColumn('name')
            ->assertCanRenderTableColumn('properties.length')
            ->assertCanRenderTableColumn('properties.breadth')
            ->assertCanRenderTableColumn('properties.depth')
            ->assertCanRenderTableColumn('properties.draft')
            ->assertCanRenderTableColumn('properties.last_docked_at')

        ;
    }

    public function test_can_filter_vessel_search_by_name()
    {
        $vessels = Vessel::factory()->operational()->count(5)->create();

        $name = $vessels->first()->name;

        Livewire::test(ListVessels::class)
            ->searchTable($name)
            ->assertCanSeeTableRecords($vessels->where('name', $name))
            ->assertCanNotSeeTableRecords($vessels->where('name', '!=', $name))

        ;
    }

    public function test_can_filter_by_status()
    {
        $operational_vessels = Vessel::factory()->operational()->count(5)->create();
        $sold_vessels = Vessel::factory()->sold()->count(5)->create();
        $scrapped_vessels = Vessel::factory()->scrapped()->count(5)->create();

        Livewire::test(ListVessels::class)
            ->assertCanSeeTableRecords($operational_vessels)
            ->filterTable('status', VesselStatus::SOLD)
            ->assertCanSeeTableRecords($sold_vessels)
            ->assertCanNotSeeTableRecords($scrapped_vessels)
            ->assertCanNotSeeTableRecords($operational_vessels)
        ;

        Livewire::test(ListVessels::class)
            ->assertCanSeeTableRecords($operational_vessels)
            ->filterTable('status', VesselStatus::SCRAPPED)
            ->assertCanSeeTableRecords($scrapped_vessels)
            ->assertCanNotSeeTableRecords($sold_vessels)
            ->assertCanNotSeeTableRecords($operational_vessels)
        ;

        Livewire::test(ListVessels::class)
            ->assertCanSeeTableRecords($operational_vessels)
            ->filterTable('status', VesselStatus::OPERATIONAL)
            ->assertCanSeeTableRecords($operational_vessels)
            ->assertCanNotSeeTableRecords($scrapped_vessels)
            ->assertCanNotSeeTableRecords($sold_vessels)
        ;
    }

    public function test_can_sort_vessel_by_name()
    {
        $vessels = Vessel::factory()->operational()->count(5)->create();

        Livewire::test(ListVessels::class)
            ->sortTable('name')
            ->assertCanSeeTableRecords($vessels->sortBy('name'), inOrder: true)
            ->sortTable('name', 'desc')
            ->assertCanSeeTableRecords($vessels->sortByDesc('name'), inOrder: true)
        ;
    }
}

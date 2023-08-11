<?php

namespace Kumi\Sousa\Tests\Filament\Resources\VesselVoyageResource\Pages;

use Livewire\Livewire;
use Kumi\Sousa\Models\VesselVoyage;
use Kumi\Sousa\Tests\Cases\AdministratorTestCase;
use Kumi\Sousa\Filament\Resources\VesselVoyageResource\Pages\ListVesselVoyages;

/**
 * @internal
 */
class ListVesselVoyagesTest extends AdministratorTestCase
{
    // render
    public function test_render_vessel_voyage()
    {
        Livewire::test(ListVesselVoyages::class)
            ->assertSuccessful()
        ;
    }

    public function test_list_vessel_voyage()
    {
        $voyage = VesselVoyage::factory()->count(5)->create();

        Livewire::test(ListVesselVoyages::class)
            ->assertCanSeeTableRecords($voyage)
        ;
    }

    public function test_list_vessel_voyage_columns()
    {
        VesselVoyage::factory()->count(5)->create();

        Livewire::test(ListVesselVoyages::class)
            ->assertCanRenderTableColumn('vessel.name')
            ->assertCanRenderTableColumn('number')
            ->assertCanRenderTableColumn('originCity.name')
            ->assertCanRenderTableColumn('destinationCity.name')
            ->assertCanRenderTableColumn('status')

        ;
    }

    public function test_can_filter_search_by_vessel_id()
    {
        $voyages = VesselVoyage::factory()->count(5)->create();

        $vesselId = $voyages->first()->vessel_id;

        Livewire::test(ListVesselVoyages::class)
            ->assertCanSeeTableRecords($voyages)
            ->filterTable('vessel_id', $vesselId)
            ->assertCanSeeTableRecords($voyages->where('vessel_id', $vesselId))
            ->assertCanNotSeeTableRecords($voyages->where('vessel_id', '!=', $vesselId))

        ;
    }

    public function test_can_filter_by_is_returning()
    {
        $voyages = VesselVoyage::factory()->count(5)->create();

        Livewire::test(ListVesselVoyages::class)
            ->assertCanSeeTableRecords($voyages)
            ->filterTable('is_returning')
            ->assertCanSeeTableRecords($voyages->where('is_returning', true))
            ->assertCanNotSeeTableRecords($voyages->where('is_returning', false))

        ;
    }
}

<?php

namespace Kumi\Sousa\Tests\Filament\Resources\VesselVoyageResource\Pages;

use Livewire\Livewire;
use Kumi\Sousa\Models\VesselVoyage;
use Kumi\Sousa\Tests\Cases\AdministratorTestCase;
use Kumi\Sousa\Filament\Resources\VesselVoyageResource\Pages\ViewVesselVoyage;

/**
 * @internal
 */
class ViewVesselVoyageTest extends AdministratorTestCase
{
    public function test_render_page_vessel_voyage_view()
    {
        $voyage = VesselVoyage::factory()->create();

        Livewire::test(ViewVesselVoyage::class, [
            'record' => $voyage->getKey(),
        ])->assertSuccessful()
        ;
    }

    public function test_retrieve_data()
    {
        $voyage = VesselVoyage::factory()->create();
        $newData = VesselVoyage::factory()->make();

        Livewire::test(ViewVesselVoyage::class, [
            'record' => $voyage->getKey(),
        ])
            ->assertFormSet([
                'id' => $voyage->getKey(),
                'number' => $voyage->number,
                'cargo_content' => $voyage->cargo_content,
                'is_returning' => $voyage->is_returning,
                'vessel_id' => $voyage->vessel_id,
                'origin_port_id' => $voyage->origin_port_id,
                'origin_city_id' => $voyage->origin_city_id,
                'destination_city_id' => $voyage->destination_city_id,
                'destination_port_id' => $voyage->destination_port_id,
            ])
        ;
    }
}

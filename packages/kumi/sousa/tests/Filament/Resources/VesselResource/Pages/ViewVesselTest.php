<?php

namespace Kumi\Sousa\Tests\Filament\Resources\VesselVoyageResource\Pages;

use Livewire\Livewire;
use Kumi\Sousa\Models\Vessel;
use Kumi\Sousa\Tests\Cases\AdministratorTestCase;
use Kumi\Sousa\Filament\Resources\VesselResource\Pages\ViewVessel;

/**
 * @internal
 */
class ViewVesselTest extends AdministratorTestCase
{
    public function test_render_page_vessel_view()
    {
        $vessel = Vessel::factory()->create();

        Livewire::test(ViewVessel::class, [
            'record' => $vessel->getKey(),
        ])->assertSuccessful()
        ;
    }

    public function test_retrieve_data_vessel()
    {
        $vessel = Vessel::factory()->create();

        Livewire::test(ViewVessel::class, [
            'record' => $vessel->getKey(),
        ])
            ->assertFormSet([
                'id' => $vessel->getKey(),
                'name' => $vessel->name,
                'properties.registration_number' => $vessel->properties['registration_number'],
                'properties.vessel_type' => $vessel->properties['vessel_type'],
                'properties.imo_number' => $vessel->properties['imo_number'],
                'properties.registration_port' => $vessel->properties['registration_port'],
                'properties.call_sign' => $vessel->properties['call_sign'],
                'properties.flag_nationality' => $vessel->properties['flag_nationality'],
                'properties.classification' => $vessel->properties['classification'],
                'properties.status' => $vessel->properties['status'],
                'properties.year_built' => $vessel->properties['year_built'],
                'properties.builder_name' => $vessel->properties['builder_name'],
                'properties.hull_material' => $vessel->properties['hull_material'],
                'properties.main_engine' => $vessel->properties['main_engine'],
                'properties.aux_engine' => $vessel->properties['aux_engine'],
                // 'properties.crane_description' => $vessel->properties['crane_description'],
                'properties.average_cruise_speed' => $vessel->properties['average_cruise_speed'],
                // 'properties.last_docked_at' => $vessel->properties['last_docked_at'],
                // 'properties.next_docked_at' => $vessel->properties['next_docked_at'],
                'properties.length' => $vessel->properties['length'],
                'properties.breadth' => $vessel->properties['breadth'],
                'properties.depth' => $vessel->properties['depth'],
                'properties.draft' => $vessel->properties['draft'],
                'properties.gross_tonnage' => $vessel->properties['gross_tonnage'],
                'properties.nett_tonnage' => $vessel->properties['nett_tonnage'],
                'properties.dead_weight_tonnage' => $vessel->properties['dead_weight_tonnage'],
            ])

        ;
    }
}

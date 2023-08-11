<?php

namespace Kumi\Sousa\Tests\Filament\Resources\VesselResource\Pages;

use Livewire\Livewire;
use Kumi\Sousa\Models\Vessel;
use Kumi\Sousa\Tests\Cases\AdministratorTestCase;
use Kumi\Sousa\Filament\Resources\VesselResource\Pages\EditVessel;

/**
 * @internal
 */
class EditVesselTest extends AdministratorTestCase
{
    public function test_render_edit_vessel_page()
    {
        $vessel = Vessel::factory()->create();

        Livewire::test(EditVessel::class, [
            'record' => $vessel->getKey(),
        ])->assertSuccessful();
    }

    public function test_update_vessel()
    {
        $vessel = Vessel::factory()->create();
        $newData = Vessel::factory()->make();

        Livewire::test(EditVessel::class, [
            'record' => $vessel->getKey(),
        ])
            ->assertFormSet([
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
                'properties.crane_description' => $vessel->properties['crane_description'],
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
            ->fillForm([
                'name' => $newData->name,

                'properties.registration_number' => $newData->properties['registration_number'],
                'properties.vessel_type' => $newData->properties['vessel_type'],
                'properties.imo_number' => $newData->properties['imo_number'],
                'properties.registration_port' => $newData->properties['registration_port'],
                'properties.call_sign' => $newData->properties['call_sign'],
                'properties.flag_nationality' => $newData->properties['flag_nationality'],
                'properties.classification' => $newData->properties['classification'],
                'properties.status' => $newData->properties['status'],
                'properties.year_built' => $newData->properties['year_built'],
                'properties.builder_name' => $newData->properties['builder_name'],
                'properties.hull_material' => $newData->properties['hull_material'],
                'properties.main_engine' => $newData->properties['main_engine'],
                'properties.aux_engine' => $newData->properties['aux_engine'],
                'properties.crane_description' => null,
                'properties.average_cruise_speed' => $newData->properties['average_cruise_speed'],
                'properties.last_docked_at' => $newData->properties['last_docked_at'],
                'properties.next_docked_at' => $newData->properties['next_docked_at'],
                'properties.length' => $newData->properties['length'],
                'properties.breadth' => $newData->properties['breadth'],
                'properties.depth' => $newData->properties['depth'],
                'properties.draft' => $newData->properties['draft'],
                'properties.gross_tonnage' => $newData->properties['gross_tonnage'],
                'properties.nett_tonnage' => $newData->properties['nett_tonnage'],
                'properties.dead_weight_tonnage' => $newData->properties['dead_weight_tonnage'],
            ])
            ->call('save')
            ->assertHasNoFormErrors()
        ;

        $this->assertDatabaseHas(Vessel::class, [
            'id' => $vessel->getKey(),
            'name' => $newData->name,
            'properties' => json_encode([
                'registration_number' => $newData->properties['registration_number'],
                'vessel_type' => $newData->properties['vessel_type'],
                'imo_number' => $newData->properties['imo_number'],
                'registration_port' => $newData->properties['registration_port'],
                'call_sign' => $newData->properties['call_sign'],
                'flag_nationality' => $newData->properties['flag_nationality'],
                'classification' => $newData->properties['classification'],
                'status' => $newData->properties['status'],
                'year_built' => $newData->properties['year_built'],
                'builder_name' => $newData->properties['builder_name'],
                'hull_material' => $newData->properties['hull_material'],
                'main_engine' => $newData->properties['main_engine'],
                'aux_engine' => $newData->properties['aux_engine'],
                'crane_description' => null,
                'average_cruise_speed' => $newData->properties['average_cruise_speed'],
                'last_docked_at' => $newData->properties['last_docked_at'],
                'next_docked_at' => $newData->properties['next_docked_at'],
                'length' => $newData->properties['length'],
                'breadth' => $newData->properties['breadth'],
                'depth' => $newData->properties['depth'],
                'draft' => $newData->properties['draft'],
                'gross_tonnage' => $newData->properties['gross_tonnage'],
                'nett_tonnage' => $newData->properties['nett_tonnage'],
                'dead_weight_tonnage' => $newData->properties['dead_weight_tonnage'],
            ]),
        ]);
    }

    public function test_validate_edit_vessel_name()
    {
        $vessel = Vessel::factory()->create();

        Livewire::test(EditVessel::class, [
            'record' => $vessel->getKey(),
        ])
            ->fillForm([
                'name' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['name' => 'required'])
        ;
    }

    public function test_validate_vessel_vesel_type()
    {
        $vessel = Vessel::factory()->create();

        Livewire::test(EditVessel::class, [
            'record' => $vessel->getKey(),
        ])
            ->fillForm([
                'properties.vessel_type' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['properties.vessel_type' => 'required'])
        ;
    }

    public function test_validate_vessel_registration_port()
    {
        $vessel = Vessel::factory()->create();

        Livewire::test(EditVessel::class, [
            'record' => $vessel->getKey(),
        ])
            ->fillForm([
                'properties.registration_port' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['properties.registration_port' => 'required'])
        ;
    }

    public function test_validate_vessel_status()
    {
        $vessel = Vessel::factory()->create();

        Livewire::test(EditVessel::class, [
            'record' => $vessel->getKey(),
        ])
            ->fillForm([
                'properties.status' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['properties.status' => 'required'])
        ;
    }

    public function test_validate_vessel_year_built()
    {
        $vessel = Vessel::factory()->create();

        Livewire::test(EditVessel::class, [
            'record' => $vessel->getKey(),
        ])
            ->fillForm([
                'properties.year_built' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['properties.year_built' => 'required'])
        ;
    }

    public function test_validate_vessel_main_engine()
    {
        $vessel = Vessel::factory()->create();

        Livewire::test(EditVessel::class, [
            'record' => $vessel->getKey(),
        ])
            ->fillForm([
                'properties.main_engine' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['properties.main_engine' => 'required'])
        ;
    }

    public function test_validate_vessel_length()
    {
        $vessel = Vessel::factory()->create();

        Livewire::test(EditVessel::class, [
            'record' => $vessel->getKey(),
        ])
            ->fillForm([
                'properties.length' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['properties.length' => 'required'])
        ;
    }

    public function test_validate_vessel_breadth()
    {
        $vessel = Vessel::factory()->create();

        Livewire::test(EditVessel::class, [
            'record' => $vessel->getKey(),
        ])
            ->fillForm([
                'properties.breadth' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['properties.breadth' => 'required'])
        ;
    }

    public function test_validate_vessel_depth()
    {
        $vessel = Vessel::factory()->create();

        Livewire::test(EditVessel::class, [
            'record' => $vessel->getKey(),
        ])
            ->fillForm([
                'properties.depth' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['properties.depth' => 'required'])
        ;
    }

    public function test_validate_vessel_draft()
    {
        $vessel = Vessel::factory()->create();

        Livewire::test(EditVessel::class, [
            'record' => $vessel->getKey(),
        ])
            ->fillForm([
                'properties.draft' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['properties.draft' => 'required'])
        ;
    }

    public function test_validate_gross_tonnage()
    {
        $vessel = Vessel::factory()->create();

        Livewire::test(EditVessel::class, [
            'record' => $vessel->getKey(),
        ])
            ->fillForm([
                'properties.gross_tonnage' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['properties.gross_tonnage' => 'required'])
        ;
    }

    public function test_validate_dead_weight_tonnage()
    {
        $vessel = Vessel::factory()->create();

        Livewire::test(EditVessel::class, [
            'record' => $vessel->getKey(),
        ])
            ->fillForm([
                'properties.dead_weight_tonnage' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['properties.dead_weight_tonnage' => 'required'])
        ;
    }
}

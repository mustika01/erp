<?php

namespace Kumi\Sousa\Tests\Filament\Resources\VesselVoyageResource\Pages;

use Livewire\Livewire;
use Kumi\Sousa\Models\Vessel;
use Kumi\Sousa\Tests\Cases\AdministratorTestCase;
use Kumi\Sousa\Filament\Resources\VesselResource\Pages\CreateVessel;

/**
 * @internal
 */
class CreateVesselTest extends AdministratorTestCase
{
    public function test_render_create_vessel_page()
    {
        Livewire::test(CreateVessel::class)
            ->assertSuccessful()
        ;
    }

    public function test_create_vessel()
    {
        $newData = Vessel::factory()->make();

        Livewire::test(CreateVessel::class)
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
                'properties.crane_description' => $newData->properties['crane_description'],
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
            ->call('create')
            ->assertHasNoFormErrors()
        ;

        $this->assertDatabaseHas(Vessel::class, [
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
                'crane_description' => $newData->properties['crane_description'],
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

    public function test_validate_vessel_name()
    {
        $newData = Vessel::factory()->make();

        Livewire::test(CreateVessel::class)
            ->fillForm([
                'name' => null,

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
            ->call('create')
            ->assertHasFormErrors(['name' => 'required'])
        ;
    }

    public function test_validate_vessel_type()
    {
        $newData = Vessel::factory()->make();

        Livewire::test(CreateVessel::class)
            ->fillForm([
                'name' => $newData->name,

                'properties.registration_number' => $newData->properties['registration_number'],
                'properties.vessel_type' => null,
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
            ->call('create')
            ->assertHasFormErrors(['properties.vessel_type' => 'required'])
        ;
    }

    public function test_validate_vessel_registration_port()
    {
        $newData = Vessel::factory()->make();

        Livewire::test(CreateVessel::class)
            ->fillForm([
                'name' => $newData->name,

                'properties.registration_number' => $newData->properties['registration_number'],
                'properties.vessel_type' => $newData->properties['vessel_type'],
                'properties.imo_number' => $newData->properties['imo_number'],
                'properties.registration_port' => null,
                'properties.call_sign' => $newData->properties['call_sign'],
                'properties.flag_nationality' => $newData->properties['flag_nationality'],
                'properties.classification' => $newData->properties['classification'],
                'properties.status' => $newData->properties['status'],
                'properties.year_built' => $newData->properties['year_built'],
                'properties.builder_name' => $newData->properties['builder_name'],
                'properties.hull_material' => $newData->properties['hull_material'],
                'properties.main_engine' => $newData->properties['main_engine'],
                'properties.aux_engine' => $newData->properties['aux_engine'],
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
            ->call('create')
            ->assertHasFormErrors(['properties.registration_port' => 'required'])
        ;
    }

    public function test_validate_vessel_status()
    {
        $newData = Vessel::factory()->make();

        Livewire::test(CreateVessel::class)
            ->fillForm([
                'name' => $newData->name,

                'properties.registration_number' => $newData->properties['registration_number'],
                'properties.vessel_type' => $newData->properties['vessel_type'],
                'properties.imo_number' => $newData->properties['imo_number'],
                'properties.registration_port' => $newData->properties['registration_port'],
                'properties.call_sign' => $newData->properties['call_sign'],
                'properties.flag_nationality' => $newData->properties['flag_nationality'],
                'properties.classification' => $newData->properties['classification'],
                'properties.status' => null,
                'properties.year_built' => $newData->properties['year_built'],
                'properties.builder_name' => $newData->properties['builder_name'],
                'properties.hull_material' => $newData->properties['hull_material'],
                'properties.main_engine' => $newData->properties['main_engine'],
                'properties.aux_engine' => $newData->properties['aux_engine'],
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
            ->call('create')
            ->assertHasFormErrors(['properties.status' => 'required'])
        ;
    }

    public function test_validate_vessel_year_build()
    {
        $newData = Vessel::factory()->make();

        Livewire::test(CreateVessel::class)
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
                'properties.year_built' => null,
                'properties.builder_name' => $newData->properties['builder_name'],
                'properties.hull_material' => $newData->properties['hull_material'],
                'properties.main_engine' => $newData->properties['main_engine'],
                'properties.aux_engine' => $newData->properties['aux_engine'],
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
            ->call('create')
            ->assertHasFormErrors(['properties.year_built' => 'required'])
        ;
    }

    public function test_validate_vessel_main_engine()
    {
        $newData = Vessel::factory()->make();

        Livewire::test(CreateVessel::class)
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
                'properties.main_engine' => null,
                'properties.aux_engine' => $newData->properties['aux_engine'],
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
            ->call('create')
            ->assertHasFormErrors(['properties.main_engine' => 'required'])
        ;
    }

    public function test_validate_vessel_length()
    {
        $newData = Vessel::factory()->make();

        Livewire::test(CreateVessel::class)
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
                'properties.average_cruise_speed' => $newData->properties['average_cruise_speed'],
                'properties.last_docked_at' => $newData->properties['last_docked_at'],
                'properties.next_docked_at' => $newData->properties['next_docked_at'],
                'properties.length' => null,
                'properties.breadth' => $newData->properties['breadth'],
                'properties.depth' => $newData->properties['depth'],
                'properties.draft' => $newData->properties['draft'],
                'properties.gross_tonnage' => $newData->properties['gross_tonnage'],
                'properties.nett_tonnage' => $newData->properties['nett_tonnage'],
                'properties.dead_weight_tonnage' => $newData->properties['dead_weight_tonnage'],
            ])
            ->call('create')
            ->assertHasFormErrors(['properties.length' => 'required'])
        ;
    }

    public function test_validate_vessel_breadth()
    {
        $newData = Vessel::factory()->make();

        Livewire::test(CreateVessel::class)
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
                'properties.average_cruise_speed' => $newData->properties['average_cruise_speed'],
                'properties.last_docked_at' => $newData->properties['last_docked_at'],
                'properties.next_docked_at' => $newData->properties['next_docked_at'],
                'properties.length' => $newData->properties['length'],
                'properties.breadth' => null,
                'properties.depth' => $newData->properties['depth'],
                'properties.draft' => $newData->properties['draft'],
                'properties.gross_tonnage' => $newData->properties['gross_tonnage'],
                'properties.nett_tonnage' => $newData->properties['nett_tonnage'],
                'properties.dead_weight_tonnage' => $newData->properties['dead_weight_tonnage'],
            ])
            ->call('create')
            ->assertHasFormErrors(['properties.breadth' => 'required'])
        ;
    }

    public function test_validate_vessel_depth()
    {
        $newData = Vessel::factory()->make();

        Livewire::test(CreateVessel::class)
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
                'properties.average_cruise_speed' => $newData->properties['average_cruise_speed'],
                'properties.last_docked_at' => $newData->properties['last_docked_at'],
                'properties.next_docked_at' => $newData->properties['next_docked_at'],
                'properties.length' => $newData->properties['length'],
                'properties.breadth' => $newData->properties['breadth'],
                'properties.depth' => null,
                'properties.draft' => $newData->properties['draft'],
                'properties.gross_tonnage' => $newData->properties['gross_tonnage'],
                'properties.nett_tonnage' => $newData->properties['nett_tonnage'],
                'properties.dead_weight_tonnage' => $newData->properties['dead_weight_tonnage'],
            ])
            ->call('create')
            ->assertHasFormErrors(['properties.depth' => 'required'])
        ;
    }

    public function test_validate_vessel_draft()
    {
        $newData = Vessel::factory()->make();

        Livewire::test(CreateVessel::class)
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
                'properties.average_cruise_speed' => $newData->properties['average_cruise_speed'],
                'properties.last_docked_at' => $newData->properties['last_docked_at'],
                'properties.next_docked_at' => $newData->properties['next_docked_at'],
                'properties.length' => $newData->properties['length'],
                'properties.breadth' => $newData->properties['breadth'],
                'properties.depth' => $newData->properties['depth'],
                'properties.draft' => null,
                'properties.gross_tonnage' => $newData->properties['gross_tonnage'],
                'properties.nett_tonnage' => $newData->properties['nett_tonnage'],
                'properties.dead_weight_tonnage' => $newData->properties['dead_weight_tonnage'],
            ])
            ->call('create')
            ->assertHasFormErrors(['properties.draft' => 'required'])
        ;
    }

    public function test_validate_vessel_gross_tonnage()
    {
        $newData = Vessel::factory()->make();

        Livewire::test(CreateVessel::class)
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
                'properties.average_cruise_speed' => $newData->properties['average_cruise_speed'],
                'properties.last_docked_at' => $newData->properties['last_docked_at'],
                'properties.next_docked_at' => $newData->properties['next_docked_at'],
                'properties.length' => $newData->properties['length'],
                'properties.breadth' => $newData->properties['breadth'],
                'properties.depth' => $newData->properties['depth'],
                'properties.draft' => $newData->properties['draft'],
                'properties.gross_tonnage' => null,
                'properties.nett_tonnage' => $newData->properties['nett_tonnage'],
                'properties.dead_weight_tonnage' => $newData->properties['dead_weight_tonnage'],
            ])
            ->call('create')
            ->assertHasFormErrors(['properties.gross_tonnage' => 'required'])
        ;
    }

    public function test_validate_vessel_dead_weight_tonnage()
    {
        $newData = Vessel::factory()->make();

        Livewire::test(CreateVessel::class)
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
                'properties.average_cruise_speed' => $newData->properties['average_cruise_speed'],
                'properties.last_docked_at' => $newData->properties['last_docked_at'],
                'properties.next_docked_at' => $newData->properties['next_docked_at'],
                'properties.length' => $newData->properties['length'],
                'properties.breadth' => $newData->properties['breadth'],
                'properties.depth' => $newData->properties['depth'],
                'properties.draft' => $newData->properties['draft'],
                'properties.gross_tonnage' => $newData->properties['gross_tonnage'],
                'properties.nett_tonnage' => $newData->properties['nett_tonnage'],
                'properties.dead_weight_tonnage' => null,
            ])
            ->call('create')
            ->assertHasFormErrors(['properties.dead_weight_tonnage' => 'required'])
        ;
    }
}

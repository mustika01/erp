<?php

namespace Kumi\Sousa\Tests\Filament\Resources\VesselVoyageResource\Pages;

use Livewire\Livewire;
use Kumi\Sousa\Models\VesselVoyage;
use Kumi\Sousa\Tests\Cases\AdministratorTestCase;
use Kumi\Sousa\Filament\Resources\VesselVoyageResource\Pages\CreateVesselVoyage;

/**
 * @internal
 */
class CreateVesselVoyageTest extends AdministratorTestCase
{
    public function test_render_create_voyage_page()
    {
        Livewire::test(CreateVesselVoyage::class)
            ->assertSuccessful()
        ;
    }

    public function test_create_vessel_voyage()
    {
        $newData = VesselVoyage::factory()->make();

        Livewire::test(CreateVesselVoyage::class)
            ->fillForm([
                'number' => $newData->number,
                'cargo_content' => $newData->cargo_content,
                'is_returning' => $newData->is_returning,
                'vessel_id' => $newData->vessel_id,
                'origin_port_id' => $newData->origin_port_id,
                'origin_city_id' => $newData->origin_city_id,
                'destination_city_id' => $newData->destination_city_id,
                'destination_port_id' => $newData->destination_port_id,
            ])
            ->call('create')
            ->assertHasNoFormErrors()
        ;

        $this->assertDatabaseHas(VesselVoyage::class, [
            'vessel_id' => $newData->vessel_id,
            'origin_port_id' => $newData->origin_port_id,
            'origin_city_id' => $newData->origin_city_id,
            'destination_city_id' => $newData->destination_city_id,
            'destination_port_id' => $newData->destination_port_id,
            'number' => $newData->number,
            'cargo_content' => $newData->cargo_content,
            'is_returning' => $newData->is_returning,
        ]);
    }

    public function test_validate_vessel_vessel_id()
    {
        $newData = VesselVoyage::factory()->make();

        Livewire::test(CreateVesselVoyage::class)
            ->fillForm([
                'vessel_id' => null,
                'origin_port_id' => $newData->origin_port_id,
                'origin_city_id' => $newData->origin_city_id,
                'destination_city_id' => $newData->destination_city_id,
                'destination_port_id' => $newData->destination_port_id,
                'number' => $newData->number,
                'cargo_content' => $newData->cargo_content,
                'is_returning' => $newData->is_returning,
            ])
            ->call('create')
            ->assertHasFormErrors(['vessel_id' => 'required'])
        ;
    }

    public function test_validate_vessel_origin_port_id()
    {
        $newData = VesselVoyage::factory()->make();

        Livewire::test(CreateVesselVoyage::class)
            ->fillForm([
                'vessel_id' => $newData->vessel_id,
                'origin_port_id' => null,
                'origin_city_id' => $newData->origin_city_id,
                'destination_city_id' => $newData->destination_city_id,
                'destination_port_id' => $newData->destination_port_id,
                'number' => $newData->number,
                'cargo_content' => $newData->cargo_content,
                'is_returning' => $newData->is_returning,
            ])
            ->call('create')
            ->assertHasFormErrors(['origin_port_id' => 'required'])
        ;
    }

    public function test_validate_vessel_origin_city_id()
    {
        $newData = VesselVoyage::factory()->make();

        Livewire::test(CreateVesselVoyage::class)
            ->fillForm([
                'vessel_id' => $newData->vessel_id,
                'origin_port_id' => $newData->origin_port_id,
                'origin_city_id' => null,
                'destination_city_id' => $newData->destination_city_id,
                'destination_port_id' => $newData->destination_port_id,
                'number' => $newData->number,
                'cargo_content' => $newData->cargo_content,
                'is_returning' => $newData->is_returning,
            ])
            ->call('create')
            ->assertHasFormErrors(['origin_city_id' => 'required'])
        ;
    }

    public function test_validate_vessel_destination_city_id()
    {
        $newData = VesselVoyage::factory()->make();

        Livewire::test(CreateVesselVoyage::class)
            ->fillForm([
                'vessel_id' => $newData->vessel_id,
                'origin_port_id' => $newData->origin_port_id,
                'origin_city_id' => $newData->origin_city_id,
                'destination_city_id' => null,
                'destination_port_id' => $newData->destination_port_id,
                'number' => $newData->number,
                'cargo_content' => $newData->cargo_content,
                'is_returning' => $newData->is_returning,
            ])
            ->call('create')
            ->assertHasFormErrors(['destination_city_id' => 'required'])
        ;
    }

    public function test_validate_vessel_destination_port_id()
    {
        $newData = VesselVoyage::factory()->make();

        Livewire::test(CreateVesselVoyage::class)
            ->fillForm([
                'vessel_id' => $newData->vessel_id,
                'origin_port_id' => $newData->origin_port_id,
                'origin_city_id' => $newData->origin_city_id,
                'destination_city_id' => $newData->destination_city_id,
                'destination_port_id' => null,
                'number' => $newData->number,
                'cargo_content' => $newData->cargo_content,
                'is_returning' => $newData->is_returning,
            ])
            ->call('create')
            ->assertHasFormErrors(['destination_port_id' => 'required'])
        ;
    }

    public function test_validate_vessel_number()
    {
        $newData = VesselVoyage::factory()->make();

        Livewire::test(CreateVesselVoyage::class)
            ->fillForm([
                'vessel_id' => $newData->vessel_id,
                'origin_port_id' => $newData->origin_port_id,
                'origin_city_id' => $newData->origin_city_id,
                'destination_city_id' => $newData->destination_city_id,
                'destination_port_id' => $newData->destination_port_id,
                'number' => null,
                'cargo_content' => $newData->cargo_content,
                'is_returning' => $newData->is_returning,
            ])
            ->call('create')
            ->assertHasFormErrors(['number' => 'required'])
        ;
    }

    public function test_validate_vessel_cargo_content()
    {
        $newData = VesselVoyage::factory()->make();

        Livewire::test(CreateVesselVoyage::class)
            ->fillForm([
                'vessel_id' => $newData->vessel_id,
                'origin_port_id' => $newData->origin_port_id,
                'origin_city_id' => $newData->origin_city_id,
                'destination_city_id' => $newData->destination_city_id,
                'destination_port_id' => $newData->destination_port_id,
                'number' => $newData->number,
                'cargo_content' => null,
                'is_returning' => $newData->is_returning,
            ])
            ->call('create')
            ->assertHasFormErrors(['cargo_content' => 'required'])
        ;
    }
}

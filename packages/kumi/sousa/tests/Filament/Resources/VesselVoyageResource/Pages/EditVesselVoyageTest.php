<?php

namespace Kumi\Sousa\Tests\Filament\Resources\VesselVoyageResource\Pages;

use Kumi\Sousa\Filament\Resources\VesselVoyageResource\Pages\EditVesselVoyage;
use Kumi\Sousa\Models\VesselVoyage;
use Kumi\Sousa\Tests\Cases\AdministratorTestCase;
use Livewire\Livewire;

/**
 * @internal
 */
class EditVesselVoyageTest extends AdministratorTestCase
{
    public function test_render_edit_vessel_voyage_page()
    {
        $voyage = VesselVoyage::factory()->create();

        Livewire::test(EditVesselVoyage::class, [
            'record' => $voyage->getKey(),
        ])
            ->assertSuccessful()
        ;
    }

    public function test_update_vessel_voyage()
    {
        $voyage = VesselVoyage::factory()->create();
        $newData = VesselVoyage::factory()->make();

        Livewire::test(EditVesselVoyage::class, [
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
            ->call('save')
            ->assertHasNoFormErrors()
        ;

        $this->assertDatabaseHas(VesselVoyage::class, [
            'id' => $voyage->getKey(),
            'number' => $newData->number,
            'cargo_content' => $newData->cargo_content,
            'is_returning' => $newData->is_returning,
            'vessel_id' => $newData->vessel_id,
            'origin_port_id' => $newData->origin_port_id,
            'origin_city_id' => $newData->origin_city_id,
            'destination_city_id' => $newData->destination_city_id,
            'destination_port_id' => $newData->destination_port_id,
        ]);
    }

    public function test_validate_vessel_voyage_vessel_id()
    {
        $voyage = VesselVoyage::factory()->create();

        Livewire::test(EditVesselVoyage::class, [
            'record' => $voyage->getKey(),
        ])
            ->fillForm([
                'vessel_id' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['vessel_id' => 'required'])
        ;
    }

    public function test_validate_vessel_voyage_origin_port_id()
    {
        $voyage = VesselVoyage::factory()->create();

        Livewire::test(EditVesselVoyage::class, [
            'record' => $voyage->getKey(),
        ])
            ->fillForm([
                'origin_port_id' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['origin_port_id' => 'required'])
        ;
    }

    public function test_validate_vessel_voyage_origin_city_id()
    {
        $voyage = VesselVoyage::factory()->create();

        Livewire::test(EditVesselVoyage::class, [
            'record' => $voyage->getKey(),
        ])
            ->fillForm([
                'origin_city_id' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['origin_city_id' => 'required'])
        ;
    }

    public function test_validate_vessel_voyage_destination_city_id()
    {
        $voyage = VesselVoyage::factory()->create();

        Livewire::test(EditVesselVoyage::class, [
            'record' => $voyage->getKey(),
        ])
            ->fillForm([
                'destination_city_id' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['destination_city_id' => 'required'])
        ;
    }

    public function test_validate_vessel_voyage_destination_port_id()
    {
        $voyage = VesselVoyage::factory()->create();

        Livewire::test(EditVesselVoyage::class, [
            'record' => $voyage->getKey(),
        ])
            ->fillForm([
                'destination_port_id' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['destination_port_id' => 'required'])
        ;
    }
}

<?php

namespace Kumi\Sousa\Tests\Filament\Resources\VesselVoyageResource\Pages;

use Livewire\Livewire;
use Kumi\Sousa\Models\VesselVoyage;
use Filament\Pages\Actions\DeleteAction;
use Kumi\Sousa\Tests\Cases\AdministratorTestCase;
use Kumi\Sousa\Filament\Resources\VesselVoyageResource\Pages\EditVesselVoyage;

/**
 * @internal
 */
class DeleteVesselVoyageTest extends AdministratorTestCase
{
    public function test_delete_vessel_voyage()
    {
        $voyage = VesselVoyage::factory()->create();

        Livewire::test(EditVesselVoyage::class, [
            'record' => $voyage->getKey(),
        ])
            ->callPageAction(DeleteAction::class)
        ;

        $this->assertModelMissing($voyage);
    }
}

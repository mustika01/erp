<?php

namespace Kumi\Norikumi\Tests\Filament\Resources\CrewResource\RelationManagers;

use Kumi\Norikumi\Filament\Resources\CrewResource\RelationManagers\ContractsRelationManager;
use Kumi\Norikumi\Models\Contract;
use Kumi\Norikumi\Models\Crew;
use Kumi\Norikumi\Tests\Cases\AdministratorTestCase;
use Livewire\Livewire;

/**
 * @internal
 */
class ContractsRelationManagerTest extends AdministratorTestCase
{
    /** @test */
    public function test_render_contracts_relation_manager()
    {
        $crew = Crew::factory()->create();

        Livewire::test(ContractsRelationManager::class, [
            'ownerRecord' => $crew,
        ])->assertOk();
    }

    public function test_can_list_contracts()
    {
        $contract = Contract::factory()->create();

        Livewire::test(ContractsRelationManager::class, [
            'ownerRecord' => $contract->crew,
        ])
            ->assertCanSeeTableRecords([$contract])
        ;
    }
}

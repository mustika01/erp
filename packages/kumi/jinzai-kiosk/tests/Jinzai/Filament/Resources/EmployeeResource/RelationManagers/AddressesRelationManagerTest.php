<?php

namespace Kumi\Jinzai\Tests\Filament\Resources\EmployeeResource\RelationManagers;

use Livewire\Livewire;
use Kumi\Jinzai\Models\Employee;
use Kumi\AbstractJinzaiKiosk\Tests\AdministratorTestCase;
use Kumi\Jinzai\Filament\Resources\EmployeeResource\RelationManagers\AddressesRelationManager;

/**
 * @internal
 */
class AddressesRelationManagerTest extends AdministratorTestCase
{
    /** @test */
    public function it_can_render(): void
    {
        $employee = Employee::factory()->create();

        Livewire::test(AddressesRelationManager::class, [
            'ownerRecord' => $employee,
        ])
            ->assertOk()
        ;
    }
}

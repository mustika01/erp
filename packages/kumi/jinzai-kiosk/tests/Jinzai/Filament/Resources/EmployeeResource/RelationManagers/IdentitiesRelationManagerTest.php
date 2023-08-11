<?php

namespace Kumi\Jinzai\Tests\Filament\Resources\EmployeeResource\RelationManagers;

use Livewire\Livewire;
use Kumi\Jinzai\Models\Employee;
use Kumi\AbstractJinzaiKiosk\Tests\AdministratorTestCase;
use Kumi\Jinzai\Filament\Resources\EmployeeResource\RelationManagers\IdentitiesRelationManager;

/**
 * @internal
 */
class IdentitiesRelationManagerTest extends AdministratorTestCase
{
    /** @test */
    public function it_can_render(): void
    {
        $employee = Employee::factory()->create();

        Livewire::test(IdentitiesRelationManager::class, [
            'ownerRecord' => $employee,
        ])
            ->assertOk()
        ;
    }
}

<?php

namespace Kumi\Jinzai\Tests\Filament\Resources\EmployeeResource\RelationManagers;

use Kumi\AbstractJinzaiKiosk\Tests\AdministratorTestCase;
use Kumi\Jinzai\Filament\Resources\EmployeeResource\RelationManagers\EmploymentsRelationManager;
use Kumi\Jinzai\Models\Employee;
use Kumi\Jinzai\Models\Employment;
use Livewire\Livewire;

/**
 * @internal
 */
class EmploymentsRelationManagerTest extends AdministratorTestCase
{
    public function test_can_render_employment_relation_manager(): void
    {
        $employee = Employee::factory()->create();

        Livewire::test(EmploymentsRelationManager::class, [
            'ownerRecord' => $employee,
        ])->assertOk();
    }

     public function test_can_list_employments()
     {
         $employment = Employment::factory()->create();

         livewire::test(EmploymentsRelationManager::class, [
             'ownerRecord' => $employment->employee,
         ])
             ->assertCanSeeTableRecords([$employment])
         ;
     }
}

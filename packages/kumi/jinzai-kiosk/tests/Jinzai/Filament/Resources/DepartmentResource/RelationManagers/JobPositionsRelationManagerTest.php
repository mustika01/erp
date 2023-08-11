<?php

namespace Kumi\Jinzai\Tests\Filament\Resources\DeparmentResource\RelationManagers;

use Livewire\Livewire;
use Kumi\Jinzai\Models\Department;
use Kumi\AbstractJinzaiKiosk\Tests\AdministratorTestCase;
use Kumi\Jinzai\Filament\Resources\DepartmentResource\RelationManagers\JobPositionsRelationManager;

/**
 * @internal
 */
class JobPositionsRelationManagerTest extends AdministratorTestCase
{
    /** @test */
    public function it_can_render(): void
    {
        $department = Department::factory()->create();

        Livewire::test(JobPositionsRelationManager::class, [
            'ownerRecord' => $department,
        ])
            ->assertOk()
        ;
    }
}

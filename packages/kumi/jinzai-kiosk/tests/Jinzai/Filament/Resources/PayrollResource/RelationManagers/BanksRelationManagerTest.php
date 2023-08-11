<?php

namespace Kumi\Jinzai\Tests\Filament\Resources\PayrollResource\RelationManagers;

use Livewire\Livewire;
use Kumi\Jinzai\Models\Payroll;
use Kumi\AbstractJinzaiKiosk\Tests\AdministratorTestCase;
use Kumi\Jinzai\Filament\Resources\PayrollResource\RelationManagers\BanksRelationManager;

/**
 * @internal
 */
class BanksRelationManagerTest extends AdministratorTestCase
{
    /** @test */
    public function it_can_render(): void
    {
        $payroll = Payroll::factory()->create();

        Livewire::test(BanksRelationManager::class, [
            'ownerRecord' => $payroll,
        ])
            ->assertOk()
        ;
    }
}

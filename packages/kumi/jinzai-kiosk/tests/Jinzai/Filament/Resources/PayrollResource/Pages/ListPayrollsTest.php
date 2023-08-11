<?php

namespace Kumi\Jinzai\Tests\Filament\Resources\DepartmentResource\Pages;

use Livewire\Livewire;
use Illuminate\Http\Response;
use Kumi\Jinzai\Models\Payroll;
use Kumi\AbstractJinzaiKiosk\Tests\AdministratorTestCase;
use Kumi\Jinzai\Filament\Resources\PayrollResource\Pages\ListPayrolls;

/**
 * @internal
 */
class ListPayrollsTest extends AdministratorTestCase
{
    /** @test */
    public function it_can_list_payrolls(): void
    {
        Payroll::factory()->count(3)->create();

        $response = Livewire::test(ListPayrolls::class);
        $response->assertStatus(Response::HTTP_OK);

        $this->assertCount(Payroll::count(), $response->instance()->getTableRecords()->items());
    }

    /** @test */
    public function it_can_bulk_delete_payrolls(): void
    {
        $payrolls = Payroll::factory()->count(3)->create();

        Livewire::test(ListPayrolls::class, [
            'selectedTableRecords' => $payrolls->pluck('id')->toArray(),
        ])->call('bulkDelete');

        $this->assertDatabaseCount(Payroll::class, 0);
    }
}

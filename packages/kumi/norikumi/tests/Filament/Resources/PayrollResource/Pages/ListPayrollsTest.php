<?php

namespace Kumi\Norikumi\Tests\Filament\Resources\PayrollResource\Pages;

use Illuminate\Http\Response;
use Kumi\Norikumi\Filament\Resources\PayrollResource\Pages\ListPayrolls;
use Kumi\Norikumi\Models\Payroll;
use Kumi\Norikumi\Tests\Cases\AdministratorTestCase;
use Livewire\Livewire;

/**
 * @internal
 */
class ListPayrollsTest extends AdministratorTestCase
{
    public function test_render_payrolls()
    {
        Livewire::test(ListPayrolls::class)
            ->assertSuccessful()
        ;
    }

    // /** @test */
    public function test_can_list_payrolls(): void
    {
        Payroll::factory()->count(3)->create();

        $response = Livewire::test(ListPayrolls::class);
        $response->assertStatus(Response::HTTP_OK);

        $this->assertCount(Payroll::count(), $response->instance()->getTableRecords()->items());
    }

    // /** @test */
    public function test_can_bulk_delete_payrolls(): void
    {
        $payrolls = Payroll::factory()->count(3)->create();

        Livewire::test(ListPayrolls::class, [
            'selectedTableRecords' => $payrolls->pluck('id')->toArray(),
        ])->call('bulkDelete');

        $this->assertDatabaseCount(Payroll::class, 0);
    }
}

<?php

namespace Kumi\Norikumi\Tests\Filament\Resources\PayrollResource\Pages;

use Kumi\Norikumi\Filament\Resources\PayrollResource;
use Kumi\Norikumi\Filament\Resources\PayrollResource\Pages\ViewPayroll;
use Kumi\Norikumi\Models\Payroll;
use Kumi\Norikumi\Tests\Cases\AdministratorTestCase;
use Livewire\Livewire;

/**
 * @internal
 */

/**
 * @internal
 */
class ViewPayrollTest extends AdministratorTestCase
{
    /** @test */
    public function it_can_render_view_payroll_page(): void
    {
        $payroll = Payroll::factory()->create();

        $response = $this->get(PayrollResource::getUrl('view', [
            'record' => $payroll,
        ]));

        $response->assertOk();
    }

    /** @test */
    public function it_can_retrieve_payroll_data(): void
    {
        $payroll = Payroll::factory()->create();

        Livewire::test(ViewPayroll::class, [
            'record' => $payroll->getKey(),
        ])
            ->assertSet('data.crew_id', $payroll->crew_id)
            ->assertSet('data.salary', $payroll->salary)
            ->assertSet('data.salary_type', $payroll->salary_type)
            ->assertSet('data.tax_number', $payroll->tax_number)
            ->assertSet('data.non_taxable_income_status', $payroll->non_taxable_income_status)
        ;
    }
}

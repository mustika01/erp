<?php

namespace Kumi\Jinzai\Tests\Filament\Resources\PayrollResource\Pages;

use Livewire\Livewire;
use Kumi\Jinzai\Models\Payroll;
use Kumi\Jinzai\Filament\Resources\PayrollResource;
use Kumi\AbstractJinzaiKiosk\Tests\AdministratorTestCase;
use Kumi\Jinzai\Filament\Resources\PayrollResource\Pages\ViewPayroll;

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
            ->assertSet('data.employee_id', $payroll->employee_id)
            ->assertSet('data.salary', $payroll->salary)
            ->assertSet('data.salary_type', $payroll->salary_type)
            ->assertSet('data.tax_number', $payroll->tax_number)
            ->assertSet('data.non_taxable_income_status', $payroll->non_taxable_income_status)
        ;
    }
}

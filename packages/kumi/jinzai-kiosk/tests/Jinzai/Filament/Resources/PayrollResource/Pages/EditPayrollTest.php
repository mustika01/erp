<?php

namespace Kumi\Jinzai\Tests\Filament\Resources\PayrollResource\Pages;

use Livewire\Livewire;
use Kumi\Jinzai\Models\Payroll;
use Kumi\AbstractJinzaiKiosk\Tests\AdministratorTestCase;
use Kumi\Jinzai\Filament\Resources\PayrollResource;
use Kumi\Jinzai\Filament\Resources\PayrollResource\Pages\EditPayroll;

/**
 * @internal
 */
class EditPayrollTest extends AdministratorTestCase
{
    /** @test */
    public function it_can_render_edit_payroll_form(): void
    {
        $response = $this->get(PayrollResource::getUrl('edit', [
            'record' => Payroll::factory()->create(),
        ]));

        $response->assertOk();
    }

    /** @test */
    public function it_can_retrieve_payroll_data(): void
    {
        $payroll = Payroll::factory()->create();

        Livewire::test(EditPayroll::class, [
            'record' => $payroll->getKey(),
        ])
            ->assertSet('data.employee_id', $payroll->employee_id)
            ->assertSet('data.salary', $payroll->salary)
            ->assertSet('data.salary_type', $payroll->salary_type)
            ->assertSet('data.salary_grade', $payroll->salary_grade)
            ->assertSet('data.tax_number', $payroll->tax_number)
            ->assertSet('data.non_taxable_income_status', $payroll->non_taxable_income_status)
        ;
    }

    /** @test */
    public function it_can_update_payroll_data(): void
    {
        $payroll = Payroll::factory()->create();
        $data = Payroll::factory()->make();

        Livewire::test(EditPayroll::class, [
            'record' => $payroll->getKey(),
        ])
            ->set('data.employee_id', $data->employee_id)
            ->set('data.salary', $data->salary)
            ->set('data.salary_type', $data->salary_type)
            ->set('data.salary_grade', $data->salary_grade)
            ->set('data.tax_number', $data->tax_number)
            ->set('data.non_taxable_income_status', $data->non_taxable_income_status)
            ->call('save')
            ->assertHasNoErrors()
        ;

        tap($payroll->fresh(), function ($payroll) use ($data) {
            $this->assertEquals($data->employee_id, $payroll->employee_id);
            $this->assertEquals($data->salary, $payroll->salary);
            $this->assertEquals($data->salary_type, $payroll->salary_type);
            $this->assertEquals($data->salary_grade, $payroll->salary_grade);
            $this->assertEquals($data->tax_number, $payroll->tax_number);
            $this->assertEquals($data->non_taxable_income_status, $payroll->non_taxable_income_status);
        });
    }

    /** @test */
    public function it_can_validate_payroll_data(): void
    {
        $payroll = Payroll::factory()->create();
        $data = Payroll::factory()->make();

        // required employee attribute
        Livewire::test(EditPayroll::class, [
            'record' => $payroll->getKey(),
        ])
            ->set('data.employee_id', null)
            ->set('data.salary', $data->salary)
            ->set('data.salary_type', $data->salary_type)
            ->set('data.salary_grade', $data->salary_grade)
            ->set('data.tax_number', $data->tax_number)
            ->set('data.non_taxable_income_status', $data->non_taxable_income_status)
            ->call('save')
            ->assertHasErrors(['data.employee_id' => ['required']])
        ;

        // required salary attribute
        Livewire::test(EditPayroll::class, [
            'record' => $payroll->getKey(),
        ])
            ->set('data.employee_id', $data->employee_id)
            ->set('data.salary', null)
            ->set('data.salary_type', $data->salary_type)
            ->set('data.salary_grade', $data->salary_grade)
            ->set('data.tax_number', $data->tax_number)
            ->set('data.non_taxable_income_status', $data->non_taxable_income_status)
            ->call('save')
            ->assertHasErrors(['data.salary' => ['required']])
        ;

        // required salary type attribute
        Livewire::test(EditPayroll::class, [
            'record' => $payroll->getKey(),
        ])
            ->set('data.employee_id', $data->employee_id)
            ->set('data.salary', $data->salary)
            ->set('data.salary_type', null)
            ->set('data.salary_grade', $data->salary_grade)
            ->set('data.tax_number', $data->tax_number)
            ->set('data.non_taxable_income_status', $data->non_taxable_income_status)
            ->call('save')
            ->assertHasErrors(['data.salary_type' => ['required']])
        ;

        // required salary type attribute
        Livewire::test(EditPayroll::class, [
            'record' => $payroll->getKey(),
        ])
            ->set('data.employee_id', $data->employee_id)
            ->set('data.salary', $data->salary)
            ->set('data.salary_type', $data->salary_type)
            ->set('data.salary_grade', null)
            ->set('data.tax_number', $data->tax_number)
            ->set('data.non_taxable_income_status', $data->non_taxable_income_status)
            ->call('save')
            ->assertHasErrors(['data.salary_grade' => ['required']])
        ;

        // required non taxable income status attribute
        Livewire::test(EditPayroll::class, [
            'record' => $payroll->getKey(),
        ])
            ->set('data.employee_id', $data->employee_id)
            ->set('data.salary', $data->salary)
            ->set('data.salary_type', $data->salary_type)
            ->set('data.salary_grade', $data->salary_grade)
            ->set('data.tax_number', $data->tax_number)
            ->set('data.non_taxable_income_status', null)
            ->call('save')
            ->assertHasErrors(['data.non_taxable_income_status' => ['required']])
        ;
    }

    /** @test */
    public function it_can_delete_payroll(): void
    {
        $payroll = Payroll::factory()->create();

        Livewire::test(EditPayroll::class, [
            'record' => $payroll->getKey(),
        ])->call('delete');

        $this->assertDatabaseMissing($payroll, $payroll->toArray());
    }
}

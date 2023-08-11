<?php

namespace Kumi\Jinzai\Tests\Filament\Resources\PayrollResource\Pages;

use Livewire\Livewire;
use Kumi\Jinzai\Models\Payroll;
use Kumi\Jinzai\Filament\Resources\PayrollResource;
use Kumi\AbstractJinzaiKiosk\Tests\AdministratorTestCase;
use Kumi\Jinzai\Filament\Resources\PayrollResource\Pages\CreatePayroll;

/**
 * @internal
 */
class CreatePayrollTest extends AdministratorTestCase
{
    /** @test */
    public function it_can_render_create_payroll_form(): void
    {
        $response = $this->get(PayrollResource::getUrl('create'));

        $response->assertOk();
    }

    /** @test */
    public function it_can_save_payroll_data(): void
    {
        $data = Payroll::factory()->make();

        Livewire::test(CreatePayroll::class)
            ->set('data.employee_id', $data->employee_id)
            ->set('data.salary', $data->salary)
            ->set('data.salary_type', $data->salary_type)
            ->set('data.salary_grade', $data->salary_grade)
            ->set('data.salary_grade', $data->salary_grade)
            ->set('data.tax_number', $data->tax_number)
            ->set('data.non_taxable_income_status', $data->non_taxable_income_status)
            ->call('create')
            ->assertHasNoErrors()
        ;

        $payroll = Payroll::query()->first();

        $this->assertEquals($data->employee_id, $payroll->employee_id);
        $this->assertEquals($data->salary, $payroll->salary);
        $this->assertEquals($data->salary_type, $payroll->salary_type);
        $this->assertEquals($data->tax_number, $payroll->tax_number);
        $this->assertEquals($data->non_taxable_income_status, $payroll->non_taxable_income_status);
    }

    /** @test */
    public function it_can_save_payroll_data_without_tax_number(): void
    {
        $data = Payroll::factory()->make();

        Livewire::test(CreatePayroll::class)
            ->set('data.employee_id', $data->employee_id)
            ->set('data.salary', $data->salary)
            ->set('data.salary_type', $data->salary_type)
            ->set('data.salary_grade', $data->salary_grade)
            ->set('data.tax_number', null)
            ->set('data.non_taxable_income_status', $data->non_taxable_income_status)
            ->call('create')
            ->assertHasNoErrors()
        ;

        $payroll = Payroll::query()->first();

        $this->assertEquals($data->employee_id, $payroll->employee_id);
        $this->assertEquals('00.000.000.0-000.000', $payroll->tax_number);
    }

    /** @test */
    public function it_can_validate_payroll_data(): void
    {
        $data = Payroll::factory()->make();

        // required employee attribute
        Livewire::test(CreatePayroll::class)
            ->set('data.employee_id', null)
            ->set('data.salary', $data->salary)
            ->set('data.salary_type', $data->salary_type)
            ->set('data.salary_grade', $data->salary_grade)
            ->set('data.tax_number', $data->tax_number)
            ->set('data.non_taxable_income_status', $data->non_taxable_income_status)
            ->call('create')
            ->assertHasErrors(['data.employee_id' => ['required']])
        ;

        // required salary attribute
        Livewire::test(CreatePayroll::class)
            ->set('data.employee_id', $data->employee_id)
            ->set('data.salary', null)
            ->set('data.salary_type', $data->salary_type)
            ->set('data.salary_grade', $data->salary_grade)
            ->set('data.tax_number', $data->tax_number)
            ->set('data.non_taxable_income_status', $data->non_taxable_income_status)
            ->call('create')
            ->assertHasErrors(['data.salary' => ['required']])
        ;

        // required salary type attribute
        Livewire::test(CreatePayroll::class)
            ->set('data.employee_id', $data->employee_id)
            ->set('data.salary', $data->salary)
            ->set('data.salary_type', null)
            ->set('data.salary_grade', $data->salary_grade)
            ->set('data.tax_number', $data->tax_number)
            ->set('data.non_taxable_income_status', $data->non_taxable_income_status)
            ->call('create')
            ->assertHasErrors(['data.salary_type' => ['required']])
        ;

        // required salary grade attribute
        Livewire::test(CreatePayroll::class)
            ->set('data.employee_id', $data->employee_id)
            ->set('data.salary', $data->salary)
            ->set('data.salary_type', $data->salary_type)
            ->set('data.salary_grade', null)
            ->set('data.tax_number', $data->tax_number)
            ->set('data.non_taxable_income_status', $data->non_taxable_income_status)
            ->call('create')
            ->assertHasErrors(['data.salary_grade' => ['required']])
        ;

        // required non taxable income status attribute
        Livewire::test(CreatePayroll::class)
            ->set('data.employee_id', $data->employee_id)
            ->set('data.salary', $data->salary)
            ->set('data.salary_type', $data->salary_type)
            ->set('data.salary_grade', $data->salary_grade)
            ->set('data.tax_number', $data->tax_number)
            ->set('data.non_taxable_income_status', null)
            ->call('create')
            ->assertHasErrors(['data.non_taxable_income_status' => ['required']])
        ;
    }
}

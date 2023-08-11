<?php

namespace Kumi\Norikumi\Tests\Filament\Resources\PayrollResource\Pages;

use Kumi\Norikumi\Filament\Resources\PayrollResource;
use Kumi\Norikumi\Filament\Resources\PayrollResource\Pages\EditPayroll;
use Kumi\Norikumi\Models\Payroll;
use Kumi\Norikumi\Tests\Cases\AdministratorTestCase;
use Livewire\Livewire;

/**
 * @internal
 */
class EditPayrollTest extends AdministratorTestCase
{
    public function test_can_render_edit_payroll(): void
    {
        $response = $this->get(PayrollResource::getUrl('edit', [
            'record' => Payroll::factory()->create(),
        ]));

        $response->assertOk();
    }

    public function test_update_payroll()
    {
        $payroll = Payroll::factory()->create();
        $newData = Payroll::factory()->make();

        Livewire::test(EditPayroll::class, [
            'record' => $payroll->getKey(),
        ])
            ->assertFormSet([
                'crew_id' => $payroll->getKey(),
                'salary' => $payroll->salary,
                'salary_type' => $payroll->salary_type,
                'salary_grade' => $payroll->salary_grade,
                'tax_number' => $payroll->tax_number,
                'non_taxable_income_status' => $payroll->non_taxable_income_status,
                'social_security_number' => $payroll->social_security_number,
                'health_care_number' => $payroll->health_care_number,
                'health_care_family_count' => $payroll->health_care_family_count,
                'health_care_covering_entity' => $payroll->health_care_covering_entity,
            ])
            ->fillForm([
                'crew_id' => $payroll->crew_id,
                'salary' => $newData->salary,
                'salary_type' => $newData->salary_type,
                'salary_grade' => $newData->salary_grade,
                'tax_number' => $newData->tax_number,
                'non_taxable_income_status' => $newData->non_taxable_income_status,
                'social_security_number' => $newData->social_security_number,
                'health_care_number' => $newData->health_care_number,
                'health_care_family_count' => $newData->health_care_family_count,
                'health_care_covering_entity' => $newData->health_care_covering_entity,
            ])
            ->call('save')
            ->assertHasNoFormErrors()
        ;

        $this->assertDatabaseHas(Payroll::class, [
            'crew_id' => $payroll->getKey(),
            'salary' => $newData->salary,
            'salary_type' => $newData->salary_type,
            'salary_grade' => $newData->salary_grade,
            'tax_number' => $newData->tax_number,
            'non_taxable_income_status' => $newData->non_taxable_income_status,
            'social_security_number' => $newData->social_security_number,
            'health_care_number' => $newData->health_care_number,
            'health_care_family_count' => $newData->health_care_family_count,
            'health_care_covering_entity' => $newData->health_care_covering_entity,
        ]);
    }

    public function test_validate_payroll_crew_id()
    {
        $payroll = Payroll::factory()->create();

        Livewire::test(EditPayroll::class, [
            'record' => $payroll->getKey(),
        ])
            ->fillForm([
                'crew_id' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['crew_id' => 'required'])
        ;
    }

    public function test_validate_payroll_tax_status()
    {
        $payroll = Payroll::factory()->create();

        Livewire::test(EditPayroll::class, [
            'record' => $payroll->getKey(),
        ])
            ->fillForm([
                'non_taxable_income_status' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['non_taxable_income_status' => 'required'])
        ;
    }

    public function test_validate_payroll_salary()
    {
        $payroll = Payroll::factory()->create();

        Livewire::test(EditPayroll::class, [
            'record' => $payroll->getKey(),
        ])
            ->fillForm([
                'salary' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['salary' => 'required'])
        ;
    }

    public function test_validate_payroll_salary_type()
    {
        $payroll = Payroll::factory()->create();

        Livewire::test(EditPayroll::class, [
            'record' => $payroll->getKey(),
        ])
            ->fillForm([
                'salary_type' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['salary_type' => 'required'])
        ;
    }

    public function test_validate_payroll_salary_grade()
    {
        $payroll = Payroll::factory()->create();

        Livewire::test(EditPayroll::class, [
            'record' => $payroll->getKey(),
        ])
            ->fillForm([
                'salary_grade' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['salary_grade' => 'required'])
        ;
    }
}

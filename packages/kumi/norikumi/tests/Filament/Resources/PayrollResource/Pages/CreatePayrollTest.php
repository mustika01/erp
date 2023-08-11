<?php

namespace Kumi\Norikumi\Tests\Filament\Resources\PayrollResource\Pages;

use Kumi\Norikumi\Filament\Resources\PayrollResource;
use Kumi\Norikumi\Filament\Resources\PayrollResource\Pages\CreatePayroll;
use Kumi\Norikumi\Models\Payroll;
use Kumi\Norikumi\Tests\Cases\AdministratorTestCase;
use Livewire\Livewire;

/**
 * @internal
 */
class CreatePayrollTest extends AdministratorTestCase
{
    public function test_render_create_payroll_form(): void
    {
        $response = $this->get(PayrollResource::getUrl('create'));

        $response->assertOk();
    }

    public function test_create_payroll()
    {
        $newData = Payroll::factory()->make();

        Livewire::test(CreatePayroll::class)
            ->fillForm([
                'crew_id' => $newData->crew_id,
                'salary' => $newData->salary,
                'salary_type' => $newData->salary_type,
                'salary_grade' => $newData->salary_grade,
                'salary_grade' => $newData->salary_grade,
                'tax_number' => $newData->tax_number,
                'non_taxable_income_status' => $newData->non_taxable_income_status,
                'social_security_number' => $newData->social_security_number,
                'health_care_number' => $newData->healt_care_number,
                'health_care_family_count' => $newData->health_care_family_count,
                'health_care_covering_entity' => $newData->health_care_covering_entity,
            ])
            ->call('create')
            ->assertHasNoFormErrors()
        ;

        $this->assertDatabaseHas(Payroll::class, [
            'crew_id' => $newData->crew_id,
            'salary' => $newData->salary,
            'salary_type' => $newData->salary_type,
            'salary_grade' => $newData->salary_grade,
            'salary_grade' => $newData->salary_grade,
            'tax_number' => $newData->tax_number,
            'non_taxable_income_status' => $newData->non_taxable_income_status,
            'social_security_number' => $newData->social_security_number,
            'health_care_number' => $newData->healt_care_number,
            'health_care_family_count' => $newData->health_care_family_count,
            'health_care_covering_entity' => $newData->health_care_covering_entity,
        ]);
    }

    public function test_validate_payroll_crew_id()
    {
        $newData = Payroll::factory()->make();

        Livewire::test(CreatePayroll::class)
            ->fillForm([
                'crew_id' => null,
                'salary' => $newData->salary,
                'salary_type' => $newData->salary_type,
                'salary_grade' => $newData->salary_grade,
                'salary_grade' => $newData->salary_grade,
                'tax_number' => $newData->tax_number,
                'non_taxable_income_status' => $newData->non_taxable_income_status,
                'social_security_number' => $newData->social_security_number,
                'health_care_number' => $newData->healt_care_number,
                'health_care_family_count' => $newData->health_care_family_count,
                'health_care_covering_entity' => $newData->health_care_covering_entity,
            ])
            ->call('create')
            ->assertHasFormErrors(['crew_id' => 'required'])
        ;
    }

    public function test_validate_payroll_tax_status()
    {
        $newData = Payroll::factory()->make();

        Livewire::test(CreatePayroll::class)
            ->fillForm([
                'crew_id' => $newData->crew_id,
                'salary' => $newData->salary,
                'salary_type' => $newData->salary_type,
                'salary_grade' => $newData->salary_grade,
                'salary_grade' => $newData->salary_grade,
                'tax_number' => $newData->tax_number,
                'non_taxable_income_status' => null,
                'social_security_number' => $newData->social_security_number,
                'health_care_number' => $newData->healt_care_number,
                'health_care_family_count' => $newData->health_care_family_count,
                'health_care_covering_entity' => $newData->health_care_covering_entity,
            ])
            ->call('create')
            ->assertHasFormErrors(['non_taxable_income_status' => 'required'])
        ;
    }

    public function test_validate_payroll_salary()
    {
        $newData = Payroll::factory()->make();

        Livewire::test(CreatePayroll::class)
            ->fillForm([
                'crew_id' => $newData->crew_id,
                'salary' => null,
                'salary_type' => $newData->salary_type,
                'salary_grade' => $newData->salary_grade,
                'salary_grade' => $newData->salary_grade,
                'tax_number' => $newData->tax_number,
                'non_taxable_income_status' => $newData->non_taxable_income_status,
                'social_security_number' => $newData->social_security_number,
                'health_care_number' => $newData->healt_care_number,
                'health_care_family_count' => $newData->health_care_family_count,
                'health_care_covering_entity' => $newData->health_care_covering_entity,
            ])
            ->call('create')
            ->assertHasFormErrors(['salary' => 'required'])
        ;
    }

    public function test_validate_payroll_salary_type()
    {
        $newData = Payroll::factory()->make();

        Livewire::test(CreatePayroll::class)
            ->fillForm([
                'crew_id' => $newData->crew_id,
                'salary' => $newData->salary,
                'salary_type' => null,
                'salary_grade' => $newData->salary_grade,
                'salary_grade' => $newData->salary_grade,
                'tax_number' => $newData->tax_number,
                'non_taxable_income_status' => $newData->non_taxable_income_status,
                'social_security_number' => $newData->social_security_number,
                'health_care_number' => $newData->healt_care_number,
                'health_care_family_count' => $newData->health_care_family_count,
                'health_care_covering_entity' => $newData->health_care_covering_entity,
            ])
            ->call('create')
            ->assertHasFormErrors(['salary_type' => 'required'])
        ;
    }

    public function test_validate_payroll_salary_grade()
    {
        $newData = Payroll::factory()->make();

        Livewire::test(CreatePayroll::class)
            ->fillForm([
                'crew_id' => $newData->crew_id,
                'salary' => $newData->salary,
                'salary_type' => $newData->salary_type,
                'salary_grade' => null,
                'salary_grade' => null,
                'tax_number' => $newData->tax_number,
                'non_taxable_income_status' => $newData->non_taxable_income_status,
                'social_security_number' => $newData->social_security_number,
                'health_care_number' => $newData->healt_care_number,
                'health_care_family_count' => $newData->health_care_family_count,
                'health_care_covering_entity' => $newData->health_care_covering_entity,
            ])
            ->call('create')
            ->assertHasFormErrors(['salary_grade' => 'required'])
        ;
    }
}

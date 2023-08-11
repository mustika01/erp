<?php

use Kumi\Jinzai\Support\Enums\SalaryType;
use Kumi\Jinzai\Support\Enums\CoveringEntity;
use Kumi\Jinzai\Support\Enums\NonTaxableIncomeStatus;

return [

    'columns' => [

        'internal_id' => [
            'label' => 'ID',
        ],

        'name' => [
            'label' => 'Name',
        ],

        'tax_number' => [
            'label' => 'Tax No.',
        ],

        'non_taxable_income_status' => [

            'label' => 'Tax Status',

            'options' => [

                NonTaxableIncomeStatus::SINGLE_ZERO_DEPENDANT => 'S/0',
                NonTaxableIncomeStatus::SINGLE_ONE_DEPENDANT => 'S/1',
                NonTaxableIncomeStatus::SINGLE_TWO_DEPENDANTS => 'S/2',
                NonTaxableIncomeStatus::SINGLE_THREE_DEPENDANTS => 'S/3',
                NonTaxableIncomeStatus::MARRIED_ZERO_DEPENDANT => 'M/0',
                NonTaxableIncomeStatus::MARRIED_ONE_DEPENDANT => 'M/1',
                NonTaxableIncomeStatus::MARRIED_TWO_DEPENDANTS => 'M/2',
                NonTaxableIncomeStatus::MARRIED_THREE_DEPENDANTS => 'M/3',

            ],
        ],

        'social_security_number' => [
            'label' => 'Social Security No.',
        ],

        'health_care_number' => [
            'label' => 'Social Security No.',
        ],

        'health_care_family_count' => [
            'label' => 'Family Count',
        ],

        'health_care_covering_entity' => [

            'label' => 'Covering Entity',

            'options' => [

                CoveringEntity::COMPANY => 'Company',
                CoveringEntity::EMPLOYEE => 'Employee',

            ],

        ],

        'salary' => [
            'label' => 'Salary (IDR)',
        ],

        'job_allowance' => [
            'label' => 'Allowance (IDR)',
        ],

        'salary_type' => [

            'label' => 'Salary Type',

            'options' => [

                SalaryType::MONTHLY => 'Monthly',
                SalaryType::WEEKLY => 'Weekly',
                SalaryType::DAILY => 'Daily',

            ],

        ],

        'is_activated' => [
            'label' => 'Activated',
        ],

    ],

    'fields' => [

        'employee' => [
            'label' => 'Employee',
        ],

        'salary' => [
            'label' => 'Salary',
        ],

        'job_allowance' => [
            'label' => 'Job Allowance (IDR)',
        ],

        'salary_type' => [

            'label' => 'Salary Type',

            'options' => [

                SalaryType::MONTHLY => 'Monthly',
                SalaryType::WEEKLY => 'Weekly',
                SalaryType::DAILY => 'Daily',

            ],

        ],

        'salary_grade' => [
            'label' => 'Salary Grade',
        ],

        'tax_number' => [
            'label' => 'Tax No.',
        ],

        'non_taxable_income_status' => [

            'label' => 'Tax Status',

            'options' => [

                NonTaxableIncomeStatus::SINGLE_ZERO_DEPENDANT => 'S/0',
                NonTaxableIncomeStatus::SINGLE_ONE_DEPENDANT => 'S/1',
                NonTaxableIncomeStatus::SINGLE_TWO_DEPENDANTS => 'S/2',
                NonTaxableIncomeStatus::SINGLE_THREE_DEPENDANTS => 'S/3',
                NonTaxableIncomeStatus::MARRIED_ZERO_DEPENDANT => 'M/0',
                NonTaxableIncomeStatus::MARRIED_ONE_DEPENDANT => 'M/1',
                NonTaxableIncomeStatus::MARRIED_TWO_DEPENDANTS => 'M/2',
                NonTaxableIncomeStatus::MARRIED_THREE_DEPENDANTS => 'M/3',

            ],

        ],

        'social_security_number' => [
            'label' => 'Social Security No.',
        ],

        'health_care_number' => [
            'label' => 'Health Care No.',
        ],

        'health_care_family_count' => [
            'label' => 'Family Count',
        ],

        'health_care_covering_entity' => [

            'label' => 'Covering Entity',

            'options' => [

                CoveringEntity::COMPANY => 'Company',
                CoveringEntity::EMPLOYEE => 'Employee',

            ],

        ],

        'activated_at' => [
            'label' => 'Activation Date',
        ],
    ],

    'events' => [

        'created' => 'A new payroll has been created.',
        'updated' => 'The payroll\'s details has been updated.',
        'deleted' => 'The payroll has been deleted.',

    ],

    'actions' => [

        'activate' => [

            'multiple' => [

                'label' => 'Activate selected',

                'modal' => [

                    'heading' => 'Activate selected :label',

                    'actions' => [

                        'activate' => [
                            'label' => 'Activate',
                        ],

                    ],

                ],

                'messages' => [

                    'activated' => 'Activated',

                ],

            ],

            'single' => [

                'label' => 'Activate',

                'modal' => [

                    'heading' => 'Activate :label',

                    'actions' => [

                        'activate' => [
                            'label' => 'Activate',
                        ],

                    ],

                ],

                'messages' => [

                    'activated' => 'Activated',

                ],

            ],

        ],

    ],

    'validation' => [

        'invalid-employment' => 'Invalid employment.',
        'invalid-salary-amount' => 'Invalid salary amount.',
        // 'invalid-allowance-amount' => 'Invalid allowance amount.',

    ],

];

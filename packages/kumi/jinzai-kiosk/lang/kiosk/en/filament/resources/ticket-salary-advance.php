<?php

use Kumi\Kiosk\Support\Enums\LoanPeriod;

return [

    'fields' => [

        'loan_amount' => [
            'label' => 'Loan Amount',
        ],

        'loan_period' => [

            'label' => 'Loan Period',

            'options' => [

                LoanPeriod::THREE_MONTHS => '3 Months',
                LoanPeriod::FOUR_MONTHS => '4 Months',
                LoanPeriod::FIVE_MONTHS => '5 Months',
                LoanPeriod::SIX_MONTHS => '6 Months',

            ],
        ],

        'installment_start_date' => [
            'label' => 'Installment Start Date',
        ],

        'monthly_installment_amount' => [
            'label' => 'Monthly Installment Amount',
        ],

    ],

    'headings' => [

        'employee_information' => [
            'label' => 'Employee Information',
        ],

        'payroll_information' => [
            'label' => 'Payroll Information',
        ],

        'installment_information' => [
            'label' => 'Installment Information',
        ],

        'recommendation' => [
            'label' => 'Recommendation',
        ],

    ],

    'placeholders' => [

        'base_salary' => [
            'label' => 'Base Salary (IDR)',
        ],

        'max_monthly_installment_amount' => [
            'label' => 'Max Monthly Installment Amount (IDR)',
        ],

        'name' => [
            'label' => 'Name',
        ],

        'internal_id' => [
            'label' => 'Employee ID',
        ],

        'nic_no' => [
            'label' => 'NIC No.',
        ],

        'department' => [
            'label' => 'Department',
        ],

        'job_position' => [
            'label' => 'Job Position',
        ],

        'joined_at' => [
            'label' => 'Join Date',
        ],

        'length_of_employment' => [
            'label' => 'Length Of Employment',
        ],

        'loan_amount' => [
            'label' => 'Loan Amount (IDR)',
        ],

        'loan_period' => [
            'label' => 'Loan Period',
        ],

        'monthly_installment_amount' => [
            'label' => 'Monthly Installment Amount (IDR)',
        ],

        'installment_start_date' => [
            'label' => 'Installment Start Date',
        ],

    ],

];

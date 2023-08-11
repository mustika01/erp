<?php

use Kumi\Kiosk\Support\Enums\LoanPeriod;

return [

    'actions' => [

        'review' => [

            'single' => [

                'label' => 'Review',

            ],

        ],

        'reject' => [

            'single' => [

                'label' => 'Reject',

            ],

        ],

        'approve' => [

            'single' => [

                'label' => 'Approve',

            ],

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

        'approval' => [
            'label' => 'Approval',
        ],

        'tickets' => [

            'review' => [
                'label' => 'Review Ticket',
            ],

            'reject' => [
                'label' => 'Reject Ticket',
            ],

            'approve' => [
                'label' => 'Approve Ticket',
            ],

        ],

    ],

    'fields' => [

        'recommended_loan_amount' => [
            'label' => 'Recommended Loan Amount',
        ],

        'recommended_loan_period' => [
            'label' => 'Recommended Loan Period',
        ],

        'recommended_monthly_installment_amount' => [
            'label' => 'Recommended Monthly Installment Amount',
        ],

        'recommended_installment_start_date' => [
            'label' => 'Recommended Installment Start Date',
        ],

        'approved_loan_amount' => [
            'label' => 'Approved Loan Amount',
        ],

        'approved_loan_period' => [
            'label' => 'Approved Loan Period',
        ],

        'approved_monthly_installment_amount' => [
            'label' => 'Approved Monthly Installment Amount',
        ],

        'approved_installment_start_date' => [
            'label' => 'Approved Installment Start Date',
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

            'options' => [

                LoanPeriod::THREE_MONTHS => '3 Months',
                LoanPeriod::FOUR_MONTHS => '4 Months',
                LoanPeriod::FIVE_MONTHS => '5 Months',
                LoanPeriod::SIX_MONTHS => '6 Months',

            ],
        ],

        'monthly_installment_amount' => [
            'label' => 'Monthly Installment Amount (IDR)',
        ],

        'installment_start_date' => [
            'label' => 'Installment Start Date',
        ],

    ],

    'messages' => [
        'updated' => 'The ticket has been updated.',
    ],

];

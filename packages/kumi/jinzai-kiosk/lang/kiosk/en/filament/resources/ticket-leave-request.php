<?php

use Kumi\Kiosk\Support\Enums\LeaveType;

return [

    'fields' => [

        'no_of_days' => [
            'label' => 'No. of Days',
        ],

        'leave_started_at' => [
            'label' => 'Start Date',
        ],

        'leave_ended_at' => [
            'label' => 'End Date',
        ],

        'temporary_address' => [
            'label' => 'Temporary Address',
        ],

        'leave_type' => [
            'label' => 'Type',

            'options' => [

                LeaveType::ANNUAL => 'Annual',
                LeaveType::CHILD_CIRCUMCISION => 'Child Circumcision',
                LeaveType::GRADUATION => 'Graduation',
                LeaveType::PATERNITY => 'Paternity',
                LeaveType::MATERNITY => 'Maternity',
                LeaveType::BEREAVEMENT => 'Bereavement',
                LeaveType::GETTING_MARRIED => 'Getting Married',
                LeaveType::CHILD_GETTING_MARRIED => 'Getting Married (Children)',
                LeaveType::OTHERS => 'Others',

            ],

            'description' => [

                LeaveType::PATERNITY => 'Your spouse is giving birth.',
                LeaveType::MATERNITY => 'You are giving birth.',
                LeaveType::BEREAVEMENT => 'Your loved ones has passed away.',

            ],

            'helper-text' => 'If you select \'Others\', please fill in the reason for your leave in the description.',
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

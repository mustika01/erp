<?php

namespace Kumi\Jinzai\Support;

class DefaultPermissions
{
    public const NAMESPACE = 'jinzai';

    public const OVERVIEW_JINZAI = 'jinzai::overview-jinzai';

    public const VIEW_ANY_EMPLOYEES = 'jinzai::view-any-employees';
    public const DELETE_ANY_EMPLOYEES = 'jinzai::delete-any-employees';
    public const CREATE_EMPLOYEE = 'jinzai::create-employee';
    public const VIEW_EMPLOYEE = 'jinzai::view-employee';
    public const UPDATE_EMPLOYEE = 'jinzai::update-employee';
    public const DELETE_EMPLOYEE = 'jinzai::delete-employee';

    public const VIEW_ANY_EMPLOYEE_ACTIVITIES = 'jinzai::view-any-employee-activities';
    // public const DELETE_ANY_EMPLOYEE_ACTIVITIES = 'jinzai::delete-any-employee-activities';
    // public const CREATE_EMPLOYEE_ACTIVITY = 'jinzai::create-employee-activity';
    public const VIEW_EMPLOYEE_ACTIVITY = 'jinzai::view-employee-activity';
    // public const UPDATE_EMPLOYEE_ACTIVITY = 'jinzai::update-employee-activity';
    // public const DELETE_EMPLOYEE_ACTIVITY = 'jinzai::delete-employee-activity';

    public const VIEW_RECENT_EMPLOYEE_ACTIVITIES = 'jinzai::view-recent-employee-activities';
    public const VIEW_EMPLOYEE_ACTIVITY_DETAILS = 'jinzai::view-employee-activity-details';

    public const CREATE_EMPLOYEE_ONBOARDING_LINK = 'jinzai::create-employee-onboarding-link';
    public const VIEW_EMPLOYEE_ONBOARDING_LINK = 'jinzai::view-employee-onboarding-link';

    public const VIEW_ANY_IDENTITIES = 'jinzai::view-any-identities';
    public const DELETE_ANY_IDENTITIES = 'jinzai::delete-any-identities';
    public const CREATE_IDENTITY = 'jinzai::create-identity';
    public const VIEW_IDENTITY = 'jinzai::view-identity';
    public const UPDATE_IDENTITY = 'jinzai::update-identity';
    public const DELETE_IDENTITY = 'jinzai::delete-identity';

    public const VIEW_ANY_ADDRESSES = 'jinzai::view-any-addresses';
    public const DELETE_ANY_ADDRESSES = 'jinzai::delete-any-addresses';
    public const CREATE_ADDRESS = 'jinzai::create-address';
    public const VIEW_ADDRESS = 'jinzai::view-address';
    public const UPDATE_ADDRESS = 'jinzai::update-address';
    public const DELETE_ADDRESS = 'jinzai::delete-address';

    public const VIEW_ANY_RELATIVES = 'jinzai::view-any-relatives';
    public const DELETE_ANY_RELATIVES = 'jinzai::delete-any-relatives';
    public const CREATE_RELATIVE = 'jinzai::create-relative';
    public const VIEW_RELATIVE = 'jinzai::view-relative';
    public const UPDATE_RELATIVE = 'jinzai::update-relative';
    public const DELETE_RELATIVE = 'jinzai::delete-relative';

    public const VIEW_ANY_DEPARTMENTS = 'jinzai::view-any-departments';
    public const DELETE_ANY_DEPARTMENTS = 'jinzai::delete-any-departments';
    public const CREATE_DEPARTMENT = 'jinzai::create-department';
    public const VIEW_DEPARTMENT = 'jinzai::view-department';
    public const UPDATE_DEPARTMENT = 'jinzai::update-department';
    public const DELETE_DEPARTMENT = 'jinzai::delete-department';

    public const VIEW_ANY_JOB_POSITIONS = 'jinzai::view-any-job-positions';
    public const DELETE_ANY_JOB_POSITIONS = 'jinzai::delete-any-job-positions';
    public const CREATE_JOB_POSITION = 'jinzai::create-job-position';
    public const VIEW_JOB_POSITION = 'jinzai::view-job-position';
    public const UPDATE_JOB_POSITION = 'jinzai::update-job-position';
    public const DELETE_JOB_POSITION = 'jinzai::delete-job-position';

    public const VIEW_JOB_POSITION_LEVEL = 'jinzai::view-job-position-level';
    public const UPDATE_JOB_POSITION_LEVEL = 'jinzai::update-job-position-level';

    public const VIEW_ANY_EMPLOYMENTS = 'jinzai::view-any-employments';
    public const DELETE_ANY_EMPLOYMENTS = 'jinzai::delete-any-employments';
    public const CREATE_EMPLOYMENT = 'jinzai::create-employment';
    public const VIEW_EMPLOYMENT = 'jinzai::view-employment';
    public const UPDATE_EMPLOYMENT = 'jinzai::update-employment';
    public const DELETE_EMPLOYMENT = 'jinzai::delete-employment';

    public const VIEW_ANY_CONTRACTS = 'jinzai::view-any-contracts';
    public const DELETE_ANY_CONTRACTS = 'jinzai::delete-any-contracts';
    public const CREATE_CONTRACT = 'jinzai::create-contract';
    public const VIEW_CONTRACT = 'jinzai::view-contract';
    public const UPDATE_CONTRACT = 'jinzai::update-contract';
    public const DELETE_CONTRACT = 'jinzai::delete-contract';

    public const VIEW_ANY_PAYROLLS = 'jinzai::view-any-payrolls';
    public const DELETE_ANY_PAYROLLS = 'jinzai::delete-any-payrolls';
    public const CREATE_PAYROLL = 'jinzai::create-payroll';
    public const VIEW_PAYROLL = 'jinzai::view-payroll';
    public const UPDATE_PAYROLL = 'jinzai::update-payroll';
    public const DELETE_PAYROLL = 'jinzai::delete-payroll';

    public const MANAGE_PAYROLL_SALARY_DATA = 'jinzai::manage-payroll-salary-data';
    public const ACTIVATE_ANY_PAYROLLS = 'jinzai::activate-any-payrolls';
    public const ACTIVATE_PAYROLL = 'jinzai::activate-payroll';

    public const VIEW_ANY_PAYROLL_ACTIVITIES = 'jinzai::view-any-payroll-activities';
    // public const DELETE_ANY_PAYROLL_ACTIVITIES = 'jinzai::delete-any-payroll-activities';
    // public const CREATE_PAYROLL_ACTIVITY = 'jinzai::create-payroll-activity';
    public const VIEW_PAYROLL_ACTIVITY = 'jinzai::view-payroll-activity';
    // public const UPDATE_PAYROLL_ACTIVITY = 'jinzai::update-payroll-activity';
    // public const DELETE_PAYROLL_ACTIVITY = 'jinzai::delete-payroll-activity';

    public const VIEW_RECENT_PAYROLL_ACTIVITIES = 'jinzai::view-recent-payroll-activities';
    public const VIEW_PAYROLL_ACTIVITY_DETAILS = 'jinzai::view-payroll-activity-details';

    public const VIEW_ANY_BANKS = 'jinzai::view-any-banks';
    public const DELETE_ANY_BANKS = 'jinzai::delete-any-banks';
    public const CREATE_BANK = 'jinzai::create-bank';
    public const VIEW_BANK = 'jinzai::view-bank';
    public const UPDATE_BANK = 'jinzai::update-bank';
    public const DELETE_BANK = 'jinzai::delete-bank';

    public const VIEW_ANY_PAYOUTS = 'jinzai::view-any-payouts';
    public const DELETE_ANY_PAYOUTS = 'jinzai::delete-any-payouts';
    public const CREATE_PAYOUT = 'jinzai::create-payout';
    public const VIEW_PAYOUT = 'jinzai::view-payout';
    public const UPDATE_PAYOUT = 'jinzai::update-payout';
    public const DELETE_PAYOUT = 'jinzai::delete-payout';

    public const APPROVE_ANY_PAYOUTS = 'jinzai::approve-any-payouts';
    public const DISBURSE_ANY_PAYOUTS = 'jinzai::disburse-any-payouts';

    public const VIEW_ANY_PAYOUT_ACTIVITIES = 'jinzai::view-any-payout-activities';
    // public const DELETE_ANY_PAYOUT_ACTIVITIES = 'jinzai::delete-any-payout-activities';
    // public const CREATE_PAYOUT_ACTIVITY = 'jinzai::create-payout-activity';
    public const VIEW_PAYOUT_ACTIVITY = 'jinzai::view-payout-activity';
    // public const UPDATE_PAYOUT_ACTIVITY = 'jinzai::update-payout-activity';
    // public const DELETE_PAYOUT_ACTIVITY = 'jinzai::delete-payout-activity';

    public const VIEW_ANY_PAYOUT_ITEMS = 'jinzai::view-any-payout-items';
    public const DELETE_ANY_PAYOUT_ITEMS = 'jinzai::delete-any-payout-items';
    public const CREATE_PAYOUT_ITEM = 'jinzai::create-payout-item';
    public const VIEW_PAYOUT_ITEM = 'jinzai::view-payout-item';
    public const UPDATE_PAYOUT_ITEM = 'jinzai::update-payout-item';
    public const DELETE_PAYOUT_ITEM = 'jinzai::delete-payout-item';

    // public const VIEW_ANY_LOAN_PAYOUT_ITEMS = 'jinzai::view-any-loan-payout-items';
    // public const DELETE_ANY_LOAN_PAYOUT_ITEMS = 'jinzai::delete-any-loan-payout-items';
    public const CREATE_LOAN_PAYOUT_ITEM = 'jinzai::create-loan-payout-item';
    public const VIEW_LOAN_PAYOUT_ITEM = 'jinzai::view-loan-payout-item';
    public const UPDATE_LOAN_PAYOUT_ITEM = 'jinzai::update-loan-payout-item';
    public const DELETE_LOAN_PAYOUT_ITEM = 'jinzai::delete-loan-payout-item';

    public const VIEW_ANY_LOANS = 'jinzai::view-any-loans';
    public const DELETE_ANY_LOANS = 'jinzai::delete-any-loans';
    public const CREATE_LOAN = 'jinzai::create-loan';
    public const VIEW_LOAN = 'jinzai::view-loan';
    public const UPDATE_LOAN = 'jinzai::update-loan';
    public const DELETE_LOAN = 'jinzai::delete-loan';

    public const APPROVE_LOAN = 'jinzai::approve-loan';

    protected static array $permissions = [
        [
            'name' => self::OVERVIEW_JINZAI,
            'label' => 'Overview JINZAI',
            'description' => 'Overview JINZAI',
            'group' => 'overview',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_EMPLOYEES,
            'label' => 'View Any Employees',
            'description' => 'View Any Employees',
            'group' => 'employee',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_EMPLOYEES,
            'label' => 'Delete Any Employees',
            'description' => 'Delete Any Employees',
            'group' => 'employee',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_EMPLOYEE,
            'label' => 'Create Employee',
            'description' => 'Create Employee',
            'group' => 'employee',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_EMPLOYEE,
            'label' => 'View Employee',
            'description' => 'View Employee',
            'group' => 'employee',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_EMPLOYEE,
            'label' => 'Update Employee',
            'description' => 'Update Employee',
            'group' => 'employee',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_EMPLOYEE,
            'label' => 'Delete Employee',
            'description' => 'Delete Employee',
            'group' => 'employee',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_EMPLOYEE_ACTIVITIES,
            'label' => 'View Any Employee Activities',
            'description' => 'View Any Employee Activities',
            'group' => 'employee',
            'namespace' => self::NAMESPACE,
        ],
        // [
        //     'name' => self::DELETE_ANY_EMPLOYEE_ACTIVITIES,
        //     'label' => 'Delete Any Employee Activities',
        //     'description' => 'Delete Any Employee Activities',
        //     'group' => 'employee',
        //     'namespace' => self::NAMESPACE,
        // ],
        // [
        //     'name' => self::CREATE_EMPLOYEE_ACTIVITY,
        //     'label' => 'Create Employee Activity',
        //     'description' => 'Create Employee Activity',
        //     'group' => 'employee',
        //     'namespace' => self::NAMESPACE,
        // ],
        [
            'name' => self::VIEW_EMPLOYEE_ACTIVITY,
            'label' => 'View Employee Activity',
            'description' => 'View Employee Activity',
            'group' => 'employee',
            'namespace' => self::NAMESPACE,
        ],
        // [
        //     'name' => self::UPDATE_EMPLOYEE_ACTIVITY,
        //     'label' => 'Update Employee Activity',
        //     'description' => 'Update Employee Activity',
        //     'group' => 'employee',
        //     'namespace' => self::NAMESPACE,
        // ],
        // [
        //     'name' => self::DELETE_EMPLOYEE_ACTIVITY,
        //     'label' => 'Delete Employee Activity',
        //     'description' => 'Delete Employee Activity',
        //     'group' => 'employee',
        //     'namespace' => self::NAMESPACE,
        // ],

        [
            'name' => self::VIEW_RECENT_EMPLOYEE_ACTIVITIES,
            'label' => 'View Recent Employee Activities',
            'description' => 'View Recent Employee Activities',
            'group' => 'employee',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_EMPLOYEE_ACTIVITY_DETAILS,
            'label' => 'View Employee Activity Details',
            'description' => 'View Employee Activity Details',
            'group' => 'employee',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::CREATE_EMPLOYEE_ONBOARDING_LINK,
            'label' => 'Create Employee Onboarding Link',
            'description' => 'Create Employee Onboarding Link',
            'group' => 'employee',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_EMPLOYEE_ONBOARDING_LINK,
            'label' => 'View Employee Onboarding Link',
            'description' => 'View Employee Onboarding Link',
            'group' => 'employee',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_IDENTITIES,
            'label' => 'View Any Identities',
            'description' => 'View Any Identities',
            'group' => 'identity',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_IDENTITIES,
            'label' => 'Delete Any Identities',
            'description' => 'Delete Any Identities',
            'group' => 'identity',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_IDENTITY,
            'label' => 'Create Identity',
            'description' => 'Create Identity',
            'group' => 'identity',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_IDENTITY,
            'label' => 'View Identity',
            'description' => 'View Identity',
            'group' => 'identity',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_IDENTITY,
            'label' => 'Update Identity',
            'description' => 'Update Identity',
            'group' => 'identity',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_IDENTITY,
            'label' => 'Delete Identity',
            'description' => 'Delete Identity',
            'group' => 'identity',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_ADDRESSES,
            'label' => 'View Any Addresses',
            'description' => 'View Any Addresses',
            'group' => 'address',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_ADDRESSES,
            'label' => 'Delete Any Addresses',
            'description' => 'Delete Any Addresses',
            'group' => 'address',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_ADDRESS,
            'label' => 'Create Address',
            'description' => 'Create Address',
            'group' => 'address',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_ADDRESS,
            'label' => 'View Address',
            'description' => 'View Address',
            'group' => 'address',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_ADDRESS,
            'label' => 'Update Address',
            'description' => 'Update Address',
            'group' => 'address',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ADDRESS,
            'label' => 'Delete Address',
            'description' => 'Delete Address',
            'group' => 'address',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_RELATIVES,
            'label' => 'View Any Relatives',
            'description' => 'View Any Relatives',
            'group' => 'relative',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_RELATIVES,
            'label' => 'Delete Any Relatives',
            'description' => 'Delete Any Relatives',
            'group' => 'relative',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_RELATIVE,
            'label' => 'Create Relative',
            'description' => 'Create Relative',
            'group' => 'relative',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_RELATIVE,
            'label' => 'View Relative',
            'description' => 'View Relative',
            'group' => 'relative',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_RELATIVE,
            'label' => 'Update Relative',
            'description' => 'Update Relative',
            'group' => 'relative',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_RELATIVE,
            'label' => 'Delete Relative',
            'description' => 'Delete Relative',
            'group' => 'relative',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_DEPARTMENTS,
            'label' => 'View Any Departments',
            'description' => 'View Any Departments',
            'group' => 'department',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_DEPARTMENTS,
            'label' => 'Delete Any Departments',
            'description' => 'Delete Any Departments',
            'group' => 'department',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_DEPARTMENT,
            'label' => 'Create Department',
            'description' => 'Create Department',
            'group' => 'department',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_DEPARTMENT,
            'label' => 'View Department',
            'description' => 'View Department',
            'group' => 'department',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_DEPARTMENT,
            'label' => 'Update Department',
            'description' => 'Update Department',
            'group' => 'department',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_DEPARTMENT,
            'label' => 'Delete Department',
            'description' => 'Delete Department',
            'group' => 'department',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_JOB_POSITIONS,
            'label' => 'View Any Job Positions',
            'description' => 'View Any Job Positions',
            'group' => 'job-position',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_JOB_POSITIONS,
            'label' => 'Delete Any Job Positions',
            'description' => 'Delete Any Job Positions',
            'group' => 'job-position',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_JOB_POSITION,
            'label' => 'Create Job Position',
            'description' => 'Create Job Position',
            'group' => 'job-position',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_JOB_POSITION,
            'label' => 'View Job Position',
            'description' => 'View Job Position',
            'group' => 'job-position',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_JOB_POSITION,
            'label' => 'Update Job Position',
            'description' => 'Update Job Position',
            'group' => 'job-position',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_JOB_POSITION,
            'label' => 'Delete Job Position',
            'description' => 'Delete Job Position',
            'group' => 'job-position',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_JOB_POSITION_LEVEL,
            'label' => 'View Job Position Level',
            'description' => 'View Job Position Level',
            'group' => 'job-position',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_JOB_POSITION_LEVEL,
            'label' => 'Update Job Position Level',
            'description' => 'Update Job Position Level',
            'group' => 'job-position',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_EMPLOYMENTS,
            'label' => 'View Any Employments',
            'description' => 'View Any Employments',
            'group' => 'employment',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_EMPLOYMENTS,
            'label' => 'Delete Any Employments',
            'description' => 'Delete Any Employments',
            'group' => 'employment',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_EMPLOYMENT,
            'label' => 'Create Employment',
            'description' => 'Create Employment',
            'group' => 'employment',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_EMPLOYMENT,
            'label' => 'View Employment',
            'description' => 'View Employment',
            'group' => 'employment',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_EMPLOYMENT,
            'label' => 'Update Employment',
            'description' => 'Update Employment',
            'group' => 'employment',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_EMPLOYMENT,
            'label' => 'Delete Employment',
            'description' => 'Delete Employment',
            'group' => 'employment',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_CONTRACTS,
            'label' => 'View Any Contracts',
            'description' => 'View Any Contracts',
            'group' => 'Contract',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_CONTRACTS,
            'label' => 'Delete Any Contracts',
            'description' => 'Delete Any Contracts',
            'group' => 'Contract',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_CONTRACT,
            'label' => 'Create Contract',
            'description' => 'Create Contract',
            'group' => 'Contract',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_CONTRACT,
            'label' => 'View Contract',
            'description' => 'View Contract',
            'group' => 'Contract',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_CONTRACT,
            'label' => 'Update Contract',
            'description' => 'Update Contract',
            'group' => 'Contract',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_CONTRACT,
            'label' => 'Delete Contract',
            'description' => 'Delete Contract',
            'group' => 'Contract',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_PAYROLLS,
            'label' => 'View Any Payrolls',
            'description' => 'View Any Payrolls',
            'group' => 'payroll',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_PAYROLLS,
            'label' => 'Delete Any Payrolls',
            'description' => 'Delete Any Payrolls',
            'group' => 'payroll',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_PAYROLL,
            'label' => 'Create Payroll',
            'description' => 'Create Payroll',
            'group' => 'payroll',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_PAYROLL,
            'label' => 'View Payroll',
            'description' => 'View Payroll',
            'group' => 'payroll',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_PAYROLL,
            'label' => 'Update Payroll',
            'description' => 'Update Payroll',
            'group' => 'payroll',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_PAYROLL,
            'label' => 'Delete Payroll',
            'description' => 'Delete Payroll',
            'group' => 'payroll',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::MANAGE_PAYROLL_SALARY_DATA,
            'label' => 'Manage Payroll Salary Data',
            'description' => 'Manage Payroll Salary Data',
            'group' => 'payroll',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::ACTIVATE_ANY_PAYROLLS,
            'label' => 'Activate Any Payrolls',
            'description' => 'Activate Any Payrolls',
            'group' => 'payroll',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::ACTIVATE_PAYROLL,
            'label' => 'Activate Payroll',
            'description' => 'Activate Payroll',
            'group' => 'payroll',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_PAYROLL_ACTIVITIES,
            'label' => 'View Any Payroll Activities',
            'description' => 'View Any Payroll Activities',
            'group' => 'payroll-activities',
            'namespace' => self::NAMESPACE,
        ],
        // [
        //     'name' => self::DELETE_ANY_PAYROLL_ACTIVITIES,
        //     'label' => 'Delete Any Payroll Activities',
        //     'description' => 'Delete Any Payroll Activities',
        //     'group' => 'payroll-activities',
        //     'namespace' => self::NAMESPACE,
        // ],
        // [
        //     'name' => self::CREATE_PAYROLL_ACTIVITY,
        //     'label' => 'Create Payroll Activity',
        //     'description' => 'Create Payroll Activity',
        //     'group' => 'payroll-activities',
        //     'namespace' => self::NAMESPACE,
        // ],
        [
            'name' => self::VIEW_PAYROLL_ACTIVITY,
            'label' => 'View Payroll Activity',
            'description' => 'View Payroll Activity',
            'group' => 'payroll-activities',
            'namespace' => self::NAMESPACE,
        ],
        // [
        //     'name' => self::UPDATE_PAYROLL_ACTIVITY,
        //     'label' => 'Update Payroll Activity',
        //     'description' => 'Update Payroll Activity',
        //     'group' => 'payroll-activities',
        //     'namespace' => self::NAMESPACE,
        // ],
        // [
        //     'name' => self::DELETE_PAYROLL_ACTIVITY,
        //     'label' => 'Delete Payroll Activity',
        //     'description' => 'Delete Payroll Activity',
        //     'group' => 'payroll-activities',
        //     'namespace' => self::NAMESPACE,
        // ],

        [
            'name' => self::VIEW_RECENT_PAYROLL_ACTIVITIES,
            'label' => 'View Recent Payroll Activities',
            'description' => 'View Recent Payroll Activities',
            'group' => 'payroll-activities',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_PAYROLL_ACTIVITY_DETAILS,
            'label' => 'View Payroll Activity Details',
            'description' => 'View Payroll Activity Details',
            'group' => 'payroll-activities',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_BANKS,
            'label' => 'View Any Banks',
            'description' => 'View Any Banks',
            'group' => 'bank',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_BANKS,
            'label' => 'Delete Any Banks',
            'description' => 'Delete Any Banks',
            'group' => 'bank',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_BANK,
            'label' => 'Create Bank',
            'description' => 'Create Bank',
            'group' => 'bank',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_BANK,
            'label' => 'View Bank',
            'description' => 'View Bank',
            'group' => 'bank',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_BANK,
            'label' => 'Update Bank',
            'description' => 'Update Bank',
            'group' => 'bank',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_BANK,
            'label' => 'Delete Bank',
            'description' => 'Delete Bank',
            'group' => 'bank',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_PAYOUTS,
            'label' => 'View Any Payouts',
            'description' => 'View Any Payouts',
            'group' => 'payout',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_PAYOUTS,
            'label' => 'Delete Any Payouts',
            'description' => 'Delete Any Payouts',
            'group' => 'payout',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_PAYOUT,
            'label' => 'Create Payout',
            'description' => 'Create Payout',
            'group' => 'payout',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_PAYOUT,
            'label' => 'View Payout',
            'description' => 'View Payout',
            'group' => 'payout',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_PAYOUT,
            'label' => 'Update Payout',
            'description' => 'Update Payout',
            'group' => 'payout',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_PAYOUT,
            'label' => 'Delete Payout',
            'description' => 'Delete Payout',
            'group' => 'payout',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::APPROVE_ANY_PAYOUTS,
            'label' => 'Approve Any Payouts',
            'description' => 'Approve Any Payouts',
            'group' => 'payout',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DISBURSE_ANY_PAYOUTS,
            'label' => 'Disburse Any Payouts',
            'description' => 'Disburse Any Payouts',
            'group' => 'payout',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_PAYOUT_ACTIVITIES,
            'label' => 'View Any Payout Activities',
            'description' => 'View Any Payout Activities',
            'group' => 'payout',
            'namespace' => self::NAMESPACE,
        ],
        // [
        //     'name' => self::DELETE_ANY_PAYOUT_ACTIVITIES,
        //     'label' => 'Delete Any Payout Activities',
        //     'description' => 'Delete Any Payout Activities',
        //     'group' => 'payout',
        //     'namespace' => self::NAMESPACE,
        // ],
        // [
        //     'name' => self::CREATE_PAYOUT_ACTIVITY,
        //     'label' => 'Create Payout Activity',
        //     'description' => 'Create Payout Activity',
        //     'group' => 'payout',
        //     'namespace' => self::NAMESPACE,
        // ],
        [
            'name' => self::VIEW_PAYOUT_ACTIVITY,
            'label' => 'View Payout Activity',
            'description' => 'View Payout Activity',
            'group' => 'payout',
            'namespace' => self::NAMESPACE,
        ],
        // [
        //     'name' => self::UPDATE_PAYOUT_ACTIVITY,
        //     'label' => 'Update Payout Activity',
        //     'description' => 'Update Payout Activity',
        //     'group' => 'payout',
        //     'namespace' => self::NAMESPACE,
        // ],
        // [
        //     'name' => self::DELETE_PAYOUT_ACTIVITY,
        //     'label' => 'Delete Payout Activity',
        //     'description' => 'Delete Payout Activity',
        //     'group' => 'payout',
        //     'namespace' => self::NAMESPACE,
        // ],

        [
            'name' => self::VIEW_ANY_PAYOUT_ITEMS,
            'label' => 'View Any Payout Items',
            'description' => 'View Any Payout Items',
            'group' => 'payout-item',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_PAYOUT_ITEMS,
            'label' => 'Delete Any Payout Items',
            'description' => 'Delete Any Payout Items',
            'group' => 'payout-item',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_PAYOUT_ITEM,
            'label' => 'Create Payout Item',
            'description' => 'Create Payout Item',
            'group' => 'payout-item',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_PAYOUT_ITEM,
            'label' => 'View Payout Item',
            'description' => 'View Payout Item',
            'group' => 'payout-item',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_PAYOUT_ITEM,
            'label' => 'Update Payout Item',
            'description' => 'Update Payout Item',
            'group' => 'payout-item',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_PAYOUT_ITEM,
            'label' => 'Delete Payout Item',
            'description' => 'Delete Payout Item',
            'group' => 'payout-item',
            'namespace' => self::NAMESPACE,
        ],

        // [
        //     'name' => self::VIEW_ANY_LOAN_PAYOUT_ITEMS,
        //     'label' => 'View Any Loan Payout Items',
        //     'description' => 'View Any Loan Payout Items',
        //     'group' => 'payout-item',
        //     'namespace' => self::NAMESPACE,
        // ],
        // [
        //     'name' => self::DELETE_ANY_LOAN_PAYOUT_ITEMS,
        //     'label' => 'Delete Any Loan Payout Items',
        //     'description' => 'Delete Any Loan Payout Items',
        //     'group' => 'payout-item',
        //     'namespace' => self::NAMESPACE,
        // ],
        [
            'name' => self::CREATE_LOAN_PAYOUT_ITEM,
            'label' => 'Create Loan Payout Item',
            'description' => 'Create Loan Payout Item',
            'group' => 'payout-item',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_LOAN_PAYOUT_ITEM,
            'label' => 'View Loan Payout Item',
            'description' => 'View Loan Payout Item',
            'group' => 'payout-item',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_LOAN_PAYOUT_ITEM,
            'label' => 'Update Loan Payout Item',
            'description' => 'Update Loan Payout Item',
            'group' => 'payout-item',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_LOAN_PAYOUT_ITEM,
            'label' => 'Delete Loan Payout Item',
            'description' => 'Delete Loan Payout Item',
            'group' => 'payout-item',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_LOANS,
            'label' => 'View Any Loans',
            'description' => 'View Any Loans',
            'group' => 'loan',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_LOANS,
            'label' => 'Delete Any Loans',
            'description' => 'Delete Any Loans',
            'group' => 'loan',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_LOAN,
            'label' => 'Create Loan',
            'description' => 'Create Loan',
            'group' => 'loan',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_LOAN,
            'label' => 'View Loan',
            'description' => 'View Loan',
            'group' => 'loan',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_LOAN,
            'label' => 'Update Loan',
            'description' => 'Update Loan',
            'group' => 'loan',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_LOAN,
            'label' => 'Delete Loan',
            'description' => 'Delete Loan',
            'group' => 'loan',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::APPROVE_LOAN,
            'label' => 'Approve Loan',
            'description' => 'Approve Loan',
            'group' => 'loan',
            'namespace' => self::NAMESPACE,
        ],
    ];

    public static function getPermissions(): array
    {
        return self::$permissions;
    }
}

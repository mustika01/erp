<?php

namespace Kumi\Norikumi\Support;

class DefaultPermissions
{
    public const NAMESPACE = 'norikumi';

    public const VIEW_ANY_CREWS = 'norikumi::view-any-crews';
    public const DELETE_ANY_CREWS = 'norikumi::delete-any-crews';
    public const CREATE_CREW = 'norikumi::create-crew';
    public const VIEW_CREW = 'norikumi::view-crew';
    public const UPDATE_CREW = 'norikumi::update-crew';
    public const DELETE_CREW = 'norikumi::delete-crew';

    public const VIEW_ANY_CREW_ACTIVITIES = 'norikumi::view-any-crew-activities';
    public const DELETE_ANY_CREW_ACTIVITIES = 'norikumi::delete-any-crew-activities';
    public const CREATE_CREW_ACTIVITY = 'norikumi::create-crew-activity';
    public const VIEW_CREW_ACTIVITY = 'norikumi::view-crew-activity';
    public const UPDATE_CREW_ACTIVITY = 'norikumi::update-crew-activity';
    public const DELETE_CREW_ACTIVITY = 'norikumi::delete-crew-activity';

    public const VIEW_RECENT_CREW_ACTIVITIES = 'norikumi::view-recent-crew-activities';
    public const VIEW_CREW_ACTIVITY_DETAILS = 'norikumi::view-crew-activity-details';

    public const VIEW_ANY_IDENTITIES = 'norikumi::view-any-identities';
    public const DELETE_ANY_IDENTITIES = 'norikumi::delete-any-identities';
    public const CREATE_IDENTITY = 'norikumi::create-identity';
    public const VIEW_IDENTITY = 'norikumi::view-identity';
    public const UPDATE_IDENTITY = 'norikumi::update-identity';
    public const DELETE_IDENTITY = 'norikumi::delete-identity';

    public const VIEW_ANY_DOCUMENTS = 'norikumi::view-any-documents';
    public const DELETE_ANY_DOCUMENTS = 'norikumi::delete-any-documents';
    public const CREATE_DOCUMENT = 'norikumi::create-document';
    public const VIEW_DOCUMENT = 'norikumi::view-document';
    public const UPDATE_DOCUMENT = 'norikumi::update-document';
    public const DELETE_DOCUMENT = 'norikumi::delete-document';

    public const VIEW_ANY_ADDRESSES = 'norikumi::view-any-addresses';
    public const DELETE_ANY_ADDRESSES = 'norikumi::delete-any-addresses';
    public const CREATE_ADDRESS = 'norikumi::create-address';
    public const VIEW_ADDRESS = 'norikumi::view-address';
    public const UPDATE_ADDRESS = 'norikumi::update-address';
    public const DELETE_ADDRESS = 'norikumi::delete-address';

    public const VIEW_ANY_RELATIVES = 'norikumi::view-any-relatives';
    public const DELETE_ANY_RELATIVES = 'norikumi::delete-any-relatives';
    public const CREATE_RELATIVE = 'norikumi::create-relative';
    public const VIEW_RELATIVE = 'norikumi::view-relative';
    public const UPDATE_RELATIVE = 'norikumi::update-relative';
    public const DELETE_RELATIVE = 'norikumi::delete-relative';

    public const VIEW_ANY_ASSIGNMENTS = 'norikumi::view-any-assignments';
    public const DELETE_ANY_ASSIGNMENTS = 'norikumi::delete-any-assignments';
    public const CREATE_ASSIGNMENT = 'norikumi::create-assignment';
    public const VIEW_ASSIGNMENT = 'norikumi::view-assignment';
    public const UPDATE_ASSIGNMENT = 'norikumi::update-assignment';
    public const DELETE_ASSIGNMENT = 'norikumi::delete-assignment';

    public const VIEW_ANY_CONTRACTS = 'norikumi::view-any-contracts';
    public const DELETE_ANY_CONTRACTS = 'norikumi::delete-any-contracts';
    public const CREATE_CONTRACT = 'norikumi::create-contract';
    public const VIEW_CONTRACT = 'norikumi::view-contract';
    public const UPDATE_CONTRACT = 'norikumi::update-contract';
    public const DELETE_CONTRACT = 'norikumi::delete-contract';

    public const VIEW_ANY_PAYROLLS = 'norikumi::view-any-payrolls';
    public const DELETE_ANY_PAYROLLS = 'norikumi::delete-any-payrolls';
    public const CREATE_PAYROLL = 'norikumi::create-payroll';
    public const VIEW_PAYROLL = 'norikumi::view-payroll';
    public const UPDATE_PAYROLL = 'norikumi::update-payroll';
    public const DELETE_PAYROLL = 'norikumi::delete-payroll';

    public const MANAGE_PAYROLL_SALARY_DATA = 'norikumi::manage-payroll-salary-data';
    public const ACTIVATE_ANY_PAYROLLS = 'norikumi::activate-any-payrolls';
    public const ACTIVATE_PAYROLL = 'norikumi::activate-payroll';

    public const VIEW_ANY_PAYROLL_ACTIVITIES = 'norikumi::view-any-payroll-activities';
    public const DELETE_ANY_PAYROLL_ACTIVITIES = 'norikumi::delete-any-payroll-activities';
    public const CREATE_PAYROLL_ACTIVITY = 'norikumi::create-payroll-activity';
    public const VIEW_PAYROLL_ACTIVITY = 'norikumi::view-payroll-activity';
    public const UPDATE_PAYROLL_ACTIVITY = 'norikumi::update-payroll-activity';
    public const DELETE_PAYROLL_ACTIVITY = 'norikumi::delete-payroll-activity';

    public const VIEW_RECENT_PAYROLL_ACTIVITIES = 'norikumi::view-recent-payroll-activities';
    public const VIEW_PAYROLL_ACTIVITY_DETAILS = 'norikumi::view-payroll-activity-details';

    public const VIEW_ANY_REGISTRATION_FORM_ENTRIES = 'norikumi::view-any-registration-form-entries';
    public const DELETE_ANY_REGISTRATION_FORM_ENTRIES = 'norikumi::delete-any-registration-form-entries';
    public const CREATE_REGISTRATION_FORM_ENTRY = 'norikumi::create-registration-form-entry';
    public const VIEW_REGISTRATION_FORM_ENTRY = 'norikumi::view-registration-form-entry';
    public const UPDATE_REGISTRATION_FORM_ENTRY = 'norikumi::update-registration-form-entry';
    public const DELETE_REGISTRATION_FORM_ENTRY = 'norikumi::delete-registration-form-entry';

    public const VIEW_ANY_BANKS = 'norikumi::view-any-banks';
    public const DELETE_ANY_BANKS = 'norikumi::delete-any-banks';
    public const CREATE_BANK = 'norikumi::create-bank';
    public const VIEW_BANK = 'norikumi::view-bank';
    public const UPDATE_BANK = 'norikumi::update-bank';
    public const DELETE_BANK = 'norikumi::delete-bank';

    public const VIEW_ANY_PAYOUTS = 'norikumi::view-any-payouts';
    public const DELETE_ANY_PAYOUTS = 'norikumi::delete-any-payouts';
    public const CREATE_PAYOUT = 'norikumi::create-payout';
    public const VIEW_PAYOUT = 'norikumi::view-payout';
    public const UPDATE_PAYOUT = 'norikumi::update-payout';
    public const DELETE_PAYOUT = 'norikumi::delete-payout';

    public const APPROVE_ANY_PAYOUTS = 'norikumi::approve-any-payouts';
    public const DISBURSE_ANY_PAYOUTS = 'norikumi::disburse-any-payouts';

    public const VIEW_ANY_PAYOUT_ACTIVITIES = 'norikumi::view-any-payout-activities';
    // public const DELETE_ANY_PAYOUT_ACTIVITIES = 'norikumi::delete-any-payout-activities';
    // public const CREATE_PAYOUT_ACTIVITY = 'norikumi::create-payout-activity';
    public const VIEW_PAYOUT_ACTIVITY = 'norikumi::view-payout-activity';
    // public const UPDATE_PAYOUT_ACTIVITY = 'norikumi::update-payout-activity';
    // public const DELETE_PAYOUT_ACTIVITY = 'norikumi::delete-payout-activity';

    public const VIEW_ANY_PAYOUT_ITEMS = 'norikumi::view-any-payout-items';
    public const DELETE_ANY_PAYOUT_ITEMS = 'norikumi::delete-any-payout-items';
    public const CREATE_PAYOUT_ITEM = 'norikumi::create-payout-item';
    public const VIEW_PAYOUT_ITEM = 'norikumi::view-payout-item';
    public const UPDATE_PAYOUT_ITEM = 'norikumi::update-payout-item';
    public const DELETE_PAYOUT_ITEM = 'norikumi::delete-payout-item';

    public const VIEW_ANY_LOAN_PAYOUT_ITEMS = 'norikumi::view-any-loan-payout-items';
    public const DELETE_ANY_LOAN_PAYOUT_ITEMS = 'norikumi::delete-any-loan-payout-items';
    public const CREATE_LOAN_PAYOUT_ITEM = 'norikumi::create-loan-payout-item';
    public const VIEW_LOAN_PAYOUT_ITEM = 'norikumi::view-loan-payout-item';
    public const UPDATE_LOAN_PAYOUT_ITEM = 'norikumi::update-loan-payout-item';
    public const DELETE_LOAN_PAYOUT_ITEM = 'norikumi::delete-loan-payout-item';

    public const VIEW_ANY_DEPOSIT_PAYOUT_ITEMS = 'norikumi::view-any-deposit-payout-items';
    public const DELETE_ANY_DEPOSIT_PAYOUT_ITEMS = 'norikumi::delete-any-deposit-payout-items';
    public const CREATE_DEPOSIT_PAYOUT_ITEM = 'norikumi::create-deposit-payout-item';
    public const VIEW_DEPOSIT_PAYOUT_ITEM = 'norikumi::view-deposit-payout-item';
    public const UPDATE_DEPOSIT_PAYOUT_ITEM = 'norikumi::update-deposit-payout-item';
    public const DELETE_DEPOSIT_PAYOUT_ITEM = 'norikumi::delete-deposit-payout-item';

    public const VIEW_ANY_LOANS = 'norikumi::view-any-loans';
    public const DELETE_ANY_LOANS = 'norikumi::delete-any-loans';
    public const CREATE_LOAN = 'norikumi::create-loan';
    public const VIEW_LOAN = 'norikumi::view-loan';
    public const UPDATE_LOAN = 'norikumi::update-loan';
    public const DELETE_LOAN = 'norikumi::delete-loan';

    public const APPROVE_LOAN = 'norikumi::approve-loan';

    public const VIEW_ANY_DEPOSITS = 'norikumi::view-any-deposits';
    public const DELETE_ANY_DEPOSITS = 'norikumi::delete-any-deposits';
    public const CREATE_DEPOSIT = 'norikumi::create-deposit';
    public const VIEW_DEPOSIT = 'norikumi::view-deposit';
    public const UPDATE_DEPOSIT = 'norikumi::update-deposit';
    public const DELETE_DEPOSIT = 'norikumi::delete-deposit';

    public const APPROVE_DEPOSIT = 'norikumi::approve-deposit';

    protected static array $permissions = [
        [
            'name' => self::VIEW_ANY_CREWS,
            'label' => 'View Any Crews',
            'description' => 'View Any Crews',
            'group' => 'crew',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_CREWS,
            'label' => 'Delete Any Crews',
            'description' => 'Delete Any Crews',
            'group' => 'crew',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_CREW,
            'label' => 'Create Crew',
            'description' => 'Create Crew',
            'group' => 'crew',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_CREW,
            'label' => 'View Crew',
            'description' => 'View Crew',
            'group' => 'crew',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_CREW,
            'label' => 'Update Crew',
            'description' => 'Update Crew',
            'group' => 'crew',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_CREW,
            'label' => 'Delete Crew',
            'description' => 'Delete Crew',
            'group' => 'crew',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_CREW_ACTIVITIES,
            'label' => 'View Any Crew Activities',
            'description' => 'View Any Crew Activities',
            'group' => 'crew',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_CREW_ACTIVITIES,
            'label' => 'Delete Any Crew Activities',
            'description' => 'Delete Any Crew Activities',
            'group' => 'crew',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_CREW_ACTIVITY,
            'label' => 'Create Crew Activity',
            'description' => 'Create Crew Activity',
            'group' => 'crew',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_CREW_ACTIVITY,
            'label' => 'View Crew Activity',
            'description' => 'View Crew Activity',
            'group' => 'crew',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_CREW_ACTIVITY,
            'label' => 'Update Crew Activity',
            'description' => 'Update Crew Activity',
            'group' => 'crew',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_CREW_ACTIVITY,
            'label' => 'Delete Crew Activity',
            'description' => 'Delete Crew Activity',
            'group' => 'crew',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_RECENT_CREW_ACTIVITIES,
            'label' => 'View Recent Crew Activities',
            'description' => 'View Recent Crew Activities',
            'group' => 'crew',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_CREW_ACTIVITY_DETAILS,
            'label' => 'View Crew Activity Details',
            'description' => 'View Crew Activity Details',
            'group' => 'crew',
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
            'name' => self::VIEW_ANY_DOCUMENTS,
            'label' => 'View Any Documents',
            'description' => 'View Any Documents',
            'group' => 'document',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_DOCUMENTS,
            'label' => 'Delete Any Documents',
            'description' => 'Delete Any Documents',
            'group' => 'document',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_DOCUMENT,
            'label' => 'Create Document',
            'description' => 'Create Document',
            'group' => 'document',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_DOCUMENT,
            'label' => 'View Document',
            'description' => 'View Document',
            'group' => 'document',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_DOCUMENT,
            'label' => 'Update Document',
            'description' => 'Update Document',
            'group' => 'document',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_DOCUMENT,
            'label' => 'Delete Document',
            'description' => 'Delete Document',
            'group' => 'document',
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
            'name' => self::VIEW_ANY_ASSIGNMENTS,
            'label' => 'View Any Assignments',
            'description' => 'View Any Assignments',
            'group' => 'assignment',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_ASSIGNMENTS,
            'label' => 'Delete Any Assignments',
            'description' => 'Delete Any Assignments',
            'group' => 'assignment',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_ASSIGNMENT,
            'label' => 'Create Assignment',
            'description' => 'Create Assignment',
            'group' => 'assignment',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_ASSIGNMENT,
            'label' => 'View Assignment',
            'description' => 'View Assignment',
            'group' => 'assignment',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_ASSIGNMENT,
            'label' => 'Update Assignment',
            'description' => 'Update Assignment',
            'group' => 'assignment',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ASSIGNMENT,
            'label' => 'Delete Assignment',
            'description' => 'Delete Assignment',
            'group' => 'assignment',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_CONTRACTS,
            'label' => 'View Any Contracts',
            'description' => 'View Any Contracts',
            'group' => 'contract',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_CONTRACTS,
            'label' => 'Delete Any Contracts',
            'description' => 'Delete Any Contracts',
            'group' => 'contract',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_CONTRACT,
            'label' => 'Create Contract',
            'description' => 'Create Contract',
            'group' => 'contract',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_CONTRACT,
            'label' => 'View Contract',
            'description' => 'View Contract',
            'group' => 'contract',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_CONTRACT,
            'label' => 'Update Contract',
            'description' => 'Update Contract',
            'group' => 'contract',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_CONTRACT,
            'label' => 'Delete Contract',
            'description' => 'Delete Contract',
            'group' => 'contract',
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
            'name' => self::VIEW_ANY_REGISTRATION_FORM_ENTRIES,
            'label' => 'View Any Registration Form Entries',
            'description' => 'View Any Registration Form Entries',
            'group' => 'registration-form-entry',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_REGISTRATION_FORM_ENTRIES,
            'label' => 'Delete Any Registration Form Entries',
            'description' => 'Delete Any Registration Form Entries',
            'group' => 'registration-form-entry',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_REGISTRATION_FORM_ENTRY,
            'label' => 'Create Registration Form Entry',
            'description' => 'Create Registration Form Entry',
            'group' => 'registration-form-entry',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_REGISTRATION_FORM_ENTRY,
            'label' => 'View Registration Form Entry',
            'description' => 'View Registration Form Entry',
            'group' => 'registration-form-entry',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_REGISTRATION_FORM_ENTRY,
            'label' => 'Update Registration Form Entry',
            'description' => 'Update Registration Form Entry',
            'group' => 'registration-form-entry',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_REGISTRATION_FORM_ENTRY,
            'label' => 'Delete Registration Form Entry',
            'description' => 'Delete Registration Form Entry',
            'group' => 'registration-form-entry',
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
            'name' => self::VIEW_ANY_DEPOSIT_PAYOUT_ITEMS,
            'label' => 'View Any Deposit Payout Items',
            'description' => 'View Any Deposit Payout Items',
            'group' => 'payout-item',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_DEPOSIT_PAYOUT_ITEMS,
            'label' => 'Delete Any Deposit Payout Items',
            'description' => 'Delete Any Deposit Payout Items',
            'group' => 'payout-item',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_DEPOSIT_PAYOUT_ITEM,
            'label' => 'Create Deposit Payout Item',
            'description' => 'Create Deposit Payout Item',
            'group' => 'payout-item',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_DEPOSIT_PAYOUT_ITEM,
            'label' => 'View Deposit Payout Item',
            'description' => 'View Deposit Payout Item',
            'group' => 'payout-item',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_DEPOSIT_PAYOUT_ITEM,
            'label' => 'Update Deposit Payout Item',
            'description' => 'Update Deposit Payout Item',
            'group' => 'payout-item',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_DEPOSIT_PAYOUT_ITEM,
            'label' => 'Delete Deposit Payout Item',
            'description' => 'Delete Deposit Payout Item',
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

        [
            'name' => self::VIEW_ANY_DEPOSITS,
            'label' => 'View Any Deposits',
            'description' => 'View Any Deposits',
            'group' => 'deposit',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_DEPOSITS,
            'label' => 'Delete Any Deposits',
            'description' => 'Delete Any Deposits',
            'group' => 'deposit',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_DEPOSIT,
            'label' => 'Create Deposit',
            'description' => 'Create Deposit',
            'group' => 'deposit',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_DEPOSIT,
            'label' => 'View Deposit',
            'description' => 'View Deposit',
            'group' => 'deposit',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_DEPOSIT,
            'label' => 'Update Deposit',
            'description' => 'Update Deposit',
            'group' => 'deposit',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_DEPOSIT,
            'label' => 'Delete Deposit',
            'description' => 'Delete Deposit',
            'group' => 'deposit',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::APPROVE_DEPOSIT,
            'label' => 'Approve Deposit',
            'description' => 'Approve Deposit',
            'group' => 'deposit',
            'namespace' => self::NAMESPACE,
        ],
    ];

    public static function getPermissions(): array
    {
        return self::$permissions;
    }
}

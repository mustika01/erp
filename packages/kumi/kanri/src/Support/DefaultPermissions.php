<?php

namespace Kumi\Kanri\Support;

class DefaultPermissions
{
    public const NAMESPACE = 'kanri';

    public const VIEW_ANY_TICKETS = 'kanri::view-any-tickets';
    public const VIEW_HUMAN_CAPITAL_TICKETS = 'kanri::view-human-capital-tickets';
    public const VIEW_ANY_LEAVE_REQUEST_TICKETS = 'kanri::view-any-leave-request-tickets';
    public const VIEW_DEPARTMENT_LEAVE_REQUEST_TICKETS = 'kanri::view-department-leave-request-tickets';

    public const VIEW_TICKET_ACTIVITY_DETAILS = 'kanri::view-ticket-activity-details';

    public const VIEW_SALARY_ADVANCE_TICKET_PAYROLL_INFORMATION_SECTION = 'kanri::view-salary-advance-ticket-payroll-information-section';

    public const REVIEW_SALARY_ADVANCE_TICKET = 'kanri::review-salary-advance-ticket';
    public const REJECT_SALARY_ADVANCE_TICKET = 'kanri::reject-salary-advance-ticket';
    public const APPROVE_SALARY_ADVANCE_TICKET = 'kanri::approve-salary-advance-ticket';

    public const REVIEW_LEAVE_REQUEST_TICKET = 'kanri::review-leave-request-ticket';
    public const REJECT_ANY_LEAVE_REQUEST_TICKET = 'kanri::reject-any-leave-request-ticket';
    public const APPROVE_ANY_LEAVE_REQUEST_TICKET = 'kanri::approve-any-leave-request-ticket';
    public const REJECT_DEPARTMENT_LEAVE_REQUEST_TICKET = 'kanri::reject-department-leave-request-ticket';
    public const APPROVE_DEPARTMENT_LEAVE_REQUEST_TICKET = 'kanri::approve-department-leave-request-ticket';

    public const VIEW_ANY_REPORTS = 'kanri::view-any-reports';
    public const VIEW_REPORT = 'kanri::view-report';

    public const VIEW_ANY_PAYOUT_REPORTS = 'kanri::view-any-payout-reports';
    public const VIEW_PAYOUT_REPORT = 'kanri::view-payout-report';
    public const VIEW_PAYOUT_REPORT_BREAKDOWN = 'kanri::view-payout-report-breakdown';
    public const CREATE_PAYOUT_REPORT = 'kanri::create-payout-report';

    public const VIEW_ANY_VOYAGE_SUMMARY_REPORTS = 'kanri::view-any-voyage-summary-reports';
    public const VIEW_VOYAGE_SUMMARY_REPORT = 'kanri::view-voyage-summary-report';
    public const CREATE_VOYAGE_SUMMARY_REPORT = 'kanri::create-voyage-summary-report';
    public const DOWNLOAD_VOYAGE_SUMMARY_REPORT = 'kanri::download-voyage-summary-report';

    public const VIEW_ANY_DOCKING_SCHEDULE_REPORTS = 'kanri::view-any-docking-schedule-reports';
    public const VIEW_DOCKING_SCHEDULE_REPORT = 'kanri::view-docking-schedule-report';
    public const CREATE_DOCKING_SCHEDULE_REPORT = 'kanri::create-docking-schedule-report';

    protected static array $permissions = [
        [
            'name' => self::VIEW_ANY_TICKETS,
            'label' => 'View Any Tickets',
            'description' => 'View Any Tickets',
            'group' => 'ticket',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_HUMAN_CAPITAL_TICKETS,
            'label' => 'View HC Tickets',
            'description' => 'View Human Capital Tickets',
            'group' => 'ticket',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_ANY_LEAVE_REQUEST_TICKETS,
            'label' => 'View Any Leave Request Tickets',
            'description' => 'View Any Leave Request Tickets',
            'group' => 'ticket',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_DEPARTMENT_LEAVE_REQUEST_TICKETS,
            'label' => 'View Department Leave Request Tickets',
            'description' => 'View Department Leave Request Tickets',
            'group' => 'ticket',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_TICKET_ACTIVITY_DETAILS,
            'label' => 'View Ticket Activity Details',
            'description' => 'View Ticket Activity Details',
            'group' => 'ticket',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_SALARY_ADVANCE_TICKET_PAYROLL_INFORMATION_SECTION,
            'label' => 'View Salary Advance Ticket Payroll Information Section',
            'description' => 'View Salary Advance Ticket Payroll Information Section',
            'group' => 'ticket',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::REVIEW_SALARY_ADVANCE_TICKET,
            'label' => 'Review Salary Advance Ticket',
            'description' => 'Review Salary Advance Ticket',
            'group' => 'ticket',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::REJECT_SALARY_ADVANCE_TICKET,
            'label' => 'Reject Salary Advance Ticket',
            'description' => 'Reject Salary Advance Ticket',
            'group' => 'ticket',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::APPROVE_SALARY_ADVANCE_TICKET,
            'label' => 'Approve Salary Advance Ticket',
            'description' => 'Approve Salary Advance Ticket',
            'group' => 'ticket',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::REVIEW_LEAVE_REQUEST_TICKET,
            'label' => 'Review Leave Request Ticket',
            'description' => 'Review Leave Request Ticket',
            'group' => 'ticket',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::REJECT_ANY_LEAVE_REQUEST_TICKET,
            'label' => 'Reject Any Leave Request Ticket',
            'description' => 'Reject Any Leave Request Ticket',
            'group' => 'ticket',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::APPROVE_ANY_LEAVE_REQUEST_TICKET,
            'label' => 'Approve Any Leave Request Ticket',
            'description' => 'Approve Any Leave Request Ticket',
            'group' => 'ticket',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::REJECT_DEPARTMENT_LEAVE_REQUEST_TICKET,
            'label' => 'Reject Department Leave Request Ticket',
            'description' => 'Reject Department Leave Request Ticket',
            'group' => 'ticket',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::APPROVE_DEPARTMENT_LEAVE_REQUEST_TICKET,
            'label' => 'Approve Department Leave Request Ticket',
            'description' => 'Approve Department Leave Request Ticket',
            'group' => 'ticket',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_REPORTS,
            'label' => 'View Any Reports',
            'description' => 'View Any Reports',
            'group' => 'report',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_REPORT,
            'label' => 'View Report',
            'description' => 'View Report',
            'group' => 'report',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_PAYOUT_REPORTS,
            'label' => 'View Any Payout Reports',
            'description' => 'View Any Payout Reports',
            'group' => 'report',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_PAYOUT_REPORT,
            'label' => 'View Payout Report',
            'description' => 'View Payout Report',
            'group' => 'report',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_PAYOUT_REPORT_BREAKDOWN,
            'label' => 'View Payout Report Breakdown',
            'description' => 'View Payout Report Breakdown',
            'group' => 'report',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_PAYOUT_REPORT,
            'label' => 'Create Payout Report',
            'description' => 'Create Payout Report',
            'group' => 'report',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_VOYAGE_SUMMARY_REPORTS,
            'label' => 'View Any Voyage Summary',
            'description' => 'View Any Voyage Summary',
            'group' => 'report',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_VOYAGE_SUMMARY_REPORT,
            'label' => 'View Voyage Summary',
            'description' => 'View Voyage Summary',
            'group' => 'report',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_VOYAGE_SUMMARY_REPORT,
            'label' => 'Create Voyage Summary',
            'description' => 'Create Voyage Summary',
            'group' => 'report',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DOWNLOAD_VOYAGE_SUMMARY_REPORT,
            'label' => 'Download Voyage Summary',
            'description' => 'Download Voyage Summary',
            'group' => 'report',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_DOCKING_SCHEDULE_REPORTS,
            'label' => 'View Any Docking Schedule Reports',
            'description' => 'View Any Docking Schedule Reports',
            'group' => 'report',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_DOCKING_SCHEDULE_REPORT,
            'label' => 'View Docking Schedule Report',
            'description' => 'View Docking Schedule Report',
            'group' => 'report',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_DOCKING_SCHEDULE_REPORT,
            'label' => 'Create Docking Schedule Report',
            'description' => 'Create Docking Schedule Report',
            'group' => 'report',
            'namespace' => self::NAMESPACE,
        ],
    ];

    public static function getPermissions(): array
    {
        return self::$permissions;
    }
}

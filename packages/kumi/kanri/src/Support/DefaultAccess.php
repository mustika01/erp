<?php

namespace Kumi\Kanri\Support;

use Kumi\Jinzai\Support\DefaultRoles as JinzaiDefaultRoles;
use Kumi\Keiri\Support\DefaultRoles as KeiriDefaultRoles;
use Kumi\Kyoka\Support\DefaultRoles as BaseDefaultRoles;
use Kumi\Sousa\Support\DefaultRoles as SousaDefaultRoles;
use Kumi\Zaimu\Support\DefaultRoles as ZaimuDefaultRoles;

class DefaultAccess
{
    protected static array $access = [
        BaseDefaultRoles::ADMINISTRATOR => [
            DefaultPermissions::VIEW_ANY_TICKETS,
            // DefaultPermissions::VIEW_HUMAN_CAPITAL_TICKETS,
            // DefaultPermissions::VIEW_LEAVE_REQUEST_TICKETS,
            // DefaultPermissions::VIEW_DEPARTMENT_LEAVE_REQUEST_TICKETS,

            DefaultPermissions::VIEW_TICKET_ACTIVITY_DETAILS,

            DefaultPermissions::VIEW_SALARY_ADVANCE_TICKET_PAYROLL_INFORMATION_SECTION,

            DefaultPermissions::REVIEW_SALARY_ADVANCE_TICKET,
            DefaultPermissions::REJECT_SALARY_ADVANCE_TICKET,
            DefaultPermissions::APPROVE_SALARY_ADVANCE_TICKET,

            DefaultPermissions::REVIEW_LEAVE_REQUEST_TICKET,
            DefaultPermissions::REJECT_ANY_LEAVE_REQUEST_TICKET,
            DefaultPermissions::APPROVE_ANY_LEAVE_REQUEST_TICKET,
            DefaultPermissions::REJECT_DEPARTMENT_LEAVE_REQUEST_TICKET,
            DefaultPermissions::APPROVE_DEPARTMENT_LEAVE_REQUEST_TICKET,

            DefaultPermissions::VIEW_ANY_REPORTS,
            DefaultPermissions::VIEW_REPORT,

            // DefaultPermissions::VIEW_ANY_PAYOUT_REPORTS,
            // DefaultPermissions::VIEW_PAYOUT_REPORT,
            DefaultPermissions::VIEW_PAYOUT_REPORT_BREAKDOWN,
            DefaultPermissions::CREATE_PAYOUT_REPORT,

            DefaultPermissions::VIEW_ANY_VOYAGE_SUMMARY_REPORTS,
            DefaultPermissions::VIEW_VOYAGE_SUMMARY_REPORT,
            DefaultPermissions::CREATE_VOYAGE_SUMMARY_REPORT,
            DefaultPermissions::DOWNLOAD_VOYAGE_SUMMARY_REPORT,

            // DefaultPermissions::VIEW_ANY_DOCKING_SCHEDULE_REPORTS,
            // DefaultPermissions::VIEW_DOCKING_SCHEDULE_REPORT,
            DefaultPermissions::CREATE_DOCKING_SCHEDULE_REPORT,
        ],

        DefaultRoles::MANAGING_DIRECTOR => [
            // DefaultPermissions::VIEW_ANY_TICKETS,
            DefaultPermissions::VIEW_HUMAN_CAPITAL_TICKETS,
            DefaultPermissions::VIEW_ANY_LEAVE_REQUEST_TICKETS,
            // DefaultPermissions::VIEW_DEPARTMENT_LEAVE_REQUEST_TICKETS,

            // DefaultPermissions::VIEW_TICKET_ACTIVITY_DETAILS,

            DefaultPermissions::VIEW_SALARY_ADVANCE_TICKET_PAYROLL_INFORMATION_SECTION,

            // DefaultPermissions::REVIEW_SALARY_ADVANCE_TICKET,
            // DefaultPermissions::REJECT_SALARY_ADVANCE_TICKET,
            // DefaultPermissions::APPROVE_SALARY_ADVANCE_TICKET,

            // DefaultPermissions::REVIEW_LEAVE_REQUEST_TICKET,
            DefaultPermissions::REJECT_ANY_LEAVE_REQUEST_TICKET,
            DefaultPermissions::APPROVE_ANY_LEAVE_REQUEST_TICKET,
            DefaultPermissions::REJECT_DEPARTMENT_LEAVE_REQUEST_TICKET,
            DefaultPermissions::APPROVE_DEPARTMENT_LEAVE_REQUEST_TICKET,

            DefaultPermissions::VIEW_ANY_REPORTS,
            DefaultPermissions::VIEW_REPORT,

            // DefaultPermissions::VIEW_ANY_PAYOUT_REPORTS,
            // DefaultPermissions::VIEW_PAYOUT_REPORT,
            DefaultPermissions::VIEW_PAYOUT_REPORT_BREAKDOWN,
            // DefaultPermissions::CREATE_PAYOUT_REPORT,

            // DefaultPermissions::VIEW_ANY_DOCKING_SCHEDULE_REPORTS,
            // DefaultPermissions::VIEW_DOCKING_SCHEDULE_REPORT,
            // DefaultPermissions::CREATE_DOCKING_SCHEDULE_REPORT,
        ],

        DefaultRoles::VICE_MANAGING_DIRECTOR => [
            // DefaultPermissions::VIEW_ANY_TICKETS,
            DefaultPermissions::VIEW_HUMAN_CAPITAL_TICKETS,
            DefaultPermissions::VIEW_ANY_LEAVE_REQUEST_TICKETS,
            // DefaultPermissions::VIEW_DEPARTMENT_LEAVE_REQUEST_TICKETS,

            // DefaultPermissions::VIEW_TICKET_ACTIVITY_DETAILS,

            DefaultPermissions::VIEW_SALARY_ADVANCE_TICKET_PAYROLL_INFORMATION_SECTION,

            // DefaultPermissions::REVIEW_SALARY_ADVANCE_TICKET,
            DefaultPermissions::REJECT_SALARY_ADVANCE_TICKET,
            DefaultPermissions::APPROVE_SALARY_ADVANCE_TICKET,

            // DefaultPermissions::REVIEW_LEAVE_REQUEST_TICKET,
            DefaultPermissions::REJECT_ANY_LEAVE_REQUEST_TICKET,
            DefaultPermissions::APPROVE_ANY_LEAVE_REQUEST_TICKET,
            DefaultPermissions::REJECT_DEPARTMENT_LEAVE_REQUEST_TICKET,
            DefaultPermissions::APPROVE_DEPARTMENT_LEAVE_REQUEST_TICKET,

            DefaultPermissions::VIEW_ANY_REPORTS,
            DefaultPermissions::VIEW_REPORT,

            // DefaultPermissions::VIEW_ANY_PAYOUT_REPORTS,
            // DefaultPermissions::VIEW_PAYOUT_REPORT,
            DefaultPermissions::VIEW_PAYOUT_REPORT_BREAKDOWN,
            // DefaultPermissions::CREATE_PAYOUT_REPORT,

            // DefaultPermissions::VIEW_ANY_DOCKING_SCHEDULE_REPORTS,
            // DefaultPermissions::VIEW_DOCKING_SCHEDULE_REPORT,
            // DefaultPermissions::CREATE_DOCKING_SCHEDULE_REPORT,
        ],

        JinzaiDefaultRoles::HUMAN_CAPITAL_MANAGER => [
            // DefaultPermissions::VIEW_ANY_TICKETS,
            DefaultPermissions::VIEW_HUMAN_CAPITAL_TICKETS,
            DefaultPermissions::VIEW_ANY_LEAVE_REQUEST_TICKETS,
            // DefaultPermissions::VIEW_DEPARTMENT_LEAVE_REQUEST_TICKETS,

            // DefaultPermissions::VIEW_TICKET_ACTIVITY_DETAILS,

            DefaultPermissions::VIEW_SALARY_ADVANCE_TICKET_PAYROLL_INFORMATION_SECTION,

            DefaultPermissions::REVIEW_SALARY_ADVANCE_TICKET,
            DefaultPermissions::REJECT_SALARY_ADVANCE_TICKET,
            // DefaultPermissions::APPROVE_SALARY_ADVANCE_TICKET,

            DefaultPermissions::REVIEW_LEAVE_REQUEST_TICKET,
            // DefaultPermissions::REJECT_ANY_LEAVE_REQUEST_TICKET,
            // DefaultPermissions::APPROVE_ANY_LEAVE_REQUEST_TICKET,
            DefaultPermissions::REJECT_DEPARTMENT_LEAVE_REQUEST_TICKET,
            DefaultPermissions::APPROVE_DEPARTMENT_LEAVE_REQUEST_TICKET,

            // DefaultPermissions::VIEW_ANY_REPORTS,
            // DefaultPermissions::VIEW_REPORT,

            DefaultPermissions::VIEW_ANY_PAYOUT_REPORTS,
            DefaultPermissions::VIEW_PAYOUT_REPORT,
            DefaultPermissions::VIEW_PAYOUT_REPORT_BREAKDOWN,
            DefaultPermissions::CREATE_PAYOUT_REPORT,

            // DefaultPermissions::VIEW_ANY_DOCKING_SCHEDULE_REPORTS,
            // DefaultPermissions::VIEW_DOCKING_SCHEDULE_REPORT,
            // DefaultPermissions::CREATE_DOCKING_SCHEDULE_REPORT,
        ],

        ZaimuDefaultRoles::FINANCE_MANAGER => [
            // DefaultPermissions::VIEW_ANY_TICKETS,
            DefaultPermissions::VIEW_HUMAN_CAPITAL_TICKETS,
            // DefaultPermissions::VIEW_ANY_LEAVE_REQUEST_TICKETS,
            DefaultPermissions::VIEW_DEPARTMENT_LEAVE_REQUEST_TICKETS,

            // DefaultPermissions::VIEW_TICKET_ACTIVITY_DETAILS,

            // DefaultPermissions::VIEW_SALARY_ADVANCE_TICKET_PAYROLL_INFORMATION_SECTION,

            // DefaultPermissions::REVIEW_SALARY_ADVANCE_TICKET,
            // DefaultPermissions::REJECT_SALARY_ADVANCE_TICKET,
            // DefaultPermissions::APPROVE_SALARY_ADVANCE_TICKET,

            // DefaultPermissions::REVIEW_LEAVE_REQUEST_TICKET,
            // DefaultPermissions::REJECT_ANY_LEAVE_REQUEST_TICKET,
            // DefaultPermissions::APPROVE_ANY_LEAVE_REQUEST_TICKET,
            DefaultPermissions::REJECT_DEPARTMENT_LEAVE_REQUEST_TICKET,
            DefaultPermissions::APPROVE_DEPARTMENT_LEAVE_REQUEST_TICKET,

            // DefaultPermissions::VIEW_ANY_REPORTS,
            // DefaultPermissions::VIEW_REPORT,

            DefaultPermissions::VIEW_ANY_PAYOUT_REPORTS,
            DefaultPermissions::VIEW_PAYOUT_REPORT,
            // DefaultPermissions::VIEW_PAYOUT_REPORT_BREAKDOWN,
            // DefaultPermissions::CREATE_PAYOUT_REPORT,

            // DefaultPermissions::VIEW_ANY_DOCKING_SCHEDULE_REPORTS,
            // DefaultPermissions::VIEW_DOCKING_SCHEDULE_REPORT,
            // DefaultPermissions::CREATE_DOCKING_SCHEDULE_REPORT,
        ],

        KeiriDefaultRoles::ACCOUNTING_MANAGER => [
            // DefaultPermissions::VIEW_ANY_TICKETS,
            // DefaultPermissions::VIEW_HUMAN_CAPITAL_TICKETS,
            // DefaultPermissions::VIEW_ANY_LEAVE_REQUEST_TICKETS,
            DefaultPermissions::VIEW_DEPARTMENT_LEAVE_REQUEST_TICKETS,

            // DefaultPermissions::VIEW_TICKET_ACTIVITY_DETAILS,

            // DefaultPermissions::VIEW_SALARY_ADVANCE_TICKET_PAYROLL_INFORMATION_SECTION,

            // DefaultPermissions::REVIEW_SALARY_ADVANCE_TICKET,
            // DefaultPermissions::REJECT_SALARY_ADVANCE_TICKET,
            // DefaultPermissions::APPROVE_SALARY_ADVANCE_TICKET,

            // DefaultPermissions::REVIEW_LEAVE_REQUEST_TICKET,
            // DefaultPermissions::REJECT_ANY_LEAVE_REQUEST_TICKET,
            // DefaultPermissions::APPROVE_ANY_LEAVE_REQUEST_TICKET,
            DefaultPermissions::REJECT_DEPARTMENT_LEAVE_REQUEST_TICKET,
            DefaultPermissions::APPROVE_DEPARTMENT_LEAVE_REQUEST_TICKET,

            // DefaultPermissions::VIEW_ANY_REPORTS,
            // DefaultPermissions::VIEW_REPORT,

            DefaultPermissions::VIEW_ANY_PAYOUT_REPORTS,
            DefaultPermissions::VIEW_PAYOUT_REPORT,
            // DefaultPermissions::VIEW_PAYOUT_REPORT_BREAKDOWN,
            // DefaultPermissions::CREATE_PAYOUT_REPORT,

            // DefaultPermissions::VIEW_ANY_DOCKING_SCHEDULE_REPORTS,
            // DefaultPermissions::VIEW_DOCKING_SCHEDULE_REPORT,
            // DefaultPermissions::CREATE_DOCKING_SCHEDULE_REPORT,
        ],

        SousaDefaultRoles::OPERATIONAL_MANAGER => [
            // DefaultPermissions::VIEW_ANY_TICKETS,
            // DefaultPermissions::VIEW_HUMAN_CAPITAL_TICKETS,
            // DefaultPermissions::VIEW_ANY_LEAVE_REQUEST_TICKETS,
            DefaultPermissions::VIEW_DEPARTMENT_LEAVE_REQUEST_TICKETS,

            // DefaultPermissions::VIEW_TICKET_ACTIVITY_DETAILS,

            // DefaultPermissions::VIEW_SALARY_ADVANCE_TICKET_PAYROLL_INFORMATION_SECTION,

            // DefaultPermissions::REVIEW_SALARY_ADVANCE_TICKET,
            // DefaultPermissions::REJECT_SALARY_ADVANCE_TICKET,
            // DefaultPermissions::APPROVE_SALARY_ADVANCE_TICKET,

            // DefaultPermissions::REVIEW_LEAVE_REQUEST_TICKET,
            // DefaultPermissions::REJECT_ANY_LEAVE_REQUEST_TICKET,
            // DefaultPermissions::APPROVE_ANY_LEAVE_REQUEST_TICKET,
            DefaultPermissions::REJECT_DEPARTMENT_LEAVE_REQUEST_TICKET,
            DefaultPermissions::APPROVE_DEPARTMENT_LEAVE_REQUEST_TICKET,

            // DefaultPermissions::VIEW_ANY_REPORTS,
            // DefaultPermissions::VIEW_REPORT,

            // DefaultPermissions::VIEW_ANY_PAYOUT_REPORTS,
            // DefaultPermissions::VIEW_PAYOUT_REPORT,
            // DefaultPermissions::VIEW_PAYOUT_REPORT_BREAKDOWN,
            // DefaultPermissions::CREATE_PAYOUT_REPORT,

            DefaultPermissions::VIEW_ANY_DOCKING_SCHEDULE_REPORTS,
            DefaultPermissions::VIEW_DOCKING_SCHEDULE_REPORT,
            DefaultPermissions::CREATE_DOCKING_SCHEDULE_REPORT,

            DefaultPermissions::VIEW_ANY_VOYAGE_SUMMARY_REPORTS,
            DefaultPermissions::VIEW_VOYAGE_SUMMARY_REPORT,
            DefaultPermissions::CREATE_VOYAGE_SUMMARY_REPORT,
            DefaultPermissions::DOWNLOAD_VOYAGE_SUMMARY_REPORT,
        ],
    ];

    public static function getAccess(): array
    {
        return self::$access;
    }
}

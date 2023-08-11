<?php

namespace Kumi\Kanri\EventListeners\Ticket;

use Illuminate\Support\Str;
use Kumi\Jinzai\Models\Loan;
use Illuminate\Support\Carbon;
use Kumi\Kiosk\Support\Enums\LoanPeriod;
use Kumi\Kanri\Events\Ticket\SalaryAdvanceTicketApproved;

class InitializeLoan
{
    public function handle(SalaryAdvanceTicketApproved $event)
    {
        $ticket = $event->ticket;
        $properties = $ticket->properties;
        $payroll = $ticket->employee->payroll;

        $startDate = Carbon::parse($properties['approved_installment_start_date'])->startOfMonth()->startOfDay();
        $loanPeriod = Str::before($properties['approved_loan_period'], LoanPeriod::BEFORE_MONTHS);
        $finalDate = $startDate->copy()->addMonths($loanPeriod)->endOfMonth()->endOfDay();

        $loan = Loan::create([
            'payroll_id' => $payroll->id,
            'started_at' => $startDate,
            'finalized_at' => $finalDate,
            'loan_amount' => $properties['approved_loan_amount'],
            'installment_amount' => $properties['approved_monthly_installment_amount'],
        ]);

        $loan->markAsApproved();
    }
}

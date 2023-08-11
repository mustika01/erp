<?php

namespace Kumi\Jinzai\Actions;

use Kumi\Jinzai\Models\Payroll;
use Lorisleiva\Actions\Concerns\AsAction;

class ValidatePayrollActivationRequest
{
    use AsAction;

    public function handle(Payroll $payroll): array
    {
        $isValid = true;
        $message = 'OK';

        if (is_null($payroll->salary) || $payroll->salary === 0) {
            $isValid = false;
            $message = __('jinzai::filament/resources/payroll.validation.invalid-salary-amount');

            return [$isValid, $message];
        }

        if (! $payroll->employee->hasActiveEmployment()) {
            $isValid = false;
            $message = __('jinzai::filament/resources/payroll.validation.invalid-employment');

            return [$isValid, $message];
        }

        // if (is_null($payroll->job_allowance) || $payroll->job_allowance === 0) {
        //     $isValid = false;
        //     $message = __('jinzai::filament/resources/payroll.validation.invalid-allowance-amount');
        // }

        return [$isValid, $message];
    }
}

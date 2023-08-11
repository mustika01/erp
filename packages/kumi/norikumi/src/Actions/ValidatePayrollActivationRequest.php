<?php

namespace Kumi\Norikumi\Actions;

use Kumi\norikumi\Models\Payroll;
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
            $message = __('norikumi::filament/resources/payroll.validation.invalid-salary-amount');

            return [$isValid, $message];
        }

        if (! $payroll->crew->hasActiveContract()) {
            $isValid = false;
            $message = __('norikumi::filament/resources/payroll.validation.invalid-contract');

            return [$isValid, $message];
        }

        return [$isValid, $message];
    }
}

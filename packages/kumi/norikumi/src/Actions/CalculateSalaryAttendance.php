<?php

namespace Kumi\Norikumi\Actions;

use Kumi\Norikumi\Models\PayoutItem;
use Lorisleiva\Actions\Concerns\AsAction;

class CalculateSalaryAttendance
{
    use AsAction;

    public function handle(array $data): array
    {
        if ($data['type'] == PayoutItem::TYPE_ATTENDANCE) {
            $data['description'] = 'Attendance Allowance (Cash)';
        }

        return $data;
    }
}

<?php

namespace Kumi\Jinzai\Actions;

use Illuminate\Support\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

class CalculateInitialSalaryAdjustment
{
    use AsAction;

    public function handle(Carbon $start, Carbon $end, int $salary): array
    {
        $diffInDays = $start->diffInDays($end);

        if ($end->daysInMonth - $diffInDays === 1) {
            return [0, $salary];
        }

        $nonActiveDays = $end->daysInMonth - ($diffInDays + 1);

        return [$nonActiveDays, round($nonActiveDays / $end->daysInMonth * $salary, -3)];
    }
}

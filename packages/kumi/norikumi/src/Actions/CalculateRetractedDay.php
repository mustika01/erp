<?php

namespace Kumi\Norikumi\Actions;

use Illuminate\Support\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

class CalculateRetractedDay
{
    use AsAction;

    public function handle(Carbon $start)
    {
        // $diffInDays = $start->diffInDays(30);

        // dd($diffInDays);

        // if ($end->daysInMonth(30) - $diffInDays === 1) {
        //     return [0, $salary];
        // }

        // $nonActiveDays = $end->daysInMonth - ($diffInDays + 1);

        // return [$nonActiveDays, round($nonActiveDays / $end->daysInMonth * $salary, -3)];
    }
}

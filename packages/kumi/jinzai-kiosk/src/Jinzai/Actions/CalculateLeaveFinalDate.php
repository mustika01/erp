<?php

namespace Kumi\Jinzai\Actions;

use Closure;
use Carbon\CarbonPeriod;
use Illuminate\Support\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

class CalculateLeaveFinalDate
{
    use AsAction;

    public function handle(Closure $get, Closure $set)
    {
        $startDate = $get('properties.leave_started_at');
        $numberOfDays = $get('properties.no_of_days');

        if (empty($startDate) || empty($numberOfDays)) {
            return;
        }

        $startDate = Carbon::parse($startDate)->startOfDay();
        $endDate = $startDate->copy()->addDays($numberOfDays)->subDay()->endOfDay();
        $period = CarbonPeriod::create($startDate, $endDate);

        foreach ($period as $day) {
            if ($day->isWeekend()) {
                $endDate->addDay();
            }
        }

        if ($endDate->isSunday()) {
            $endDate->addDay();
        }

        $set('properties.leave_ended_at', $endDate->toDateString());
    }
}

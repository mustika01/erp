<?php

namespace Kumi\Kanri\Actions;

use Closure;
use Carbon\CarbonPeriod;
use Illuminate\Support\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

class CalculateLeaveFinalDate
{
    use AsAction;

    public function handle(Closure $get, Closure $set, string $startDateField, string $daysField, string $endDateField)
    {
        $startDate = $get($startDateField);
        $numberOfDays = $get($daysField);

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

        $set($endDateField, $endDate->format('d F Y'));
    }
}

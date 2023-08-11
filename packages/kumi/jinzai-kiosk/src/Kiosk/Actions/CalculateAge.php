<?php

namespace Kumi\Kiosk\Actions;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

class CalculateAge
{
    use AsAction;

    public function handle(Carbon $carbon, ?Carbon $time = null)
    {
        $interval = $carbon->diff($time ?? Carbon::now());
        $years = $interval->y . ' ' . Str::plural('year', $interval->y);
        $months = $interval->m . ' ' . Str::plural('month', $interval->m);

        if ($interval->y > 0 && $interval->m > 0) {
            return Str::headline($years . ' ' . $months);
        }

        if ($interval->y > 0 && $interval->m === 0) {
            return Str::headline($years);
        }

        return Str::headline($months);
    }
}

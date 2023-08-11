<?php

namespace Kumi\Jinzai\Filament\Widgets;

use Kumi\Jinzai\Models\Employee;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Kumi\Jinzai\Support\Enums\Gender;
use Kumi\Jinzai\Support\DatabaseCacheKeys;
use Kumi\Jinzai\Widgets\PieStatsWidget\Slice;
use Kumi\Jinzai\Widgets\SimplePieStatsWidget;

class GenderDiversityWidget extends SimplePieStatsWidget
{
    protected $cacheTTLinSeconds = 1;

    public function getSlicesBackground(): string
    {
        $count = 0;
        $currentDegree = 0;
        $total = $this->getTotal();

        return Collection::make($this->getCachedSlices())
            ->map(function (Slice $slice) use (&$count, &$currentDegree, $total) {
                $slice = $slice->total($total);
                $percentage = $slice->getPercentage();
                $sliceDegree = ceil($percentage / 100 * 360);

                if ($count === 0) {
                    $startDegree = '0';
                    $endDegree = $sliceDegree;
                } elseif ($count === $total) {
                    $startDegree = $currentDegree;
                    $endDegree = '360';
                } else {
                    $startDegree = $currentDegree;
                    $endDegree = $currentDegree + $sliceDegree;
                }

                $count++;
                $currentDegree += $sliceDegree;

                return "{$slice->getColor()} {$startDegree}deg {$endDegree}deg";
            })
            ->implode(',')
        ;
    }

    protected function getHeading(): ?string
    {
        return __('jinzai::filament/widgets/gender-diversity.title');
    }

    protected function getSlices(): array
    {
        return Cache::remember(DatabaseCacheKeys::WIDGET_GENDER_DIVERSITY, $this->cacheTTLinSeconds, function () {
            $colors = [
                Gender::MALE => 'blue',
                Gender::FEMALE => 'red',
            ];

            return Employee::query()
                ->selectRaw('gender, COUNT(*)')
                ->groupBy('gender')->get()
                ->map(function (Employee $employee) use ($colors) {
                    return Slice::make(__('jinzai::filament/widgets/gender-diversity.options.' . $employee->gender), $employee->count)
                        ->color($colors[$employee->gender])
                    ;
                })->toArray();
        });
    }
}

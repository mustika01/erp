<?php

namespace Kumi\Jinzai\Filament\Widgets;

use Kumi\Jinzai\Models\Employment;
use Illuminate\Support\Facades\Cache;
use Kumi\Jinzai\Support\DatabaseCacheKeys;
use Kumi\Jinzai\Widgets\StackedBarStatsWidget;
use Kumi\Jinzai\Support\Enums\EmploymentStatus;
use Kumi\Jinzai\Widgets\StackedBarStatsWidget\LineItem;

class EmploymentStatusWidget extends StackedBarStatsWidget
{
    protected $cacheTTLinSeconds = 3600;

    protected function getHeading(): ?string
    {
        return __('jinzai::filament/widgets/employment-status.title');
    }

    protected function getLineItems(): array
    {
        return Cache::remember(DatabaseCacheKeys::WIDGET_EMPLOYMENT_STATUS, $this->cacheTTLinSeconds, function () {
            $colors = [
                EmploymentStatus::PERMANENT => 'red',
                EmploymentStatus::CONTRACT => 'green',
                EmploymentStatus::PROBATION => 'blue',
            ];

            return Employment::query()
                ->selectRaw('status, COUNT(*)')
                ->groupBy('status')->get()
                ->map(function (Employment $employment) use ($colors) {
                    return LineItem::make(__('jinzai::filament/widgets/employment-status.options.' . $employment->status), $employment->count)
                        ->color($colors[$employment->status])
                    ;
                })->toArray();
        });
    }
}

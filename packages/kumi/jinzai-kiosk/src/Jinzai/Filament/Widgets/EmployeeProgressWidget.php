<?php

namespace Kumi\Jinzai\Filament\Widgets;

use Kumi\Jinzai\Models\Employee;
use Illuminate\Support\Facades\Cache;
use Kumi\Jinzai\Support\DatabaseCacheKeys;
use Kumi\Jinzai\Widgets\ProgressBarStatsWidget;
use Kumi\Jinzai\Widgets\ProgressBarStatsWidget\LineItem;

class EmployeeProgressWidget extends ProgressBarStatsWidget
{
    protected $cacheTTLinSeconds = 3600;

    public function getTotal(): string
    {
        return Employee::count();
    }

    protected function getHeading(): ?string
    {
        return __('jinzai::filament/widgets/employee-progress.title');
    }

    protected function getLineItems(): array
    {
        return Cache::remember(DatabaseCacheKeys::WIDGET_EMPLOYEE_PROGRESS, $this->cacheTTLinSeconds, function () {
            $onboarding = Employee::query()->completedOnboarding()->count();
            $employeeID = Employee::query()->activeEmployment()->count();
            $payroll = Employee::query()->withPayroll()->count();

            return [
                LineItem::make(__('jinzai::filament/widgets/employee-progress.options.onboarding'), $onboarding)
                    ->color('red'),
                LineItem::make(__('jinzai::filament/widgets/employee-progress.options.employee_id'), $employeeID)
                    ->color('green'),
                LineItem::make(__('jinzai::filament/widgets/employee-progress.options.payroll'), $payroll)
                    ->color('blue'),
            ];
        });
    }
}

<?php

namespace Kumi\Jinzai\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Collection;
use Kumi\Jinzai\Filament\Resources\PayrollResource;
use Kumi\Jinzai\Filament\Resources\EmployeeResource;
use Kumi\Jinzai\Filament\Resources\DepartmentResource;

class QuickLinksWidget extends Widget
{
    protected int|string|array $columnSpan = 'full';

    protected static string $view = 'jinzai::filament.widgets.quick-links-widget';

    public function getLinks()
    {
        return Collection::make([
            [
                'label' => __('jinzai::filament/widgets/quick-links.links.new_employee.label'),
                'url' => EmployeeResource::getUrl('create'),
            ],
            [
                'label' => __('jinzai::filament/widgets/quick-links.links.new_payroll.label'),
                'url' => PayrollResource::getUrl('create'),
            ],
            [
                'label' => __('jinzai::filament/widgets/quick-links.links.new_department.label'),
                'url' => DepartmentResource::getUrl('create'),
            ],
        ]);
    }

    protected function getHeading(): ?string
    {
        return __('jinzai::filament/widgets/quick-links.title');
    }
}

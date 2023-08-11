<?php

namespace Kumi\Jinzai\Filament\Resources\PayoutResource\Pages;

use Filament\Resources\Pages\ViewRecord;
use Kumi\Jinzai\Filament\Resources\PayoutResource;
use Kumi\Jinzai\Filament\Resources\PayoutResource\Widgets\PayoutAmountWidget;

class ViewPayout extends ViewRecord
{
    protected static string $resource = PayoutResource::class;

    protected function getFooterWidgets(): array
    {
        return [
            PayoutAmountWidget::class,
        ];
    }
}

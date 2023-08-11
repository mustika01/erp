<?php

namespace Kumi\Kiosk\Filament\Resources\PersonalPayoutResource\Pages;

use Filament\Resources\Pages\ViewRecord;
use Kumi\Kiosk\Filament\Resources\PersonalPayoutResource;
use Kumi\Kiosk\Filament\Resources\PersonalPayoutResource\Widgets\PayoutAmountWidget;

class ViewPayout extends ViewRecord
{
    protected static string $resource = PersonalPayoutResource::class;

    protected function getFooterWidgets(): array
    {
        return [
            PayoutAmountWidget::class,
        ];
    }
}

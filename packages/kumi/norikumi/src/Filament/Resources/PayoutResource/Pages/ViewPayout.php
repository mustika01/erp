<?php

namespace Kumi\Norikumi\Filament\Resources\PayoutResource\Pages;

use Filament\Resources\Pages\ViewRecord;
use Kumi\Norikumi\Filament\Resources\PayoutResource;
use Kumi\Norikumi\Filament\Resources\PayoutResource\Widgets\PayoutAmountWidget;

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

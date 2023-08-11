<?php

namespace Kumi\Kiosk\Filament\Resources\PersonalPayoutResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Kumi\Kiosk\Filament\Resources\PersonalPayoutResource;

class ListPayouts extends ListRecords
{
    protected static string $resource = PersonalPayoutResource::class;

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}

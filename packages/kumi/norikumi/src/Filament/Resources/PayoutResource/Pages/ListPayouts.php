<?php

namespace Kumi\Norikumi\Filament\Resources\PayoutResource\Pages;

use Carbon\Carbon;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Kumi\Norikumi\Filament\Resources\PayoutResource;
use Kumi\Norikumi\Filament\Resources\PayoutResource\Widgets\PayoutOverviewWidget;

class ListPayouts extends ListRecords
{
    protected static string $resource = PayoutResource::class;

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }

    protected function getHeaderWidgets(): array
    {
        return [
            PayoutOverviewWidget::class,
        ];
    }

    protected function getTableQuery(): Builder
    {
        $this->emit('filterPeriod', [
            'year' => $this->tableFilters['period']['year'] ?? Carbon::now()->format('Y'),
            'month' => $this->tableFilters['period']['month'] ?? Carbon::now()->format('F'),
        ]);

        return parent::getTableQuery();
    }
}

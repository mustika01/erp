<?php

namespace Kumi\Sousa\Filament\Pages;

use Filament\Pages;
use Filament\Pages\Page;
use Kumi\Sousa\Filament\Resources\BunkerResource;
use Kumi\Sousa\Filament\Resources\OilJournalResource;
use Kumi\Sousa\Filament\Resources\OilJournalResource\Pages\Widgets\OilJournalsROBChartWidget;
use Kumi\Sousa\Filament\Resources\OilJournalResource\Pages\Widgets\OilJournalsUsageChartWidget;
use Kumi\Sousa\Models\Bunker;

class OilJournals extends Page
{
    public ?Bunker $bunker = null;

    protected static string $view = 'sousa::filament.pages.oil-journals';

    protected static ?string $slug = 'sousa/bunkers/{bunker}/oil-journals';

    protected static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OilJournalsROBChartWidget::class,
            OilJournalsUsageChartWidget::class,
        ];
    }

    protected function getHeading(): string
    {
        return "{$this->bunker->vessel->name} - Oil Journals";
    }

    protected function getActions(): array
    {
        return [
            Pages\Actions\Action::make('create')
                ->label(__('New Journal'))
                ->url(OilJournalResource::getUrl('create', ['bunker_id' => $this->bunker]))
                ->authorize(function () {
                    return OilJournalResource::canCreate();
                }),
        ];
    }

    protected function getBreadcrumbs(): array
    {
        $breadcrumbs[
            BunkerResource::getUrl('index')
        ] = 'Bunkers';

        $breadcrumbs[
            self::getUrl(['bunker' => $this->bunker])
        ] = 'Oil';

        return $breadcrumbs;
    }
}

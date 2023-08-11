<?php

namespace Kumi\Sousa\Filament\Resources\VesselVoyageResource\Pages;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use Filament\Resources\Pages\ViewRecord;
use Kumi\Sousa\Filament\Pages\VesselVoyages;
use Kumi\Sousa\Filament\Pages\VesselsToVoyagesList;
use Kumi\Sousa\Filament\Resources\VesselVoyageResource;
use Kumi\Sousa\Filament\Resources\VesselVoyageResource\Pages\Widgets\VoyageStatsWidget;
use Kumi\Sousa\Filament\Resources\VesselVoyageResource\Pages\Widgets\SingleVoyageCalendarWidget;
use Kumi\Sousa\Filament\Resources\VesselVoyageResource\Pages\Widgets\SingleVoyageBunkerJournalsWidget;

class ViewVesselVoyage extends ViewRecord
{
    protected static string $resource = VesselVoyageResource::class;

    public function mount($record): void
    {
        parent::mount($record);

        Session::put('current_voyage_id', $record);
    }

    protected function getFooterWidgets(): array
    {
        return [
            VoyageStatsWidget::class,
            SingleVoyageBunkerJournalsWidget::class,
            SingleVoyageCalendarWidget::class,
        ];
    }

    protected function getBreadcrumbs(): array
    {
        $breadcrumbs[
            VesselsToVoyagesList::getUrl()
        ] = 'Vessels';

        $breadcrumbs[
            VesselVoyages::getUrl(['vessel' => $this->record->vessel])
        ] = 'Voyages';

        $breadcrumbs[
            URL::current() . '#'
        ] = 'View';

        return $breadcrumbs;
    }

    protected function getFooterWidgetsColumns(): int|array
    {
        return 3;
    }
}

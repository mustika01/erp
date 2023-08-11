<?php

namespace Kumi\Sousa\Filament\Resources\VesselResource\Pages;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\ViewRecord;
use Kumi\Sousa\Support\DefaultPermissions;
use Kumi\Sousa\Filament\Resources\VesselResource;
use Kumi\Sousa\Filament\Resources\VesselResource\Pages\Actions\PreviewShipParticularsAction;
use Kumi\Sousa\Filament\Resources\VesselResource\Pages\Actions\DownloadShipParticularsAction;

class ViewVessel extends ViewRecord
{
    protected static string $resource = VesselResource::class;

    public function hasCombinedRelationManagerTabsWithForm(): bool
    {
        return true;
    }

    protected function getActions(): array
    {
        $actions = Collection::make([
            DefaultPermissions::PREVIEW_VESSEL_SHIP_PARTICULARS => $this->getPreviewShipParticularsAction(),
            DefaultPermissions::DOWNLOAD_VESSEL_SHIP_PARTICULARS => $this->getDownloadShipParticularsAction(),
        ])->filter(function ($action, $permission) {
            return Auth::user()->can($permission);
        })->toArray();

        return array_merge($actions, parent::getActions());
    }

    protected function getPreviewShipParticularsAction()
    {
        return PreviewShipParticularsAction::make()
            ->url(route('sousa.ship-particulars.preview', [$this->record]))
            ->openUrlInNewTab()
        ;
    }

    protected function getDownloadShipParticularsAction()
    {
        return DownloadShipParticularsAction::make()
            ->url(route('sousa.ship-particulars.download', [$this->record]))
            ->openUrlInNewTab()
        ;
    }
}

<?php

namespace Kumi\Sousa\Filament\Resources\VesselVoyageResource\Pages;

use Filament\Pages\Actions;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\URL;
use Kumi\Sousa\Filament\Pages\VesselsToVoyagesList;
use Kumi\Sousa\Filament\Pages\VesselVoyages;
use Kumi\Sousa\Filament\Resources\VesselVoyageResource;

class EditVesselVoyage extends EditRecord
{
    protected static string $resource = VesselVoyageResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getCancelFormAction(): Action
    {
        $vessel = $this->record->vessel;

        return Action::make('cancel')
            ->label(__('filament::resources/pages/edit-record.form.actions.cancel.label'))
            ->url(VesselVoyages::getUrl(['vessel' => $vessel]))
            ->color('secondary')
        ;
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
        ] = 'Edit';

        return $breadcrumbs;
    }
}

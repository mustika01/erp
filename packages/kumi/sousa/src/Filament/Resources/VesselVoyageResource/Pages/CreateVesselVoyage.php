<?php

namespace Kumi\Sousa\Filament\Resources\VesselVoyageResource\Pages;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Kumi\Sousa\Models\Vessel;
use Filament\Pages\Actions\Action;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Filament\Resources\Pages\CreateRecord;
use Kumi\Sousa\Filament\Pages\VesselVoyages;
use Kumi\Sousa\Filament\Pages\VesselsToVoyagesList;
use Kumi\Sousa\Filament\Resources\VesselVoyageResource;
use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\WaitingForDeparture;
use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\WaitingForInstructions;

class CreateVesselVoyage extends CreateRecord
{
    protected static string $resource = VesselVoyageResource::class;

    protected static bool $canCreateAnother = false;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] = $data['is_returning']
            ? WaitingForDeparture::class
            : WaitingForInstructions::class;

        return $data;
    }

    protected function getCancelFormAction(): Action
    {
        $request = App::make(Request::class);

        if (empty($vesselID = $request->get('vessel_id'))) {
            return parent::getCancelFormAction();
        }

        return Action::make('cancel')
            ->label(__('filament::resources/pages/edit-record.form.actions.cancel.label'))
            ->url(function () use ($vesselID) {
                $vessel = Vessel::find($vesselID);

                abort_unless($vessel, Response::HTTP_NOT_FOUND);

                return VesselVoyages::getUrl(['vessel' => $vessel]);
            })
            ->color('secondary')
        ;
    }

    protected function getBreadcrumbs(): array
    {
        $request = App::make(Request::class);

        if (empty($vesselID = $request->get('vessel_id'))) {
            return parent::getBreadcrumbs();
        }

        $breadcrumbs[
            VesselsToVoyagesList::getUrl()
        ] = 'Vessels';

        $breadcrumbs[
            VesselVoyages::getUrl(['vessel' => $vesselID])
        ] = 'Voyages';

        $breadcrumbs[
            URL::full() . '#'
        ] = 'Create';

        return $breadcrumbs;
    }
}

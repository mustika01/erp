<?php

namespace Kumi\Sousa\Filament\Pages;

use Filament\Pages;
use Filament\Pages\Page;
use Illuminate\Http\Response;
use Kumi\Sousa\Models\Vessel;
use Illuminate\Support\Facades\Auth;
use Kumi\Sousa\Support\DefaultPermissions;
use Kumi\Sousa\Filament\Resources\VesselVoyageResource;

class VesselVoyages extends Page
{
    public ?Vessel $vessel = null;

    protected static string $view = 'sousa::filament.pages.vessel-voyages';

    protected static ?string $slug = 'sousa/vessels/{vessel}/voyages';

    public function mount(): void
    {
        abort_unless(Auth::user()->can(DefaultPermissions::VIEW_ANY_VESSEL_VOYAGES), Response::HTTP_UNAUTHORIZED);
    }

    protected static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    protected function getHeading(): string
    {
        return "{$this->vessel->name} - Voyages";
    }

    protected function getActions(): array
    {
        return [
            Pages\Actions\Action::make('create')
                ->label(__('New voyage'))
                ->url(VesselVoyageResource::getUrl('create', ['vessel_id' => $this->vessel])),
        ];
    }

    protected function getBreadcrumbs(): array
    {
        $breadcrumbs[
            VesselsToVoyagesList::getUrl()
        ] = 'Vessels';

        $breadcrumbs[
            self::getUrl(['vessel' => $this->vessel])
        ] = 'Voyages';

        $breadcrumbs[
            self::getUrl(['vessel' => $this->vessel]) . '#'
        ] = 'List';

        return $breadcrumbs;
    }
}

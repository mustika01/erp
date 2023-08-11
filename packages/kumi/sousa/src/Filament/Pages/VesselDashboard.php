<?php

namespace Kumi\Sousa\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Kumi\Sousa\Filament\Resources\VesselResource;
use Kumi\Sousa\Filament\Resources\VesselResource\Pages\Widgets\VesselBunkerWidget;
use Kumi\Sousa\Filament\Resources\VesselResource\Pages\Widgets\VesselCalendarWidget;
use Kumi\Sousa\Filament\Resources\VesselResource\Pages\Widgets\VesselDataWidget;
use Kumi\Sousa\Filament\Resources\VesselResource\Pages\Widgets\VesselLocationWidget;
use Kumi\Sousa\Filament\Resources\VesselResource\Pages\Widgets\VesselStatusesWidget;
use Kumi\Sousa\Models\Vessel;
use Kumi\Sousa\Support\DefaultPermissions;

class VesselDashboard extends Page
{
    public ?Vessel $vessel = null;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'sousa/vessels/{vessel}/dashboard';

    protected static string $view = 'sousa::filament.pages.vessel-dashboard';

    public function mount(): void
    {
        abort_unless(Auth::user()->can(DefaultPermissions::VIEW_VESSEL_DASHBOARD), Response::HTTP_UNAUTHORIZED);
    }

    protected function getHeading(): string
    {
        return 'Dashboard';
    }

    protected function getHeaderWidgets(): array
    {
        return [
            VesselDataWidget::class,
            VesselLocationWidget::class,
            VesselBunkerWidget::class,
            VesselStatusesWidget::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            VesselCalendarWidget::class,
        ];
    }

    protected function getBreadcrumbs(): array
    {
        $breadcrumbs[
            VesselResource::getUrl('index')
        ] = 'Vessels';

        $breadcrumbs[
            self::getUrl(['vessel' => $this->vessel])
        ] = 'Dashboard';

        $breadcrumbs[
            self::getUrl(['vessel' => $this->vessel]) . '#'
        ] = $this->vessel->name;

        return $breadcrumbs;
    }
}

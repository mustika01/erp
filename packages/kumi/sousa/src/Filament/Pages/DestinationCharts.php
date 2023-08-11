<?php

namespace Kumi\Sousa\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Kumi\Sousa\Support\DefaultPermissions;

class DestinationCharts extends Page
{
    public Collection $destinations;

    protected static string $layout = 'sousa::layouts.overview';

    protected static ?string $navigationGroup = 'sousa';

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';

    protected static ?int $navigationSort = 3002;

    protected static string $view = 'sousa::filament.pages.destination-charts';

    public function mount(): void
    {
        abort_unless(Auth::user()->can(DefaultPermissions::VIEW_DESTINATION_CHARTS), Response::HTTP_UNAUTHORIZED);
    }

    protected static function shouldRegisterNavigation(): bool
    {
        return Auth::user()->can(DefaultPermissions::VIEW_DESTINATION_CHARTS);
    }

    protected function getHeading(): string
    {
        return 'Destination Charts';
    }
}

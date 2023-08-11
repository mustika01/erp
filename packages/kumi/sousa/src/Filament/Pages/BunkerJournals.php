<?php

namespace Kumi\Sousa\Filament\Pages;

use Filament\Pages;
use Filament\Pages\Page;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Kumi\Sousa\Filament\Resources\BunkerJournalResource;
use Kumi\Sousa\Filament\Resources\BunkerJournalResource\Pages\Widgets\BunkerJournalsChartWidget;
use Kumi\Sousa\Filament\Resources\BunkerResource;
use Kumi\Sousa\Models\Bunker;
use Kumi\Sousa\Support\DefaultPermissions;

class BunkerJournals extends Page
{
    public ?Bunker $bunker = null;

    protected static string $view = 'sousa::filament.pages.bunker-journals';

    protected static ?string $slug = 'sousa/bunkers/{bunker}/solar-journals';

    // public function mount(): void
    // {
    //     abort_unless(Auth::user()->can(DefaultPermissions::VIEW_ANY_VESSEL_VOYAGES), Response::HTTP_UNAUTHORIZED);
    // }

    protected static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    protected function getHeaderWidgets(): array
    {
        return [
            BunkerJournalsChartWidget::class,
        ];
    }

    protected function getHeading(): string
    {
        return "{$this->bunker->vessel->name} - Solar Journals";
    }

    protected function getActions(): array
    {
        return [
            Pages\Actions\Action::make('create')
                ->label(__('New Journal'))
                ->url(BunkerJournalResource::getUrl('create', ['bunker_id' => $this->bunker]))
                ->authorize(function () {
                    return BunkerJournalResource::canCreate();
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
        ] = 'Solar';

        return $breadcrumbs;
    }
}

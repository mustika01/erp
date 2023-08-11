<?php

namespace Kumi\Sousa\Providers;

use Filament\PluginServiceProvider as BasePluginServiceProvider;
use Kumi\Sousa\Console\Commands\SyncArgosMonitoringVesselTracksCommand;
use Kumi\Sousa\Console\Commands\SyncGeoTrackVesselTracksCommand;
use Kumi\Sousa\Console\Commands\SyncVesselProVesselTracksCommand;
use Kumi\Sousa\Filament\Pages\BunkerJournals;
use Kumi\Sousa\Filament\Pages\DestinationCharts;
use Kumi\Sousa\Filament\Pages\OilJournals;
use Kumi\Sousa\Filament\Pages\Overview;
use Kumi\Sousa\Filament\Pages\VesselDashboard;
use Kumi\Sousa\Filament\Pages\VesselsToVoyagesList;
use Kumi\Sousa\Filament\Pages\VesselVoyages;
use Kumi\Sousa\Filament\Pages\VoyageReport;
use Kumi\Sousa\Filament\Resources\BunkerJournalResource;
use Kumi\Sousa\Filament\Resources\BunkerJournalResource\Pages\Widgets as BunkerJournalResourceWidgets;
use Kumi\Sousa\Filament\Resources\BunkerResource;
use Kumi\Sousa\Filament\Resources\OilJournalResource;
use Kumi\Sousa\Filament\Resources\OilJournalResource\Pages\Widgets as OilJournalResourceWidgets;
use Kumi\Sousa\Filament\Resources\VesselDocumentResource;
use Kumi\Sousa\Filament\Resources\VesselResource;
use Kumi\Sousa\Filament\Resources\VesselResource\Pages\Widgets as VesselResourceWidgets;
use Kumi\Sousa\Filament\Resources\VesselVoyageResource;
use Kumi\Sousa\Filament\Resources\VesselVoyageResource\Pages\Widgets\SingleVoyageBunkerJournalsWidget;
use Kumi\Sousa\Filament\Resources\VesselVoyageResource\Pages\Widgets\SingleVoyageCalendarWidget;
use Kumi\Sousa\Filament\Resources\VesselVoyageResource\Pages\Widgets\VoyageStatsWidget;
use Kumi\Sousa\Filament\Widgets\DestinationVesselStatusesWidget;
use Spatie\LaravelPackageTools\Package;

class PluginServiceProvider extends BasePluginServiceProvider
{
    protected array $resources = [
        VesselResource::class,
        VesselDocumentResource::class,
        VesselVoyageResource::class,
        BunkerResource::class,
        BunkerJournalResource::class,
        OilJournalResource::class,
    ];

    protected array $pages = [
        Overview::class,
        DestinationCharts::class,
        VesselDashboard::class,
        VesselsToVoyagesList::class,
        VesselVoyages::class,
        BunkerJournals::class,
        OilJournals::class,
    ];

    protected array $widgets = [
        VesselResourceWidgets\VesselDataWidget::class,
        VesselResourceWidgets\VesselLocationWidget::class,
        VesselResourceWidgets\VesselCalendarWidget::class,
        VesselResourceWidgets\VesselBunkerWidget::class,
        VesselResourceWidgets\VesselStatusesWidget::class,
        BunkerJournalResourceWidgets\BunkerJournalsChartWidget::class,
        OilJournalResourceWidgets\OilJournalsUsageChartWidget::class,
        OilJournalResourceWidgets\OilJournalsROBChartWidget::class,
        VoyageStatsWidget::class,
        SingleVoyageCalendarWidget::class,
        SingleVoyageBunkerJournalsWidget::class,
        DestinationVesselStatusesWidget::class,
    ];

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name('sousa')
            ->hasCommands([
                SyncVesselProVesselTracksCommand::class,
                SyncGeoTrackVesselTracksCommand::class,
                SyncArgosMonitoringVesselTracksCommand::class,
            ])
        ;
    }

    public function bootingPackage(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/settings');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'sousa');
        $this->loadViewsFrom(__DIR__ . '/../../views', 'sousa');
    }
}

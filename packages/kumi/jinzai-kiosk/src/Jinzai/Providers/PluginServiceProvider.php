<?php

namespace Kumi\Jinzai\Providers;

use Filament\PluginServiceProvider as BasePluginServiceProvider;
use Kumi\Jinzai\Filament\Pages\Dashboard;
use Kumi\Jinzai\Filament\Pages\Overview;
use Kumi\Jinzai\Filament\Resources\ContractResource;
use Kumi\Jinzai\Filament\Resources\DepartmentResource;
use Kumi\Jinzai\Filament\Resources\EmployeeResource;
use Kumi\Jinzai\Filament\Resources\PayoutResource;
use Kumi\Jinzai\Filament\Resources\PayrollResource;
use Kumi\Jinzai\Filament\Widgets\EmployeeProgressWidget;
use Kumi\Jinzai\Filament\Widgets\EmploymentStatusWidget;
use Kumi\Jinzai\Filament\Widgets\GenderDiversityWidget;
use Kumi\Jinzai\Filament\Widgets\IndonesiaPuzzlesWidget;
use Kumi\Jinzai\Filament\Widgets\QuickLinksWidget;
use Kumi\Jinzai\Filament\Widgets\WelcomeWidget;
use Spatie\LaravelPackageTools\Package;

class PluginServiceProvider extends BasePluginServiceProvider
{
    protected array $pages = [
        Dashboard::class,
        Overview::class,
    ];

    protected array $resources = [
        EmployeeResource::class,
        PayrollResource::class,
        DepartmentResource::class,
        PayoutResource::class,
        ContractResource::class,
    ];

    protected array $beforeCoreScripts = [
        'jinzai-scripts' => 'https://cdn.jsdelivr.net/npm/@ryangjchandler/alpine-clipboard@2.x.x/dist/alpine-clipboard.js',
    ];

    protected array $widgets = [
        WelcomeWidget::class,
        EmployeeProgressWidget::class,
        GenderDiversityWidget::class,
        EmploymentStatusWidget::class,
        QuickLinksWidget::class,
        IndonesiaPuzzlesWidget::class,
        PayoutResource\Widgets\PayoutAmountWidget::class,
        PayoutResource\Widgets\PayoutOverviewWidget::class,
    ];

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name('jinzai');
    }

    public function bootingPackage(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../../database/migrations/jinzai');
        $this->loadRoutesFrom(__DIR__ . '/../../../routes/jinzai/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../../../routes/jinzai/api.php');
        $this->loadTranslationsFrom(__DIR__ . '/../../../lang/jinzai', 'jinzai');
        $this->loadViewsFrom(__DIR__ . '/../../../views/jinzai', 'jinzai');
    }
}

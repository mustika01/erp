<?php

namespace Kumi\Jinzai\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Route;
use Kumi\Jinzai\Filament\Widgets\WelcomeWidget;
use Kumi\Jinzai\Filament\Widgets\IndonesiaPuzzlesWidget;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?int $navigationSort = -2;

    protected static string $view = 'jinzai::filament.pages.dashboard';

    public static function getRoutes(): \Closure
    {
        return function () {
            Route::get('/', static::class)->name(static::getSlug());
        };
    }

    protected static function getNavigationLabel(): string
    {
        return static::$navigationLabel ?? static::$title ?? __('filament::pages/dashboard.title');
    }

    protected function getWidgets(): array
    {
        return [
            WelcomeWidget::class,
            IndonesiaPuzzlesWidget::class,
        ];
    }

    protected function getTitle(): string
    {
        return static::$title ?? __('filament::pages/dashboard.title');
    }
}

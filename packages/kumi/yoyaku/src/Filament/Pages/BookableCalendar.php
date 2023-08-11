<?php

namespace Kumi\Yoyaku\Filament\Pages;

use Filament\Pages\Page;
use Kumi\Yoyaku\Models\Bookable;
use Kumi\Yoyaku\Filament\Widgets\BookableCalendarWidget;

class BookableCalendar extends Page
{
    public Bookable $bookable;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'yoyaku/bookables/{bookable}/calendar';

    protected static string $view = 'yoyaku::filament.pages.bookable-calendar';

    protected function getHeading(): string
    {
        return "Calendar - {$this->bookable->name}";
    }

    protected function getFooterWidgets(): array
    {
        return [
            BookableCalendarWidget::class,
        ];
    }
}

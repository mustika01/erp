<?php

namespace Kumi\Jinzai\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Kumi\Jinzai\Support\DefaultPermissions;
use Kumi\Jinzai\Filament\Widgets\QuickLinksWidget;
use Kumi\Jinzai\Filament\Widgets\GenderDiversityWidget;
use Kumi\Jinzai\Filament\Widgets\EmployeeProgressWidget;
use Kumi\Jinzai\Filament\Widgets\EmploymentStatusWidget;

class Overview extends Page
{
    protected static ?string $navigationGroup = 'jinzai';

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?int $navigationSort = 2001;

    protected static ?string $slug = 'jinzai/overview';

    protected static string $view = 'jinzai::filament.pages.overview';

    public function mount(): void
    {
        abort_unless(Auth::user()->can(DefaultPermissions::OVERVIEW_JINZAI), Response::HTTP_FORBIDDEN);
    }

    protected function getWidgets(): array
    {
        return [
            EmployeeProgressWidget::class,
            GenderDiversityWidget::class,
            EmploymentStatusWidget::class,
            QuickLinksWidget::class,
        ];
    }

    protected static function shouldRegisterNavigation(): bool
    {
        return Auth::user()->can(DefaultPermissions::OVERVIEW_JINZAI);
    }
}

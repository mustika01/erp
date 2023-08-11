<?php

namespace Kumi\Senzou\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Kumi\Senzou\Support\DefaultPermissions;

class DeliveryNoteDailyReport extends Page
{
    protected static ?string $navigationGroup = 'senzou';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 4005;

    protected static string $view = 'senzou::filament.pages.delivery-note-daily-report';

    public function mount(): void
    {
        abort_unless(Auth::user()->can(DefaultPermissions::VIEW_DELIVERY_NOTE_DAILY_REPORT), Response::HTTP_UNAUTHORIZED);
    }

    protected static function shouldRegisterNavigation(): bool
    {
        return Auth::user()->can(DefaultPermissions::VIEW_DELIVERY_NOTE_DAILY_REPORT);
    }

    protected function getTitle(): string
    {
        return __('senzou::filament/resources/delivery-note.headings.daily-report');
    }

    protected static function getNavigationLabel(): string
    {
        return __('senzou::filament/resources/delivery-note.headings.daily-report');
    }

    protected function getActions(): array
    {
        return [
            Actions\PreviewDeliveryNoteDailyReportAction::make(),
            Actions\DownloadDeliveryNoteDailyReportAction::make(),
        ];
    }
}

<?php

namespace Kumi\Kiosk\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Kumi\Kiosk\Support\DefaultPermissions;

class MyInformation extends Page
{
    protected static ?string $navigationGroup = 'kiosk';

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?int $navigationSort = 1001;

    protected static ?string $slug = 'kiosk/my-information';

    protected static string $view = 'kiosk::filament.pages.my-information';

    public function mount(): void
    {
        $user = Auth::user();

        abort_unless((bool) $user->employee && $user->can(DefaultPermissions::VIEW_OWN_PERSONAL_INFORMATION), Response::HTTP_FORBIDDEN);
    }

    protected static function shouldRegisterNavigation(): bool
    {
        $user = Auth::user();

        return (bool) $user->employee && $user->can(DefaultPermissions::VIEW_OWN_PERSONAL_INFORMATION);
    }
}

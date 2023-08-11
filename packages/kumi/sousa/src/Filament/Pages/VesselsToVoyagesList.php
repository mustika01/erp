<?php

namespace Kumi\Sousa\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Http\Response;
use Kumi\Sousa\Models\Vessel;
use Illuminate\Support\Facades\Auth;
use Kumi\Sousa\Support\DefaultPermissions;

class VesselsToVoyagesList extends Page
{
    public ?Vessel $vessel = null;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'sousa';

    protected static ?int $navigationSort = 3005;

    protected static ?string $slug = 'sousa/vessels-to-voyages-list';

    protected static ?string $title = 'Voyages';

    protected static string $view = 'sousa::filament.pages.vessels-to-voyages-list';

    public function mount(): void
    {
        abort_unless(Auth::user()->can(DefaultPermissions::VIEW_ANY_VESSEL_VOYAGES), Response::HTTP_UNAUTHORIZED);
    }

    protected static function shouldRegisterNavigation(): bool
    {
        return Auth::user()->can(DefaultPermissions::VIEW_ANY_VESSEL_VOYAGES);
    }
}

<?php

namespace Kumi\Norikumi\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Kumi\Norikumi\Support\DefaultPermissions;

class ListVessels extends Page
{
    protected static ?string $navigationGroup = 'norikumi';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static string $view = 'norikumi::filament.pages.list-vessels';

    protected static ?string $navigationLabel = 'Assignments';

    protected static ?int $navigationSort = 2102;

    protected static ?string $slug = 'norikumi/vessels';

    public function mount(): void
    {
        parent::mount();

        abort_unless(Auth::user()->can(DefaultPermissions::VIEW_ANY_ASSIGNMENTS), Response::HTTP_NOT_FOUND);
    }

    protected function getBreadcrumbs(): array
    {
        $breadcrumbs[
            self::getUrl()
        ] = 'Vessels';

        $breadcrumbs[
            self::getUrl() . '#'
        ] = 'List';

        return $breadcrumbs;
    }

    protected static function shouldRegisterNavigation(): bool
    {
        return Auth::user()->can(DefaultPermissions::VIEW_ANY_ASSIGNMENTS);
    }
}

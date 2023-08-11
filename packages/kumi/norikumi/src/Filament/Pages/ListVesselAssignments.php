<?php

namespace Kumi\Norikumi\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Kumi\Norikumi\Filament\Pages\ListVesselAssignments\Actions;
use Kumi\Norikumi\Support\DefaultPermissions;
use Kumi\Sousa\Models\Vessel;

class ListVesselAssignments extends Page
{
    public ?Vessel $vessel = null;

    protected static ?string $navigationGroup = 'norikumi';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static string $view = 'norikumi::filament.pages.list-vessel-assignments';

    protected static ?string $navigationLabel = 'Assignments';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'norikumi/vessels/{vessel}/assignments';

    public function mount(): void
    {
        parent::mount();

        abort_unless(Auth::user()->can(DefaultPermissions::VIEW_ANY_ASSIGNMENTS), Response::HTTP_NOT_FOUND);
    }

    protected function getBreadcrumbs(): array
    {
        $breadcrumbs[
            ListVessels::getUrl()
        ] = 'Vessels';

        $breadcrumbs[
            self::getUrl(['vessel' => $this->vessel])
        ] = $this->vessel->name;

        return $breadcrumbs;
    }

    protected function getHeading(): string|Htmlable
    {
        return "Assignments - {$this->vessel->name}";
    }

    protected function getActions(): array
    {
        return [
            Actions\AssignAction::make()
                ->record($this->vessel),
        ];
    }
}

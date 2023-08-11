<?php

namespace Kumi\Jinzai\Filament\Widgets;

use Filament\Widgets\Widget;
use Filament\Facades\Filament;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Kumi\Kiosk\Support\DefaultPermissions;
use Kumi\Kiosk\Filament\Resources\PersonalTicketResource;

class WelcomeWidget extends Widget
{
    public string $userAvatarUrl;

    public string $userDisplayName;

    protected int|string|array $columnSpan = 'full';

    protected static string $view = 'jinzai::filament.widgets.welcome-widget';

    public function mount(): void
    {
        $user = Auth::user();

        $this->userAvatarUrl = Filament::getUserAvatarUrl($user);
        $this->userDisplayName = Filament::getUserName($user);
    }

    public function getGreeting(): string
    {
        $hour = Carbon::now()->hour;

        $greeting = match ($hour) {
            0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 => 'morning',
            12, 13, 14, 15, 16 => 'afternoon',
            17, 18, 19, 20, 21 => 'evening',
            22, 23 => 'night',
        };

        return $greeting;
    }

    public function getLinks(): Collection
    {
        return Collection::make([
            [
                'label' => __('jinzai::filament/widgets/welcome.links.new_ticket.label'),
                'url' => PersonalTicketResource::getUrl('create'),
                'permission' => DefaultPermissions::CREATE_PERSONAL_TICKET,
            ],
        ])->filter(function (array $link) {
            return Auth::user()->can($link['permission']);
        });
    }

    public function getDate(): string
    {
        return Carbon::now()->format('l, d F Y');
    }
}

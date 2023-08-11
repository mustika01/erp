<?php

namespace Kumi\Norikumi\Filament\Resources\PayoutResource\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Kumi\Norikumi\Support\DefaultPermissions;

class PayoutAmountWidget extends Widget
{
    public ?Model $record = null;

    protected int|string|array $columnSpan = 1;

    protected static string $view = 'norikumi::filament.resources.payout.widgets.payout-amount-widget';

    public static function canView(): bool
    {
        return Auth::user()->can(DefaultPermissions::VIEW_ANY_PAYOUT_ITEMS);
    }
}

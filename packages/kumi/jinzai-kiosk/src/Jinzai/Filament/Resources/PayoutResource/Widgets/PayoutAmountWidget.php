<?php

namespace Kumi\Jinzai\Filament\Resources\PayoutResource\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Kumi\Jinzai\Support\DefaultPermissions;

class PayoutAmountWidget extends Widget
{
    public ?Model $record = null;

    protected int|string|array $columnSpan = 1;

    protected static string $view = 'jinzai::filament.resources.payout.widgets.payout-amount-widget';

    public static function canView(): bool
    {
        return Auth::user()->can(DefaultPermissions::VIEW_ANY_PAYOUT_ITEMS);
    }
}

<?php

namespace Kumi\Sousa\Filament\Resources\VesselResource\Pages\Widgets;

use Filament\Widgets\Widget;
use Kumi\Sousa\Models\Vessel;

class VesselDataWidget extends Widget
{
    public ?Vessel $vessel = null;

    protected static string $view = 'sousa::filament.widgets.vessel-data-widget';
}

<?php

namespace Kumi\Sousa\Filament\Resources\VesselResource\Pages\Actions;

use Filament\Pages\Actions\Action;

class DownloadShipParticularsAction extends Action
{
    public function setUp(): void
    {
        $this->button();

        $this->color('secondary');

        $this->label(__('sousa::filament/resources/vessel.actions.download-ship-particulars.label'));
    }

    public static function getDefaultName(): ?string
    {
        return 'download-ship-particulars';
    }
}

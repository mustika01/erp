<?php

namespace Kumi\Sousa\Filament\Resources\VesselResource\Pages\Actions;

use Filament\Pages\Actions\Action;

class PreviewShipParticularsAction extends Action
{
    public function setUp(): void
    {
        $this->button();

        $this->color('secondary');

        $this->label(__('sousa::filament/resources/vessel.actions.preview-ship-particulars.label'));
    }

    public static function getDefaultName(): ?string
    {
        return 'preview-ship-particulars';
    }
}

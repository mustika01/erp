<?php

namespace Kumi\Senzou\Filament\Pages\Actions;

use Filament\Pages\Actions\Action;
use Illuminate\Http\Request;

class PreviewDeliveryNoteDailyReportAction extends Action
{
    public function setUp(): void
    {
        $this->button();

        $this->color('primary');

        $this->label(__('senzou::filament/resources/delivery-note.actions.preview-dn-daily-report.label'));

        $this->url(function (Request $request) {
            return route('senzou.delivery-note-daily-report.preview', $request->only(['date']));
        });

        $this->openUrlInNewTab();
    }

    public static function getDefaultName(): ?string
    {
        return 'preview-delivery-note-daily-report';
    }
}

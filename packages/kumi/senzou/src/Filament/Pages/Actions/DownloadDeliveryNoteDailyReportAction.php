<?php

namespace Kumi\Senzou\Filament\Pages\Actions;

use Filament\Pages\Actions\Action;
use Illuminate\Http\Request;

class DownloadDeliveryNoteDailyReportAction extends Action
{
    public function setUp(): void
    {
        $this->button();

        $this->color('success');

        $this->label(__('senzou::filament/resources/delivery-note.actions.download-dn-daily-report.label'));

        $this->url(function (Request $request) {
            return route('senzou.delivery-note-daily-report.download', $request->only(['date']));
        });

        $this->openUrlInNewTab();
    }

    public static function getDefaultName(): ?string
    {
        return 'download-delivery-note-daily-report';
    }
}

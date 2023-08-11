<?php

namespace Kumi\Kanri\Filament\Resources\ReportResource\Table\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Kumi\Kanri\Support\DefaultPermissions;

class DownloadAction extends Action
{
    public function setUp(): void
    {
        $this->icon('heroicon-o-download');

        $this->color('success');

        $this->label(__('kanri::filament/resources/report.columns.download.label'));

        $this->url(function (Model $record) {
            return route('reports.voyage-summary.download', [
                'report' => $record,
            ]);
        });

        $this->authorize(DefaultPermissions::DOWNLOAD_VOYAGE_SUMMARY_REPORT);

        $this->visible(function (Model $record) {
            return $record->reportable_type === \Kumi\Sousa\Models\VesselVoyage::class;
        });

        $this->openUrlInNewTab();
    }

    public static function getDefaultName(): ?string
    {
        return 'download-voyage-summary';
    }
}

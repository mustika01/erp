<?php

namespace Kumi\Kanri\Filament\Resources\ReportResource\Table\Actions;

use Illuminate\Database\Eloquent\Model;
use Kumi\Kanri\Actions\GenerateAuthorizedReportableType;
use Filament\Tables\Actions\ViewAction as BaseViewAction;

class ViewAction extends BaseViewAction
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->url(function (Model $record) {
            return match ($record->reportable_type) {
                \Kumi\Jinzai\Models\Payout::class => route('reports.payout.preview', [$record]),
                \Kumi\Sousa\Models\VesselVoyage::class => route('reports.voyage-summary.preview', [$record]),
                'docking-schedule' => route('reports.docking-schedule.preview', [$record]),
                default => '#',
            };
        });

        $this->openUrlInNewTab();

        $this->visible(function (Model $record) {
            $collection = GenerateAuthorizedReportableType::run();

            return $collection->contains(function ($type) use ($record) {
                return $record->reportable_type === $type;
            });
        });
    }
}

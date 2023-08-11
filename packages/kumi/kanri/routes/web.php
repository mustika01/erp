<?php

use Illuminate\Support\Facades\Route;
use Kumi\Kanri\Http\Controllers\DockingSchedule\ReportController as DockingScheduleReportController;
use Kumi\Kanri\Http\Controllers\Payout\ReportController as PayoutReportController;
use Kumi\Kanri\Http\Controllers\VoyageSummary\ReportController as VoyageSummaryReportController;
use Kumi\Kanri\Support\DefaultPermissions;

Route::domain(config('filament.domain'))
    ->middleware(config('filament.middleware.base'))
    ->group(function () {
        Route::middleware(config('filament.middleware.auth'))->group(function () {
            Route::get('/reports/payout/{report}/preview', [PayoutReportController::class, 'preview'])->name('reports.payout.preview');
            Route::get('/reports/docking-schedule/{report}/preview', [DockingScheduleReportController::class, 'preview'])->name('reports.docking-schedule.preview');

            Route::get('/reports/voyage-summary/{report}/download', [VoyageSummaryReportController::class, 'download'])
                ->name('reports.voyage-summary.download')
                ->middleware('can:' . DefaultPermissions::DOWNLOAD_VOYAGE_SUMMARY_REPORT)
            ;
        });

        Route::get('/reports/voyage-summary/{report}/preview', [VoyageSummaryReportController::class, 'preview'])
            ->name('reports.voyage-summary.preview')
        ;
    })
;

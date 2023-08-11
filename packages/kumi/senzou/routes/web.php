<?php

use Illuminate\Support\Facades\Route;
use Kumi\Senzou\Http\Controllers\Administration\RequestNoteController as AdministrationRequestNoteController;
use Kumi\Senzou\Http\Controllers\ApproveController;
use Kumi\Senzou\Http\Controllers\DeliveryNoteDailyReportController;
use Kumi\Senzou\Http\Controllers\DeliveryNotesController;
use Kumi\Senzou\Http\Controllers\LocaleController;
use Kumi\Senzou\Http\Controllers\LoginController;
use Kumi\Senzou\Http\Controllers\LogoutController;
use Kumi\Senzou\Http\Controllers\RejectController;
use Kumi\Senzou\Http\Controllers\ShipCrew\RequestNoteController as ShipCrewRequestNoteController;
use Kumi\Senzou\Http\Middleware\Authenticate;
use Kumi\Senzou\Http\Middleware\SetLocale;
use Kumi\Senzou\Support\DefaultPermissions;

Route::group([
    'domain' => config('filament.domain'),
    'middleware' => config('filament.middleware.base'),
    'prefix' => '/senzou',
    'as' => 'senzou.',
], function () {
    Route::middleware(config('filament.middleware.auth'))->group(function () {
        Route::get('/delivery-notes/{record}/download', [DeliveryNotesController::class, 'download'])
            ->name('delivery-notes.download')
            ->middleware('can:' . DefaultPermissions::DOWNLOAD_DELIVERY_NOTES)
        ;

        Route::get('/delivery-note-daily-report/download', [DeliveryNoteDailyReportController::class, 'download'])
            ->name('delivery-note-daily-report.download')
            ->middleware('can:' . DefaultPermissions::DOWNLOAD_DELIVERY_NOTE_DAILY_REPORT)
        ;

        Route::get('/request-notes/{record}/download', [AdministrationRequestNoteController::class, 'download'])
            ->name('request-notes.download')
            ->middleware('can:' . DefaultPermissions::DOWNLOAD_REQUEST_NOTE)
        ;
    });

    Route::get('/delivery-notes/{record}/preview', [DeliveryNotesController::class, 'preview'])
        ->name('delivery-notes.preview')
        // ->middleware('can:' . DefaultPermissions::PREVIEW_DELIVERY_NOTES)
    ;

    Route::get('/delivery-note-daily-report/preview', [DeliveryNoteDailyReportController::class, 'preview'])
        ->name('delivery-note-daily-report.preview')
        // ->middleware('can:' . DefaultPermissions::PREVIEW_DELIVERY_NOTE_DAILY_REPORT)
    ;

    Route::get('/request-notes/{record}/preview', [AdministrationRequestNoteController::class, 'preview'])
        ->name('request-notes.preview')
        // ->middleware('can:' . DefaultPermissions::PREVIEW_REQUEST_NOTE)
    ;
});

Route::group([
    'domain' => config('filament.domain'),
    'middleware' => ['web', SetLocale::class],
    'prefix' => '/senzou',
    'as' => 'senzou.',
], function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login')
    ;
    Route::post('/login', [LoginController::class, 'authenticate']);

    Route::group([
        'middleware' => [
            Authenticate::class . ':web_vessel',
        ],
    ], function () {
        Route::resource('request-notes', ShipCrewRequestNoteController::class);

        Route::get('/locale/change/{locale}', [LocaleController::class, 'change'])
            ->name('locale.change')
        ;

        Route::post('/request-notes/{request_note}/approve', [ApproveController::class, 'approve'])
            ->name('request-notes.approve')
        ;

        Route::post('/request-notes/{request_note}/reject', [RejectController::class, 'reject'])
            ->name('request-notes.reject')
        ;

        Route::post('/logout', [LogoutController::class, 'perform'])
            ->name('logout')
        ;
    });
});

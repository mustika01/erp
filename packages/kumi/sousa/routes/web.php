<?php

use Illuminate\Support\Facades\Route;
use Kumi\Sousa\Http\Controllers\ExpiringDocumentsController;
use Kumi\Sousa\Http\Controllers\ShipParticularsController;
use Kumi\Sousa\Http\Controllers\StatusesVoyageController;
use Kumi\Sousa\Support\DefaultPermissions;

Route::group([
    'domain' => config('filament.domain'),
    'middleware' => config('filament.middleware.base'),
    'prefix' => '/sousa',
    'as' => 'sousa.',
], function () {
    Route::middleware(config('filament.middleware.auth'))->group(function () {
        Route::get('/vessels/{vessel}/ship-particulars/download', [ShipParticularsController::class, 'download'])
            ->name('ship-particulars.download')
            ->middleware('can:' . DefaultPermissions::DOWNLOAD_VESSEL_SHIP_PARTICULARS)
        ;

        Route::get('/vessel-documents/expiring-documents/download', [ExpiringDocumentsController::class, 'download'])
            ->name('expiring-documents.download')
            ->middleware('can:' . DefaultPermissions::DOWNLOAD_EXPIRING_DOCUMENTS)
        ;

        Route::get('/statuses-voyage/{record}/download', [StatusesVoyageController::class, 'download'])
            ->name('statuses-voyage.download')
            ->middleware('can:' . DefaultPermissions::DOWNLOAD_STATUSES_VOYAGE)
        ;
   
    });

    Route::get('/vessels/{vessel}/ship-particulars/preview', [ShipParticularsController::class, 'preview'])
        ->name('ship-particulars.preview')
        // ->middleware('can:' . DefaultPermissions::PREVIEW_VESSEL_SHIP_PARTICULARS)
    ;

    Route::get('/vessel-documents/expiring-documents/preview', [ExpiringDocumentsController::class, 'preview'])
        ->name('expiring-documents.preview')
        // ->middleware('can:' . DefaultPermissions::PREVIEW_EXPIRING_DOCUMENTS)
    ;
    Route::get('/statuses-voyage/{record}/preview', [StatusesVoyageController::class, 'preview'])
        ->name('statuses-voyage.preview')
        // ->middleware('can:' . DefaultPermissions::PREVIEW_EXPIRING_DOCUMENTS)
    ;

});

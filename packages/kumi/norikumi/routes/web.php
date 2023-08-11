<?php

use Illuminate\Support\Facades\Route;
use Kumi\Norikumi\Http\Controllers\RegistrationFormEntryController;

Route::group([
    'middleware' => 'web',
    'as' => 'norikumi.',
], function () {
    Route::get('/rfe/{entry}', [RegistrationFormEntryController::class, 'redirect'])->name('registration-form-entry.redirect');

    Route::group([
        'prefix' => '/norikumi',
    ], function () {
        Route::get('/registration-form-entries/{entry}/session', [RegistrationFormEntryController::class, 'session'])->name('registration-form-entry.session');
        Route::post('/registration-form-entries/{entry}/auth', [RegistrationFormEntryController::class, 'auth'])->name('registration-form-entry.auth');
        Route::get('/registration-form-entries/{entry}/edit', [RegistrationFormEntryController::class, 'edit'])->name('registration-form-entry.edit');
        Route::get('/registration-form-entries/complete', [RegistrationFormEntryController::class, 'complete'])->name('registration-form-entry.complete');
    });
});

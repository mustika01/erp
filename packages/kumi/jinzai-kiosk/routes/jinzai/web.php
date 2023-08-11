<?php

use Illuminate\Support\Facades\Route;
use Kumi\Jinzai\Http\Controllers\OnboardingController;

Route::domain(config('filament.domain'))
    ->middleware(config('filament.middleware.base'))
    ->name('filament.')
    ->group(function () {
        Route::prefix(config('filament.path') . '/jinzai')->group(function () {
            Route::get('/onboarding/{link:token}', [OnboardingController::class, 'edit'])->name('onboarding.edit');
            Route::put('/onboarding/{link:token}', [OnboardingController::class, 'update'])->name('onboarding.update');
        });
    })
;

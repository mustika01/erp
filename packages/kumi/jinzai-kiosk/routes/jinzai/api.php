<?php

use Illuminate\Support\Facades\Route;
use Kumi\Jinzai\Http\Integrations\OneBrick\DisbursementsController;

Route::group([
    'middleware' => 'api',
    'name' => 'api.integrations.onebrick',
    'prefix' => '/api/integrations/onebrick',
], function () {
    Route::post('/disbursements', DisbursementsController::class)->name('disbursements');
});

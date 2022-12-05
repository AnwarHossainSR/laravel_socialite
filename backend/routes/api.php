<?php

use App\Http\Controllers\socialController;
use Illuminate\Support\Facades\Route;


// Route::group(['middleware' => ['web']], function () {
//     Route::get('/login/{provider}', [socialController::class, 'provider']);
//     Route::get('/{provider}/callback', [socialController::class, 'providerCallback']);
// });

Route::middleware(['cors'])->group(function () {
    Route::get('/login/{provider}', [socialController::class, 'provider']);
    Route::get('/{provider}/callback', [socialController::class, 'providerCallback']);
});

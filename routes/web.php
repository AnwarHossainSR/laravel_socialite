<?php

use App\Http\Controllers\socialController;
use Illuminate\Support\Facades\Route;

Route::get('/login/{provider}', [socialController::class, 'provider']);
Route::get('/{provider}/callback', [socialController::class, 'providerCallback']);

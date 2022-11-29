<?php

use App\Http\Controllers\Authcontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [Authcontroller::class, 'login']);


//Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

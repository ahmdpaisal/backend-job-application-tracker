<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)
    ->middleware('throttle:login')
    ->group(function () {
        Route::post('/login', 'login');
    }
);


Route::middleware('auth:api')->group(function () {

    //Auth routes
    Route::controller(AuthController::class)->group(function () {
        Route::get('/current-user', 'currentUser');
        Route::post('/logout', 'logout');
    });
    
});

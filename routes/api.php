<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\JobTypeController;
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

    //Job type routes
    Route::controller(JobTypeController::class)
        ->prefix('/job-type')
        ->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        }
    );
    
});

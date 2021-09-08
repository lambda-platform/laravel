<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\LambdaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppController::class, 'home']);

Route::prefix(config('lambda.app_url'))
    ->middleware(['jwt'])
    ->group(function ($router) {
        $router->get('/', [LambdaController::class, 'index']);
    });

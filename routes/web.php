<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\LambdaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppController::class, 'index']);

Route::prefix(config('lambda.app'))
    ->middleware(['jwt'])
    ->group(function ($router) {
        $router->get('/', [LambdaController::class, 'index']);
    });

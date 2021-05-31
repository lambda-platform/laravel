<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ListController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index']);
Route::get('/duureg', [PageController::class, 'getDuureg']);
Route::any('/filter', [PageController::class, 'filter']);
Route::any('/sumlist/{aimag}', [PageController::class, 'getSum']);
Route::post('/getoslist', [ListController::class, 'osList']);
Route::post('/getosdetail/{id}', [ListController::class, 'osDetail']);
Route::post('/getplanlist', [ListController::class, 'getPlanList']);
Route::post('/getplandetail/{id}', [ListController::class, 'getPlanDetail']);
Route::post('/getplandownload/{id}', [ListController::class, 'fileDownload']);

Route::prefix(config('lambda.app'))
    ->middleware(['jwt'])
    ->group(function ($router) {
        $router->get('/', [RealStateController::class, 'index']);
    });

<?php

use App\Http\Controllers\RealStateController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\ImportController;
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

Route::prefix('mcud')
    ->middleware(['jwt'])
    ->group(function ($router) {
        $router->get('/', [RealStateController::class, 'index']);
        $router->post('/get_zereglel', [RealStateController::class, 'get_zereglel']);
        $router->post('/get_bairshil_by_hothon', [RealStateController::class, 'get_bairshil_by_hothon']);
        $router->get('getbarilgadetail/{barilgaid}', [RealStateController::class, 'getbarilgadetail']);

        //Import route
        $router->post('barilga/importOS', [ImportController::class, 'importOS'])->name('barilga.importOS');
        $router->post('barilga/importOSReport', [ImportController::class, 'importOSReport'])->name('barilga.importOSReport');
        $router->post('company/import', [ImportController::class, 'importCompany'])->name('company.import');
        $router->post('barilga/importOSObject', [ImportController::class, 'importOSObject'])->name('barilga.importOSObject');
        $router->get('/downloadOSLink', [ImportController::class, 'downloadOSLink']);
        $router->get('/downloadOSSimpleLink', [ImportController::class, 'downloadOSSimpleLink']);
        $router->get('/downloadOSObjectLink', [ImportController::class, 'downloadOSObjectLink']);
        $router->get('/downloadOSReportLink', [ImportController::class, 'downloadOSReportLink']);
        $router->get('/downloadCompanyLink', [ImportController::class, 'downloadCompanyLink']);

        //Map
        $router->post('barilga/map/{schema}', [MapController::class, 'download']);

        //Dashboard
        $router->get('/dashboard/info', [DashboardController::class, 'index']);

        //API
        $router->get('report/aimag', [ApiController::class, 'getAimag']);
        $router->get('report/sum/{id}', [ApiController::class, 'getSum']);
        $router->get('const/{id}', [ApiController::class, 'getConst']);
        $router->post('report/pivot', [ReportController::class, 'pivot']);
        $router->get('report/getSlideInfo', [ApiController::class, 'getSlideInfo']);
        $router->get('report/getSlideInfoByCountry', [ApiController::class, 'getSlideInfoByCountry']);
        $router->get('/api/zereglel', [ApiController::class, 'zereglelTrigger']);
    });

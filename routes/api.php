<?php

use App\Http\Controllers\Partners\ApiPartnersController;
use App\Http\Controllers\Partners\PartnetsSiteController;
use App\Http\Controllers\Staff\AppController;
use App\Http\Controllers\Staff\EnApiAppsController;
use App\Http\Controllers\Staff\EsApiAppsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::domain(partnersUrl())->group( function() {
    Route::get('/partners/site/{code}/countries', [ApiPartnersController::class, 'countries']);
    Route::post('/partners/site/{code}/states',   [ApiPartnersController::class, 'states']);
    Route::get('/partners/site/{code}/services', [ApiPartnersController::class, 'services']);
    Route::post('/partners/site/{code}/procedures',   [ApiPartnersController::class, 'procedures']);
    Route::post('/partners/site/{code}/packages',   [ApiPartnersController::class, 'packages']);
    Route::post('/partners/site/{code}/checkData',   [ApiPartnersController::class, 'checkData']);
    Route::post('/partners/site/{code}/getData',   [ApiPartnersController::class, 'getData']);
    Route::post('/partners/site/{code}/storeData',   [ApiPartnersController::class, 'storeData']);
});

Route::domain(apiUrl())->group( function() {
    /**
     * Api español
     *
     */
    Route::get('aplicacion', [EsApiAppsController::class, 'index']);
    Route::get('aplicacion/countries', [EsApiAppsController::class, 'countries']);
    Route::post('aplicacion/states',   [EsApiAppsController::class, 'states']);
    Route::get('aplicacion/services', [EsApiAppsController::class, 'services']);
    Route::post('aplicacion/procedures',   [EsApiAppsController::class, 'procedures']);
    Route::post('aplicacion/packages',   [EsApiAppsController::class, 'packages']);
    Route::post('aplicacion/checkData',   [EsApiAppsController::class, 'checkData']);
    Route::post('aplicacion/getData',   [EsApiAppsController::class, 'getData']);
    Route::post('aplicacion/storeData',   [EsApiAppsController::class, 'storeData']);

    /**
     * Api ingles
     *
     */
    Route::get('application', [EnApiAppsController::class, 'index']);
    Route::get('application/countries', [EnApiAppsController::class, 'countries']);
    Route::post('application/states',   [EnApiAppsController::class, 'states']);
    Route::get('application/services', [EnApiAppsController::class, 'services']);
    Route::post('application/procedures',   [EnApiAppsController::class, 'procedures']);
    Route::post('application/packages',   [EnApiAppsController::class, 'packages']);
    Route::post('application/checkData',   [EnApiAppsController::class, 'checkData']);
    Route::post('application/getData',   [EnApiAppsController::class, 'getData']);
    Route::post('application/storeData',   [EnApiAppsController::class, 'storeData']);
});



// Route::group(['domain' => ], function () {
//     Route::get('api/v1/', [controller::class, 'method']);
// })

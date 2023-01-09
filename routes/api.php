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
    Route::get('es/aplicacion', [EsApiAppsController::class, 'index']);
    Route::get('es/aplicacion/countries', [EsApiAppsController::class, 'countries']);
    Route::post('es/aplicacion/states',   [EsApiAppsController::class, 'states']);
    Route::get('es/aplicacion/services', [EsApiAppsController::class, 'services']);
    Route::post('es/aplicacion/procedures',   [EsApiAppsController::class, 'procedures']);
    Route::post('es/aplicacion/packages',   [EsApiAppsController::class, 'packages']);
    Route::post('es/aplicacion/checkData',   [EsApiAppsController::class, 'checkData']);
    Route::post('es/aplicacion/getData',   [EsApiAppsController::class, 'getData']);
    Route::post('es/aplicacion/storeData',   [EsApiAppsController::class, 'storeData']);

    /**
     * Api ingles
     *
     */
    Route::get('en/application', [EnApiAppsController::class, 'index']);
    Route::get('en/application/countries', [EnApiAppsController::class, 'countries']);
    Route::post('en/application/states',   [EnApiAppsController::class, 'states']);
    Route::get('en/application/services', [EnApiAppsController::class, 'services']);
    Route::post('en/application/procedures',   [EnApiAppsController::class, 'procedures']);
    Route::post('en/application/packages',   [EnApiAppsController::class, 'packages']);
    Route::post('en/application/checkData',   [EnApiAppsController::class, 'checkData']);
    Route::post('en/application/getData',   [EnApiAppsController::class, 'getData']);
    Route::post('en/application/storeData',   [EnApiAppsController::class, 'storeData']);
});



// Route::group(['domain' => ], function () {
//     Route::get('api/v1/', [controller::class, 'method']);
// })

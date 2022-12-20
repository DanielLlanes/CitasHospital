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
    Route::get('v1/es/{code}', [EsApiAppsController::class, 'index']);
    Route::get('v1/es/{code}/countries', [EsApiAppsController::class, 'countries']);
    Route::post('v1/es/{code}/states',   [EsApiAppsController::class, 'states']);
    Route::get('v1/es/{code}/services', [EsApiAppsController::class, 'services']);
    Route::post('v1/es/{code}/procedures',   [EsApiAppsController::class, 'procedures']);
    Route::post('v1/es/{code}/packages',   [EsApiAppsController::class, 'packages']);
    Route::post('v1/es/{code}/checkData',   [EsApiAppsController::class, 'checkData']);
    Route::post('v1/es/{code}/getData',   [EsApiAppsController::class, 'getData']);
    Route::post('v1/es/{code}/storeData',   [EsApiAppsController::class, 'storeData']);

    /**
     * Api ingles
     *
     */
    Route::get('v1/en/{code}', [EnApiAppsController::class, 'index']);
    Route::get('v1/en/{code}/countries', [EnApiAppsController::class, 'countries']);
    Route::post('v1/en/{code}/states',   [EnApiAppsController::class, 'states']);
    Route::get('v1/en/{code}/services', [EnApiAppsController::class, 'services']);
    Route::post('v1/en/{code}/procedures',   [EnApiAppsController::class, 'procedures']);
    Route::post('v1/en/{code}/packages',   [EnApiAppsController::class, 'packages']);
    Route::post('v1/en/{code}/checkData',   [EnApiAppsController::class, 'checkData']);
    Route::post('v1/en/{code}/getData',   [EnApiAppsController::class, 'getData']);
    Route::post('v1/en/{code}/storeData',   [EnApiAppsController::class, 'storeData']);
});



// Route::group(['domain' => ], function () {
//     Route::get('api/v1/', [controller::class, 'method']);
// })

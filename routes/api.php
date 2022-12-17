<?php

use App\Http\Controllers\Partners\ApiPartnersController;
use App\Http\Controllers\Partners\PartnetsSiteController;
use App\Http\Controllers\Staff\ApiAppsController;
use App\Http\Controllers\Staff\AppController;
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
    Route::get('v1/{code}', [ApiAppsController::class, 'index']);
    Route::get('v1/{code}/countries', [ApiAppsController::class, 'countries']);
    Route::post('v1/{code}/states',   [ApiAppsController::class, 'states']);
    Route::get('v1/{code}/services', [ApiAppsController::class, 'services']);
    Route::post('v1/{code}/procedures',   [ApiAppsController::class, 'procedures']);
    Route::post('v1/{code}/packages',   [ApiAppsController::class, 'packages']);
    Route::post('v1/{code}/checkData',   [ApiAppsController::class, 'checkData']);
    Route::post('v1/{code}/getData',   [ApiAppsController::class, 'getData']);
    Route::post('v1/{code}/storeData',   [ApiAppsController::class, 'storeData']);
});



// Route::group(['domain' => ], function () {
//     Route::get('api/v1/', [controller::class, 'method']);
// })

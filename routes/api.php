<?php

//use App\Http\Controllers\Partners\ApiPartnersController;
use App\Http\Controllers\Partners\EnApiAppsController as EnApiPartners;
use App\Http\Controllers\Partners\EsApiAppsController as EsApiPartners;
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
    Route::get('/partners/es/{code}', [EsApiPartners::class, 'index']);
    Route::get('/partners/es/{code}/countries', [EsApiPartners::class, 'countries']);
    Route::post('/partners/es/{code}/states',   [EsApiPartners::class, 'states']);
    Route::get('/partners/es/{code}/services', [EsApiPartners::class, 'services']);
    Route::post('/partners/es/{code}/procedures',   [EsApiPartners::class, 'procedures']);
    Route::post('/partners/es/{code}/packages',   [EsApiPartners::class, 'packages']);
    Route::post('/partners/es/{code}/checkData',   [EsApiPartners::class, 'checkData']);
    Route::post('/partners/es/{code}/getData',   [EsApiPartners::class, 'getData']);
    Route::post('/partners/es/{code}/storeData',   [EsApiPartners::class, 'storeData']);

    Route::get('/partners/en/{code}', [EnApiPartners::class, 'index']);
    Route::get('/partners/en/{code}/countries', [EnApiPartners::class, 'countries']);
    Route::post('/partners/en/{code}/states',   [EnApiPartners::class, 'states']);
    Route::get('/partners/en/{code}/services', [EnApiPartners::class, 'services']);
    Route::post('/partners/en/{code}/procedures',   [EnApiPartners::class, 'procedures']);
    Route::post('/partners/en/{code}/packages',   [EnApiPartners::class, 'packages']);
    Route::post('/partners/en/{code}/checkData',   [EnApiPartners::class, 'checkData']);
    Route::post('/partners/en/{code}/getData',   [EnApiPartners::class, 'getData']);
    Route::post('/partners/en/{code}/storeData',   [EnApiPartners::class, 'storeData']);
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

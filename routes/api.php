<?php

use App\Http\Controllers\Partners\ApiPartnersController;
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


Route::get('/partners/site/{code}/countries', [ApiPartnersController::class, 'countries']);
Route::post('/partners/site/{code}/states',   [ApiPartnersController::class, 'states']);
Route::get('/partners/site/{code}/services', [ApiPartnersController::class, 'services']);
Route::post('/partners/site/{code}/procedures',   [ApiPartnersController::class, 'procedures']);
Route::post('/partners/site/{code}/packages',   [ApiPartnersController::class, 'packages']);
Route::post('/partners/site/{code}/checkData',   [ApiPartnersController::class, 'checkData']);
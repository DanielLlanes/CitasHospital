<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\ApplicationController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/team/{url?}', [HomeController::class, 'team'])->name('team');
Route::get('/testimonials', [HomeController::class, 'testimonials'])->name('testimonials');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/single/blog', [HomeController::class, 'singlePost'])->name('single-post');
Route::get('/faqs', [HomeController::class, 'faqs'])->name('faqs');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');


Route::post('/applications/nextstep', [ApplicationController::class, 'nextStep'])->name('imagesNextStep');
Route::post('/applications/destroy', [ApplicationController::class, 'destroy'])->name('destroy');


Route::get('/applications/patient-data/{id}', [ApplicationController::class, 'index'])->name('appIndex');
Route::post('/applications/create-patient-data', [ApplicationController::class, 'createPatientData'])->name('createPatientData');
Route::get('/applications/create-services-data', [ApplicationController::class, 'createServicesData'])->name('createServicesData');
Route::post('/applications/post-services-data', [ApplicationController::class, 'postServicesData'])->name('postServicesData');
Route::get('/applications/create-health-data', [ApplicationController::class, 'createHealthData'])->name('createHealthData');
Route::post('/applications/post-health-data', [ApplicationController::class, 'postHealthData'])->name('postHealthData');
Route::post('/applications/delete-session-var-and-delete-app', [ApplicationController::class, 'deleteSessionVarAndDeleteApp'])->name('deleteSessionVarAndDeleteApp');
Route::get('/applications/create-surgical-data', [ApplicationController::class, 'createSurgicalData'])->name('createSurgicalData');
Route::post('/applications/post-surgical-data', [ApplicationController::class, 'postSurgicalData'])->name('postSurgicalData');
Route::get('/applications/create-medical-history-data', [ApplicationController::class, 'createMedicalHistoryData'])->name('createMedicalHistoryData');
Route::post('/applications/post-medical-history-data', [ApplicationController::class, 'postMedicalHistoryData'])->name('postMedicalHistoryData');
Route::get('/applications/create-general-health-data', [ApplicationController::class, 'createGeneralHealthData'])->name('createGeneralHealthData');
Route::post('/applications/post-general-health-data', [ApplicationController::class, 'postGeneralHealthData'])->name('postGeneralHealthData');

Route::get('/applications/create-reference-data', [ApplicationController::class, 'createReferenceData'])->name('createReferenceData');
Route::post('/applications/post-reference-data', [ApplicationController::class, 'postReferenceData'])->name('postReferenceData');

Route::get('/applications/create-gynecological-data', [ApplicationController::class, 'createGynecologicalData'])->name('createGynecologicalData');
Route::post('/applications/post-gynecological-data', [ApplicationController::class, 'postGynecologicalData'])->name('postGynecologicalData');


Route::post('/applications/chek-if-patient-exist', [ApplicationController::class, 'chekIfPatientExist'])->name('chekIfPatientExist');
Route::post('/search-states', [ApplicationController::class, 'getStates'])->name('getStates');

// brands Routes

Route::get('/{brand}', [HomeController::class, 'brand']);


// public profile

route::get('/{profile}', [HomeController::class, 'profile']);

Route::prefix('staff')->group(base_path('routes/staff.php'));

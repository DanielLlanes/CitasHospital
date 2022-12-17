<?php

use App\Http\Controllers\Partners\PartnetsSiteController;
use App\Http\Controllers\Site\ApplicationController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Staff\LangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Staff\AppController;
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


// Route::get('/', [HomeController::class, 'home'])->name('home');
// Route::get('/team/{url?}', [HomeController::class, 'team'])->name('team');
// Route::get('/testimonials/{brand}/{media}', [HomeController::class, 'testimonials'])->name('testimonials');
// Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
// Route::get('/facilities', [HomeController::class, 'facilities'])->name('facilities');
// Route::get('/single/blog', [HomeController::class, 'singlePost'])->name('single-post');
// Route::get('/faqs', [HomeController::class, 'faqs'])->name('faqs');
// Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
// Route::post('/contact-form', [HomeController::class, 'contactForm'])->name('contactForm');


// Route::get('/partners/api/{code}', [PartnetsSiteController::class, 'index']);


// Route::post('/applications/nextstep', [ApplicationController::class, 'nextStep'])->name('imagesNextStep');
// Route::post('/applications/destroy', [ApplicationController::class, 'appImageDestroy'])->name('appImageDestroy');


// Route::get('/applications/patient-data/{id}', [ApplicationController::class, 'index'])->name('appIndex');
// Route::post('/applications/create-patient-data', [ApplicationController::class, 'createPatientData'])->name('createPatientData');
// Route::get('/applications/create-services-data', [ApplicationController::class, 'createServicesData'])->name('createServicesData');
// Route::post('/applications/post-services-data', [ApplicationController::class, 'postServicesData'])->name('postServicesData');
// Route::get('/applications/create-health-data', [ApplicationController::class, 'createHealthData'])->name('createHealthData');
// Route::post('/applications/post-health-data', [ApplicationController::class, 'postHealthData'])->name('postHealthData');
// Route::post('/applications/delete-session-var-and-delete-app', [ApplicationController::class, 'deleteSessionVarAndDeleteApp'])->name('deleteSessionVarAndDeleteApp');
// Route::get('/applications/create-surgical-data', [ApplicationController::class, 'createSurgicalData'])->name('createSurgicalData');
// Route::post('/applications/post-surgical-data', [ApplicationController::class, 'postSurgicalData'])->name('postSurgicalData');
// Route::get('/applications/create-medical-history-data', [ApplicationController::class, 'createMedicalHistoryData'])->name('createMedicalHistoryData');
// Route::post('/applications/post-medical-history-data', [ApplicationController::class, 'postMedicalHistoryData'])->name('postMedicalHistoryData');
// Route::get('/applications/create-general-health-data', [ApplicationController::class, 'createGeneralHealthData'])->name('createGeneralHealthData');
// Route::post('/applications/post-general-health-data', [ApplicationController::class, 'postGeneralHealthData'])->name('postGeneralHealthData');

// Route::get('/applications/create-reference-data', [ApplicationController::class, 'createReferenceData'])->name('createReferenceData');
// Route::post('/applications/post-reference-data', [ApplicationController::class, 'postReferenceData'])->name('postReferenceData');

// Route::get('/applications/create-gynecological-data', [ApplicationController::class, 'createGynecologicalData'])->name('createGynecologicalData');
// Route::post('/applications/post-gynecological-data', [ApplicationController::class, 'postGynecologicalData'])->name('postGynecologicalData');


// Route::post('/applications/chek-if-patient-exist', [ApplicationController::class, 'chekIfPatientExist'])->name('chekIfPatientExist');
// Route::post('/search-states', [ApplicationController::class, 'getStates'])->name('getStates');

// Route::get('language/{lang}', [LangController::class, 'language'])->name('language');

// brands Routes
// 

//Route::get('/{brand}', [HomeController::class, 'brand']);
// Route::get('/testimonial/{brand}/image', [HomeController::class, 'testimonialImage]');
// Route::get('/testimonial/{brand}/video', [HomeController::class, 'testimonialVideo']);


// public profile

//route::get('/{profile}', [HomeController::class, 'profile']);


// Route::domain( staffUrl() )->prefix('staff')->group(function () {
//     Route::get('/', function () {
//         return 'hola';
//     });
// });

Route::domain(staffUrl())->group(base_path('routes/staff.php'));

Route::domain(partnersUrl())->group(base_path('routes/partner.php'));


// Route::domain(apiUrl())->group( function() {
// 	Route::get('/api/v1/{code}', [PartnetsSiteController::class, 'index']);
// });

//Route::get('/partners/api/{code}', [PartnetsSiteController::class, 'index']);


//Route::prefix('partners')->group(base_path('routes/partner.php'));

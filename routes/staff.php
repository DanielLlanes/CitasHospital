<?php


use App\Http\Controllers\Staff\AppController;
use App\Http\Controllers\Staff\LangController;
use App\Http\Controllers\Staff\BrandController;
use App\Http\Controllers\Staff\EventController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Staff\PackageController;
use App\Http\Controllers\Staff\PaymentController;
use App\Http\Controllers\Staff\ProductController;
use App\Http\Controllers\Staff\PatientController;
use App\Http\Controllers\Staff\ProfileController;
use App\Http\Controllers\Staff\ServiceController;
use App\Http\Controllers\Staff\DashboardController;
use App\Http\Controllers\Staff\ProcedureController;
use App\Http\Controllers\Staff\TreatmentController;
use App\Http\Controllers\Site\ApplicationController;
use App\Http\Controllers\Staff\AutocompleteController;
use App\Http\Controllers\Staff\Auth\StaffLoginController;
use App\Http\Controllers\Staff\Auth\StaffRegisterController;
use App\Http\Controllers\Staff\Auth\StaffResetPasswordController;
use App\Http\Controllers\Staff\Auth\StaffForgotPasswordController;

Route::name('staff.')->namespace('Staff')->group(function(){
	Route::namespace('Auth')->group(function(){

	    //Login Routes
	    Route::get('/login', [StaffLoginController::class, 'showLoginForm'])->name('login');
	    Route::post('/login', [StaffLoginController::class, 'login']);
	    Route::post('/logout', [StaffLoginController::class, 'logout'])->name('logout');

	    //Register Routes
	    Route::get('/register', [StaffRegisterController::class, 'showRegistrationForm'])->name('register');
	    Route::post('/register', [StaffRegisterController::class, 'register']);

	    //Forgot Password Routes
	    Route::get('/password/reset', [StaffForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
	    Route::post('/password/email', [StaffForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

	    // Reset Password Routes
	    Route::get('/password/reset/{token}', [StaffResetPasswordController::class, 'showResetForm'])->name('password.reset');
	    Route::post('/password/reset', [StaffResetPasswordController::class, 'reset'])->name('password.update');

	    // Email Verification Route(s)
	    // Route::get('email/verify','VerificationController@show')->name('verification.notice');
	    // Route::get('email/verify/{id}','VerificationController@verify')->name('verification.verify');
	    // Route::get('email/resend','VerificationController@resend')->name('verification.resend');
	});

	Route::get('/dashboard/', [DashboardController::class, 'index'])->name('dashboard');
	Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboards');

    Route::name('autocomplete.')->group(function(){
        Route::post('/search-Staff',        [AutocompleteController::class, 'searchStaff'])->name('AutocompleteStaff');
		Route::post('/search-Patient',      [AutocompleteController::class, 'searchPatient'])->name('AutocompletePatient');
        Route::post('/search-brand',        [AutocompleteController::class, 'searchBrand'])->name('AutocompleteBrand');
        Route::post('/search-service',      [AutocompleteController::class, 'searchService'])->name('AutocompleteService');
        Route::post('/search-procedure',    [AutocompleteController::class, 'searchProcedure'])->name('AutocompleteProcedure');
        Route::post('/search-package',      [AutocompleteController::class, 'searchPackage'])->name('AutocompletePackage');
    });

	Route::name('staff.')->group(function(){
		Route::get('/staff/listar',             [StaffController::class, 'index'])->name('staff');
		Route::get('/staff/get-staff-list',     [StaffController::class, 'getStaffList'])->name('getStaffList');
		Route::get('/staff/add',                [StaffController::class, 'create'])->name('add');
		Route::post('/staff/get-specialty',     [StaffController::class, 'getSpecialty'])->name('getSpecialty');
		Route::post('/staff/get-assignation',     [StaffController::class, 'getAssignation'])->name('getAssignation');
		Route::post('/staff/store',             [StaffController::class, 'store'])->name('store');
		Route::get('/staff/edit/{id}',          [StaffController::class, 'edit'])->name('edit');
		Route::post('/staff/update/{id}',       [StaffController::class, 'update'])->name('update');
		Route::post('/staff/destroy',           [StaffController::class, 'destroy'])->name('destroy');
		Route::post('/staff/activte',           [StaffController::class, 'activate'])->name('activate');
	});
	Route::name('events.')->group(function(){
		Route::get('/events/listar', [EventController::class, 'index'])->name('events');
		Route::post('/event/store', [EventController::class, 'store'])->name('store');
		Route::get('/event/sources', [EventController::class, 'eventSources'])->name('eventSources');
		Route::post('/event/event-drop', [EventController::class, 'eventDrop'])->name('eventDrop');
		Route::post('/enent/update/', [EventController::class, 'update'])->name('editEvent');
		Route::post('/event/destroy', [EventController::class, 'destroy'])->name('destroy');
        Route::get('/event/getApps',    [EventController::class, 'getApps'])->name('getApps');
	});
	Route::name('profile.')->group(function(){
		Route::get('/profile/profile', [ProfileController::class, 'index'])->name('profile');
		Route::post('/profile/change-own-pass', [ProfileController::class, 'changeOwnPassStaff'])->name('changeOwnPassStaff');
	});
	Route::name('lang.')->group(function(){
		Route::get('/lang/change-lang/{lang}', [LangController::class, 'update'])->name('update');
	});

    Route::name('treatments.')->group( function(){
        Route::name('configuration.')->group( function(){
            //brand
            Route::get('/brand/listar', [BrandController::class, 'brand'])->name('brand');
            Route::get('/brand/get-brand-list', [BrandController::class, 'getBrandList'])->name('getBrandList');
            Route::post('/brand/store', [BrandController::class, 'store'])->name('storeBrand');
            Route::post('/brand/activate', [BrandController::class, 'activate'])->name('activateBrand');
            Route::post('/brand/edit', [BrandController::class, 'edit'])->name('editBrand');
            Route::post('/brand/update', [BrandController::class, 'update'])->name('updateBrand');
            Route::post('/brand/destroy', [BrandController::class, 'destroy'])->name('destroyBrand');
            //service
            Route::get('/service/listar', [ServiceController::class, 'service'])->name('service');
            Route::get('/service/get-brand-list', [ServiceController::class, 'getServiceList'])->name('getServiceList');
            Route::post('/service/store', [ServiceController::class, 'store'])->name('storeService');
            Route::post('/service/activate', [ServiceController::class, 'activate'])->name('activateService');
            Route::post('/service/edit', [ServiceController::class, 'edit'])->name('editService');
            Route::post('/service/update', [ServiceController::class, 'update'])->name('updateService');
            Route::post('/service/destroy', [ServiceController::class, 'destroy'])->name('destroyService');
            //procedures
            Route::get('/procedure/listar', [ProcedureController::class, 'procedure'])->name('procedure');
            Route::get('/procedure/get-brand-list', [ProcedureController::class, 'getProcedureList'])->name('getProcedureList');
            Route::post('/procedure/store', [ProcedureController::class, 'store'])->name('storeProcedure');
            Route::post('/procedure/activate', [ProcedureController::class, 'activate'])->name('activateProcedure');
            Route::post('/procedure/edit', [ProcedureController::class, 'edit'])->name('editProcedure');
            Route::post('/procedure/update', [ProcedureController::class, 'update'])->name('updateProcedure');
            Route::post('/procedure/destroy', [ProcedureController::class, 'destroy'])->name('destroyProcedure');
            //packages
            Route::get('/packages/listar', [PackageController::class, 'package'])->name('package');
            Route::get('/packages/get-brand-list', [PackageController::class, 'getPackageList'])->name('getPackageList');
            Route::post('/packages/store', [PackageController::class, 'store'])->name('storePackage');
            Route::post('/packages/activate', [PackageController::class, 'activate'])->name('activatePackage');
            Route::post('/packages/edit', [PackageController::class, 'edit'])->name('editPackage');
            Route::post('/packages/update', [PackageController::class, 'update'])->name('updatePackage');
            Route::post('/packages/destroy', [PackageController::class, 'destroy'])->name('destroyPackage');
        });
        Route::get('/treatments/listar', [TreatmentController::class, 'treatments'])->name('treatments');
        Route::get('/treatments/get-brand-list', [TreatmentController::class, 'getProductList'])->name('getProductList');
        Route::post('/treatments/store', [TreatmentController::class, 'store'])->name('storeProduct');
        Route::post('/treatments/activate', [TreatmentController::class, 'activate'])->name('activateProduct');
        Route::post('/treatments/edit', [TreatmentController::class, 'edit'])->name('editProduct');
        Route::post('/treatments/update', [TreatmentController::class, 'update'])->name('updateProduct');
        Route::post('/treatments/destroy', [TreatmentController::class, 'destroy'])->name('destroyProduct');
    });

    Route::name('applications.')->group( function(){
        Route::get('/applications/listar',      [AppController::class, 'index'])->name('application');
        Route::get('/applications/get-list',    [AppController::class, 'getList'])->name('getList');
        Route::get('/applications/view/{id}',   [AppController::class, 'show'])->name('show');
        Route::get('/applications/patient/patientApss', [AppController::class, 'patientApss'])->name('patientApss');
    });

    Route::name('payments.')->group( function(){
        Route::get('/payments/listar',                  [PaymentController::class, 'index'])->name('payments');
        Route::get('/payments/get-list',                [PaymentController::class, 'getList'])->name('getList');
        Route::get('/payments/view/{id}',               [PaymentController::class, 'show'])->name('show');
        Route::post('/payments/patientApps',            [PaymentController::class, 'patientsApps'])->name('patientsApps');
        Route::post('/payments/searchPatientWithApps',  [PaymentController::class, 'searchPatientWithApps'])->name('searchPatientWithApps');
    });

    Route::name('patients.')->group( function(){
        Route::get('/patient/listar',      [PatientController::class, 'index'])->name('patient');
        Route::get('/patient/get-list',    [PatientController::class, 'getList'])->name('getList');
        Route::get('/patient/view/{id}',   [PatientController::class, 'show'])->name('show');
        Route::get('/patient/add',         [PatientController::class, 'create'])->name('add');
        Route::post('/patient/store',      [PatientController::class, 'store'])->name('store');
		Route::get('/patient/edit/{id}',   [PatientController::class, 'edit'])->name('edit');
		Route::post('/patient/update/{id}',[PatientController::class, 'update'])->name('update');
		Route::post('/patient/destroy',    [PatientController::class, 'destroy'])->name('destroy');
    });

});


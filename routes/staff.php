<?php




use App\Http\Controllers\Staff\Auth\StaffForgotPasswordController;
use App\Http\Controllers\Staff\Auth\StaffLoginController;
use App\Http\Controllers\Staff\Auth\StaffRegisterController;
use App\Http\Controllers\Staff\Auth\StaffResetPasswordController;
use App\Http\Controllers\Staff\DashboardController;
use App\Http\Controllers\Staff\EventController;
use App\Http\Controllers\Staff\StaffController;

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
	    // Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
	    // Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	    Route::get('/password/reset', [StaffForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
	    Route::post('/password/email', [StaffForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

	    // Reset Password Routes
	    Route::get('/password/reset/{token}', [StaffResetPasswordController::class, 'showResetForm'])->name('password.reset');
	    Route::post('/password/reset', [StaffResetPasswordController::class, 'reset'])->name('password.update');

	    // // Email Verification Route(s)
	    // Route::get('email/verify','VerificationController@show')->name('verification.notice');
	    // Route::get('email/verify/{id}','VerificationController@verify')->name('verification.verify');
	    // Route::get('email/resend','VerificationController@resend')->name('verification.resend');
	});

	Route::get('/dashboard/', [DashboardController::class, 'index'])->name('dashboard');
	Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboards');

	Route::name('staff.')->group(function(){
		Route::get('/staff/listar', [StaffController::class, 'index'])->name('staff');
		Route::get('/staff/get-staff-list', [StaffController::class, 'getStaffList'])->name('getStaffList');
		Route::get('/staff/add', [StaffController::class, 'create'])->name('add');
		Route::post('/staff/get-specialty', [StaffController::class, 'getSpecialty'])->name('getSpecialty');
		Route::post('/staff/store', [StaffController::class, 'store'])->name('store');
		Route::get('/staff/edit/{id}', [StaffController::class, 'edit'])->name('edit');
		Route::post('/staff/update/{id}', [StaffController::class, 'update'])->name('update');
		Route::post('/staff/destroy', [StaffController::class, 'destroy'])->name('destroy');
		Route::post('/staff/activte', [StaffController::class, 'activate'])->name('activate');
	});
	Route::name('events.')->group(function(){
		Route::get('/events/listar', [EventController::class, 'index'])->name('events');
		Route::post('/events/busquedaStaff', [EventController::class, 'busquedaStaff'])->name('busquedaStaff');
		Route::post('/events/busquedaPatient', [EventController::class, 'busquedaPatient'])->name('busquedaPatient');
		Route::post('/event/store', [EventController::class, 'store'])->name('store');
		Route::get('/event/sources', [EventController::class, 'eventSources'])->name('eventSources');
		Route::post('/event/event-drop', [EventController::class, 'eventDrop'])->name('eventDrop');
		Route::post('/staff/update/', [EventController::class, 'update'])->name('editEvent');

		// Route::get('/staff/get-staff-list', [StaffController::class, 'getStaffList'])->name('getStaffList');
		// Route::get('/staff/add', [StaffController::class, 'create'])->name('add');
		// Route::post('/staff/get-specialty', [StaffController::class, 'getSpecialty'])->name('getSpecialty');
		// Route::post('/staff/destroy', [StaffController::class, 'destroy'])->name('destroy');
		// Route::post('/staff/activte', [StaffController::class, 'activate'])->name('activate');
	});
});
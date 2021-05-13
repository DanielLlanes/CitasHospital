<?php



use App\Http\Controllers\Staff\Auth\StaffLoginController;
use App\Http\Controllers\Staff\Auth\StaffRegisterController;
use App\Http\Controllers\Staff\DashboardController;
Route::name('staff.')->namespace('Staff')->group(function(){
	Route::namespace('Auth')->group(function(){

	    //Login Routes
	    Route::get('/login', [StaffLoginController::class, 'showLoginForm'])->name('login');
	    Route::post('/login', [StaffLoginController::class, 'login']);

	    // Route::post('/logout','LoginController@logout')->name('logout');

	    //Register Routes
	    Route::get('/register', [StaffRegisterController::class, 'showRegistrationForm'])->name('register');
	    Route::post('/register', [StaffRegisterController::class, 'register']);

	    // //Forgot Password Routes
	    // Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
	    // Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');

	    // //Reset Password Routes
	    // Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
	    // Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');

	    // // Email Verification Route(s)
	    // Route::get('email/verify','VerificationController@show')->name('verification.notice');
	    // Route::get('email/verify/{id}','VerificationController@verify')->name('verification.verify');
	    // Route::get('email/resend','VerificationController@resend')->name('verification.resend');
	});

	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
	Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboards');
});
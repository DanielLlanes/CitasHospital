<?php 

use App\Http\Controllers\Partners\PartnersController;
use App\Http\Controllers\Partner\Auth\PartnerForgotPasswordController;
use App\Http\Controllers\Partner\Auth\PartnerRegisterController;
use App\Http\Controllers\Partner\Auth\PartnerResetPasswordController;
use App\Http\Controllers\Partners\Auth\PartnerLoginController;
use App\Http\Controllers\Partners\DashController;
use App\Http\Controllers\Partners\PartnetsSiteController;



Route::name('partners.')->namespace('Partners')->group(function(){

		Route::namespace('Auth')->group(function(){

		    //Login Routes
		    Route::get('/login', [PartnerLoginController::class, 'showLoginForm'])->name('login');
		    Route::post('/login', [PartnerLoginController::class, 'login']);
		    Route::post('/logout', [PartnerLoginController::class, 'logout'])->name('logout');

		   

		    // //Forgot Password Routes
		    // Route::get('/password/reset', [PartnerForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
		    // Route::post('/password/email', [PartnerForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

		    // Reset Password Routes
		    // Route::get('/password/reset/{token}', [PartnerResetPasswordController::class, 'showResetForm'])->name('password.reset');
		    // Route::post('/password/reset', [PartnerResetPasswordController::class, 'reset'])->name('password.update');

		    // Email Verification Route(s)
		    // Route::get('email/verify','VerificationController@show')->name('verification.notice');
		    // Route::get('email/verify/{id}','VerificationController@verify')->name('verification.verify');
		    // Route::get('email/resend','VerificationController@resend')->name('verification.resend');

	       
		});

	Route::get('/dashboard/', [DashController::class, 'index'])->name('dashboard');
	Route::get('/partners/', [DashController::class, 'dashboard'])->name('dashboards');
	
	Route::get('/partners/site/{code}/{brand}', [DashController::class, 'dashboard'])->name('showPartners');

	

});
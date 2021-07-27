<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\HomeController;
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
Route::get('/team', [HomeController::class, 'team'])->name('team');
Route::get('/testimonials', [HomeController::class, 'testimonials'])->name('testimonials');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/single/blog', [HomeController::class, 'singlePost'])->name('single-post');
Route::get('/faqs', [HomeController::class, 'faqs'])->name('faqs');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');



Route::prefix('staff')->group(base_path('routes/staff.php'));

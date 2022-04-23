<?php

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\newsController;
use App\Http\Controllers\pageController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\welcomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', welcomeController::class);
Route::get('halaman/rencana-strategis', pageController::class);
Route::get('halaman/perjanjian-kerja', pageController::class);
Route::get('halaman/{slug}', pageController::class);
Route::get('berita', [newsController::class, 'index']);
Route::get('berita/{slug}', [newsController::class, 'show']);
Route::get('kategori/{slug}', [newsController::class, 'index']);
Route::get('galeri', [GalleryController::class, 'index']);
Route::get('galeri/{slug}', [GalleryController::class, 'show']);

Route::get('masuk', LoginController::class)->name('login');
Route::get('aktivasi', [LoginController::class, 'aktivasi']);

Route::get('pendaftaran/resend', [RegistrationController::class, 'resend']);
Route::post('pendaftaran/resend', [RegistrationController::class, 'resend_prosess']);

Route::get('pendaftaran/{slug}', RegistrationController::class);
Route::post('pendaftaran/{slug}', [RegistrationController::class, 'create'])->name('recruitment.registration.prosess');

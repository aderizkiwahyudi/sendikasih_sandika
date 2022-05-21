<?php

use App\Http\Controllers\AcademicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\Ckeditor;
use App\Http\Controllers\DataController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\newsController;
use App\Http\Controllers\pageController;
use App\Http\Controllers\RecruitmentController;
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
Route::post('masuk', [LoginController::class, 'prosess'])->name('login.prosess');
Route::get('aktivasi', [LoginController::class, 'aktivasi']);

Route::get('reset-password', [LoginController::class, 'reset_password'])->name('reset_password');
Route::post('reset-password', [LoginController::class, 'reset_password_prosess'])->name('reset_password.prosess');

Route::get('reset-password-user', [LoginController::class, 'set_new_password'])->name('set_new_password');
Route::post('reset-password-user', [LoginController::class, 'set_new_password_prosess'])->name('set_new_password.proses');

Route::get('pendaftaran/resend', [RegistrationController::class, 'resend'])->name('recruitment.email.resend');
Route::post('pendaftaran/resend', [RegistrationController::class, 'resend_prosess']);

Route::get('pendaftaran/{slug}', RegistrationController::class);
Route::post('pendaftaran/{slug}', [RegistrationController::class, 'create'])->name('recruitment.registration.prosess');

Route::prefix('penerimaan')->group(function(){
    Route::middleware('auth:recruitment')->group(function(){
        Route::get('/', [RecruitmentController::class, 'index'])->name('recruitment.dashboard');    
        Route::post('/', [RecruitmentController::class, 'bidota_prosess'])->name('recruitment.biodata.prosess');    
        
        Route::get('/photo', [RecruitmentController::class, 'photo'])->name('recruitment.photo');
        Route::post('/photo', [RecruitmentController::class, 'photo_prosess'])->name('recruitment.photo.prosess');

        Route::get('/konfirmasi', [RecruitmentController::class, 'confirmation'])->name('recruitment.confirmation');
        Route::get('/konfirmasi/prosess', [RecruitmentController::class, 'confirmation_prosess'])->name('recruitment.confirmation.prosess');

        Route::get('/selesai', [RecruitmentController::class, 'finish'])->name('recruitment.finish');
            
        Route::get('/print', [RecruitmentController::class, 'print'])->name('recruitment.print');

        Route::get('/setting', [RecruitmentController::class, 'setting'])->name('recruitment.setting');    
        Route::post('/setting', [RecruitmentController::class, 'setting_prosess'])->name('recruitment.setting');    
        
        Route::get('/logout', [RecruitmentController::class, 'logout'])->name('recruitment.logout');    
    });
});

Route::prefix('akademik')->group(function(){
    Route::middleware('auth:academic')->group(function(){
        Route::get('/', [AcademicController::class, 'index'])->name('academic.dashboard');    
        Route::get('/data-pribadi', [AcademicController::class, 'personal'])->name('academic.personal');    
        Route::get('/keuangan-pribadi', [AcademicController::class, 'finance'])->name('academic.finance');    
        Route::post('/keuangan-pribadi', [AcademicController::class, 'finance_filter'])->name('academic.finance');    
        Route::get('/pengaturan', [AcademicController::class, 'setting'])->name('academic.setting');    
        Route::post('/pengaturan', [AcademicController::class, 'setting_prosess'])->name('academic.setting');    
        Route::get('/logout', [AcademicController::class, 'logout'])->name('academic.logout');    
    });
});

Route::prefix('administrator')->group(function(){
    Route::get('/', AdminLoginController::class)->name('admin.login');
    Route::post('/', [AdminLoginController::class, 'prosess'])->name('admin.login.prosess');
    Route::middleware('auth:admin')->group(function(){
        Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        
        Route::get('berita', [AdminController::class, 'news'])->name('admin.news');
        Route::get('berita/delete/{id}', [AdminController::class, 'news_delete'])->name('admin.news.delete');
        
        Route::get('berita/tambah', [AdminController::class, 'news_add'])->name('admin.news.add');
        Route::post('berita/tambah', [AdminController::class, 'news_prosess'])->name('admin.news.add.prosess');

        Route::get('berita/edit/{id}', [AdminController::class, 'news_edit'])->name('admin.news.edit');
        Route::post('berita/edit/{id}', [AdminController::class, 'news_prosess'])->name('admin.news.edit.prosess');

        Route::get('kategori', [AdminController::class, 'category'])->name('admin.category');
        Route::post('kategori', [AdminController::class, 'category_proses'])->name('admin.category.add.prosess');
        Route::post('kategori/edit/{id}', [AdminController::class, 'category_proses'])->name('admin.category.edit.prosess');
        Route::get('kategori/delete/{id}', [AdminController::class, 'category_delete'])->name('admin.category.delete');
        
        Route::get('halaman/{slug}', [AdminController::class, 'pages'])->name('admin.pages');
        Route::post('halaman/{slug}', [AdminController::class, 'pages_prosess'])->name('admin.pages');
        
        Route::post('halaman/{slug}/add', [AdminController::class, 'page_file_prosess'])->name('admin.pages.file.add');
        Route::post('halaman/{slug}/edit/{id}', [AdminController::class, 'page_file_prosess'])->name('admin.pages.file.edit');
        Route::get('halaman/{slug}/delete/{id}', [AdminController::class, 'page_file_delete'])->name('admin.pages.file.delete');
        
        Route::post('struktur/add', [AdminController::class, 'strtuctures_prosess'])->name('admin.structures.add');
        Route::post('struktur/edit/{id}', [AdminController::class, 'strtuctures_prosess'])->name('admin.structures.edit');
        Route::get('struktur/delete/{id}', [AdminController::class, 'structure_delete'])->name('admin.structures.delete');

        Route::get('struktur/item/{id}', [AdminController::class, 'structures_item'])->name('admin.structures.item');
        Route::post('struktur/item/add/{id}', [AdminController::class, 'structures_item_prosess'])->name('admin.structures.item.add');
        Route::post('struktur/item/edit/{id}', [AdminController::class, 'structures_item_prosess'])->name('admin.structures.item.edit');
        Route::get('struktur/item/delete/{id}', [AdminController::class, 'structures_item_delete'])->name('admin.structures.item.delete');

        Route::get('gallery', [AdminController::class, 'gallery'])->name('admin.gallery');
        Route::get('gallery/add', [AdminController::class, 'gallery_editor'])->name('admin.gallery.add');
        Route::post('gallery/add', [AdminController::class, 'gallery_prosess'])->name('admin.gallery.add.prosess');
        Route::get('gallery/edit/{id}', [AdminController::class, 'gallery_editor'])->name('admin.gallery.edit');
        Route::post('gallery/edit/{id}', [AdminController::class, 'gallery_prosess'])->name('admin.gallery.edit.prosess');
        Route::get('gallery/delete/{id}', [AdminController::class, 'gallery_delete'])->name('admin.gallery.delete');
        Route::get('gallery/delete/item/{id}', [AdminController::class, 'gallery_delete'])->name('admin.gallery.item.delete');

        Route::get('user/{role}/{unit}', [AdminController::class, 'users_academic'])->name('admin.users.academic');
        Route::get('user/{role}/{unit}/add', [AdminController::class, 'users_academic_add'])->name('admin.users.academic.add');
        Route::post('user/{role}/{unit}/add', [AdminController::class, 'users_academic_prosess'])->name('admin.users.academic.add.prosess');
        Route::get('user/{role}/{id}/{page}', [AdminController::class, 'users_academic_detail'])->name('admin.users.academic.detail');
        Route::get('user/{role}/{id}/edit/{unit_id}', [AdminController::class, 'users_academic_edit'])->name('admin.users.academic.edit');
        Route::post('user/{role}/{id}/edit/{unit_id}', [AdminController::class, 'users_academic_prosess'])->name('admin.users.academic.edit.prosess');
        Route::get('user/{role}/{id}/delete', [AdminController::class, 'users_academic_delete'])->name('admin.users.academic.delete');

        Route::get('ubah-status-user/{id}', [AdminController::class, 'users_academic_change_status'])->name('admin.users.academic.change.status');

        Route::get('kelas/{unit}', [AdminController::class, 'classroom'])->name('admin.class');
        Route::post('kelas/{unit}/add', [AdminController::class, 'classroom_proses'])->name('admin.class.add');
        Route::post('kelas/{unit}/edit/{id}', [AdminController::class, 'classroom_proses'])->name('admin.class.edit');
        Route::get('kelas/{unit}/delete/{id}', [AdminController::class, 'classroom_delete'])->name('admin.class.delete');

        Route::get('tahun-akademik', [AdminController::class, 'year'])->name('admin.year');
        Route::post('tahun-akademik/add', [AdminController::class, 'year_prosess'])->name('admin.year.add');
        Route::post('tahun-akademik/edit/{id}', [AdminController::class, 'year_prosess'])->name('admin.year.edit');
        Route::get('tahun-akademik/delete/{id}', [AdminController::class, 'year_delete'])->name('admin.year.delete');

        Route::get('pendaftaran/pengaturan', [AdminController::class, 'recruitment_setting'])->name('admin.recruitment.setting');
        Route::post('pendaftaran/pengaturan', [AdminController::class, 'recruitment_setting_prosess'])->name('admin.recruitment.setting.prosess');
        Route::get('pendaftaran/reset', [AdminController::class, 'recruitment_reset'])->name('admin.recruitment.reset');
        Route::get('pendaftaran/{role}', [AdminController::class, 'recruitment'])->name('admin.recruitment');
        Route::get('pendaftaran/{role}/detail/{id}', [AdminController::class, 'recruitment_detail'])->name('admin.recruitment.detail');
        Route::post('pendaftaran/{role}/detail/{id}', [AdminController::class, 'recruitment_prosess'])->name('admin.recruitment.prosess');

        #Menambahkan Pembayaran ke Siswa
        Route::get('biaya/pembayaran/delete/{id}', [AdminController::class, 'contribution_payment_delete'])->name('admin.contribution.payment.delete');
        Route::post('biaya/pembayaran/edit/{id}', [AdminController::class, 'contribution_payment_edit'])->name('admin.contribution.payment.edit');
        Route::get('biaya/pembayaran/{id}', [AdminController::class, 'contribution_payment'])->name('admin.contribution.payment');
        Route::post('biaya/pembayaran/{id}', [AdminController::class, 'contribution_payment_prosess'])->name('admin.contribution.payment.prosess');
        
        Route::get('biaya/{id}', [AdminController::class, 'contribution'])->name('admin.contribution');
        Route::post('biaya/{id}', [AdminController::class, 'contribution_prosess'])->name('admin.contribution.prosess');
        Route::post('biaya/{id}/filter', [AdminController::class, 'contribution_filter'])->name('admin.contribution.filter');
        Route::post('biaya/{id}/{item_id}', [AdminController::class, 'contribution_prosess'])->name('admin.contribution.edit');
        Route::get('biaya/{id}/delete', [AdminController::class, 'contribution_delete'])->name('admin.contribution.delete');

        // Route::get('pembayaran', [AdminController::class, 'payment_contribution'])->name('admin.payment');

        Route::get('website/setting', [AdminController::class, 'website_setting'])->name('admin.website.setting');
        Route::post('website/setting', [AdminController::class, 'website_setting_prosess'])->name('admin.website.setting.proses');
        
        Route::get('slides', [AdminController::class, 'website_slide'])->name('admin.website.slide');
        Route::get('slides/add', [AdminController::class, 'website_slide_add'])->name('admin.website.slide.add');
        Route::get('slides/edit/{id}', [AdminController::class, 'website_slide_edit'])->name('admin.website.slide.edit');
        Route::get('slides/delete/{id}', [AdminController::class, 'website_slide_delete'])->name('admin.website.slide.delete');
        
        Route::post('slides/add', [AdminController::class, 'website_slide_prosess'])->name('admin.website.slide.add.proses');
        Route::post('slides/edit/{id}', [AdminController::class, 'website_slide_prosess'])->name('admin.website.slide.edit');
        
        Route::get('pengaturan', [AdminController::class, 'setting'])->name('admin.setting');
        Route::post('pengaturan', [AdminController::class, 'setting_prosess'])->name('admin.setting');

        Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');
        
        #GET DATA TO DATATABLES
        Route::get('data/berita', [DataController::class, 'news'])->name('admin.news.data');
        Route::get('data/kategori', [DataController::class, 'category'])->name('admin.category.data');
        Route::get('data/page/files/{slug}', [DataController::class, 'page_rspk'])->name('admin.page.file.data');
        Route::get('data/struktur', [DataController::class, 'structures'])->name('admin.structures.data');
        Route::get('data/struktur/item/{id}', [DataController::class, 'structures_item'])->name('admin.structures.item.data');
        Route::get('data/galleries', [DataController::class, 'galleries'])->name('admin.galleries.data');
        Route::get('data/user/{role}/{unit}', [DataController::class, 'users_academic'])->name('admin.users.academic.data');
        Route::get('data/kelas/{unit}', [DataController::class, 'classroom'])->name('admin.classroom.data');
        Route::get('data/year', [DataController::class, 'year'])->name('admin.year.data');
        Route::get('data/recruitment', [DataController::class, 'recruitment'])->name('admin.recruitment.data');
        Route::get('data/contribution/payment/{id}', [DataController::class, 'contribution_payment'])->name('admin.data.student.payment.contribution');
        Route::get('data/contribution/{id}', [DataController::class, 'contribution'])->name('admin.contribution.data');

        Route::get('data/user_search/active', [DataController::class, 'users_active'])->name('admin.users.search.active.data');

        Route::get('data/slides', [DataController::class, 'slides'])->name('admin.slides');

        #CKEDITOR
        Route::post('ckeditor/upload/image', Ckeditor::class);
    });
});
<?php


use App\Http\Controllers\backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\frontend\IndexController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::group(['prefix'=> 'admin'], function(){
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('admin.dashboard');

Route::controller(AdminProfileController::class)->group(function () {
    Route::get('/logout',  'destroy')->name('admin.logout');

    Route::group(['prefix'=> 'admin'], function() {
        Route::get('/profile',  'AdminProfile')->name('admin.profile');
        Route::get('/profile/edit',  'AdminProfileEdit')->name('admin.profileEdit');
        Route::post('/profile/store',  'AdminProfileStore')->name('admin.profileStore');
        Route::get('/change/password', 'AdminChangePassword')->name('admin.changePassword');
        Route::post('/update/change/password',  'AdminUpdateChangePassword')->name('update.changePassword');
    });
});

Route::controller(BrandController::class)->prefix('brand')->group( function () {
    Route::get('/view', 'BrandView')->name('all.brand');
    Route::post('/store','BrandStore')->name('brand.store');
    Route::get('/edit/{id}', 'BrandEdit')->name('brand.edit');
    Route::post('/update', 'BrandUpdate')->name('brand.update');
    Route::get('/delete/{id}', 'BrandDelete')->name('brand.delete');
});

Route::controller(CategoryController::class)->prefix('category')->group( function() {
    Route::get('/view', 'CategoryView')->name('all.category');
    Route::post('/store', 'CategoryStore')->name('category.store');
    Route::get('/edit/{id}', 'CategoryEdit')->name('category.edit');
    Route::post('/update', 'CategoryUpdate')->name('category.update');
    Route::get('/delete/{id}', 'CategoryDelete')->name('category.delete');
});

























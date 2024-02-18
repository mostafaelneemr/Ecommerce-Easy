<?php

use App\Http\Controllers\backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubSubCategoryController;
use App\Http\Controllers\frontend\IndexController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\frontend\LanguageController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:admin'])->group(function() {

    Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('admin.dashboard')->middleware('auth:admin');

    Route::controller(AdminProfileController::class)->prefix('admin')->group(function(){
        Route::get('/profile','AdminProfile')->name('admin.profile');
        Route::get('/profile/edit', 'AdminProfileEdit')->name('admin.profileEdit');
        Route::post('/profile/store', 'AdminProfileStore')->name('admin.profileStore');
        Route::get('/change/password', 'AdminChangePassword')->name('admin.changePassword');
        Route::post('/update/change/password', 'AdminUpdateChangePassword')->name('update.changePassword');
        Route::get('/logout', 'destroy')->name('admin.logout');
    });

});


Route::controller(BrandController::class)->prefix('brand')->group(function () {
    Route::get('/view', 'BrandView')->name('all.brand');
    Route::post('/store', 'BrandStore')->name('brand.store');
    Route::get('/edit/{id}', 'BrandEdit')->name('brand.edit');
    Route::post('/update', 'BrandUpdate')->name('brand.update');
    Route::get('/delete/{id}', 'BrandDelete')->name('brand.delete');
});

Route::group(['prefix' => 'category'], function() {
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/view', 'CategoryView')->name('all.category');
        Route::post('/store', 'CategoryStore')->name('category.store');
        Route::get('/edit/{id}', 'CategoryEdit')->name('category.edit');
        Route::post('/update', 'CategoryUpdate')->name('category.update');
        Route::get('/delete/{id}', 'CategoryDelete')->name('category.delete');
    });

    Route::group(['prefix' => 'sub'], function() {
        Route::controller(SubCategoryController::class)->group(function () {
            Route::get('/view','SubCategoryView')->name('all.sub.category');
            Route::post('/store', 'SubCategoryStore')->name('subcategory.store');
            Route::get('/edit/{id}', 'SubCategoryEdit')->name('subcategory.edit');
            Route::post('/update', 'SubCategoryUpdate')->name('subcategory.update');
            Route::get('/delete/{id}', 'SubCategoryDelete')->name('subcategory.delete');
        });

        Route::controller(SubSubCategoryController::class)->prefix('sub')->group(function () {
            Route::get('/view', 'SubSubCategoryView')->name('all.sub.subcategory');
            Route::get('/category/{category_id}', 'GetSubCategory');
            Route::get('/subcategory/{subcategory_id}', 'GetSubSubCategory');
            Route::post('/store','SubSubCategoryStore')->name('sub.subcategory.store');
            Route::get('/edit/{id}', 'SubSubCategoryEdit')->name('sub.subcategory.edit');
            Route::post('/update', 'SubSubCategoryUpdate')->name('sub.subcategory.update');
            Route::get('/delete/{id}', 'SubSubCategoryDelete')->name('sub.subcategory.delete');
        });
    });

});

Route::controller(ProductController::class)->prefix('product')->group(function () {
    Route::get('/add',  'AddProduct')->name('add.product');
    Route::post('/store',  'StoreProduct')->name('store.product');
    Route::get('/manage',  'ManageProduct')->name('manage.product');
    Route::get('/edit/{id}',  'EditProduct')->name('edit.product');
    Route::post('/update',  'UpdateProduct')->name('update.product');
    Route::post('/image/update',  'MultiImgUpdate')->name('update.product.img');
    Route::post('/thumbnail/update',  'ThumbnailImgUpdate')->name('update.product.thumbnail');
    Route::get('/multiimg/delete/{id}',  'MultiImgDelete')->name('product.multiimg.delete');
    Route::get('/delete/{id}',  'DeleteProduct')->name('delete.product');
    Route::get('/inactive/{id}',  'InactiveProduct')->name('inactive.product');
    Route::get('/active{id}',  'ActiveProduct')->name('active.product');
});

Route::controller(SliderController::class)->prefix('slider')->group(function () {
    Route::get('/view',  'SliderView')->name('manage.slider');
    Route::post('/store', 'SliderStore')->name('slider.store');
    Route::get('/edit/{id}',  'SliderEdit')->name('slider.edit');
    Route::post('/update',  'SliderUpdate')->name('slider.update');
    Route::get('/delete/{id}',  'SliderDelete')->name('slider.delete');
    Route::get('/inactive/{id}', 'InactiveSlider')->name('inactive.slider');
    Route::get('/active{id}',  'ActiveSlider')->name('active.slider');
});

Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $user = User::find(Auth::id());
    return view('dashboard', compact('user'));
})->name('dashboard');

/// Multi Language All Routes ////
Route::get('/language/arabic', [LanguageController::class, 'Arabic'])->name('arabic.language');
Route::get('/language/english', [LanguageController::class, 'English'])->name('english.language');


Route::get('/', [IndexController::class, 'index']);
Route::controller(IndexController::class)->prefix('user')->group(function () {
    Route::get('/logout','UserLogout')->name('user.logout');
    Route::get('/profile', 'UserProfile')->name('user.profile');
    Route::post('/profile/store', 'UserProfileStore')->name('user.profile.store');
    Route::get('/change/password', 'UserChangePassword')->name('change.password');
    Route::post('/password/update', 'UserPasswordUpdate')->name('user.password.update');
});


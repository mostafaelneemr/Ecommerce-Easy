<?php

use App\Http\Controllers\backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubSubCategoryController;
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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('admin.dashboard');

Route::group(['prefix'=> 'admin'], function(){
    Route::get('/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile');
    Route::get('/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profileEdit');
    Route::post('/profile/store', [AdminProfileController::class, 'AdminProfileStore'])->name('admin.profileStore');
    Route::get('/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin.changePassword');
    Route::post('/update/change/password', [AdminProfileController::class, 'AdminUpdateChangePassword'])->name('update.changePassword');
    Route::get('/logout', [AdminProfileController::class, 'destroy'])->name('admin.logout');
});

Route::group(['prefix' => 'brand'], function () {
    Route::get('/view', [BrandController::class, 'BrandView'])->name('all.brand');
    Route::post('/store', [BrandController::class, 'BrandStore'])->name('brand.store');
    Route::get('/edit/{id}', [BrandController::class, 'BrandEdit'])->name('brand.edit');
    Route::post('/update', [BrandController::class, 'BrandUpdate'])->name('brand.update');
    Route::get('/delete/{id}', [BrandController::class, 'BrandDelete'])->name('brand.delete');
});

Route::group(['prefix' => 'category'], function() {
    Route::get('/view', [CategoryController::class, 'CategoryView'])->name('all.category');
    Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');
    Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');
    Route::post('/update', [CategoryController::class, 'CategoryUpdate'])->name('category.update');
    Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');

    Route::group(['prefix' => 'sub'], function() {
        Route::get('/view', [SubCategoryController::class, 'SubCategoryView'])->name('all.sub.category');
        Route::post('/store', [SubCategoryController::class, 'SubCategoryStore'])->name('subcategory.store');
        Route::get('/edit/{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('subcategory.edit');
        Route::post('/update', [SubCategoryController::class, 'SubCategoryUpdate'])->name('subcategory.update');
        Route::get('/delete/{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('subcategory.delete');

        Route::group(['prefix' => 'sub'], function () {
            Route::get('/view', [SubSubCategoryController::class, 'SubSubCategoryView'])->name('all.sub.subcategory');
            Route::get('/category/{category_id}', [SubSubCategoryController::class, 'GetSubCategory']);
            Route::get('/subcategory/{subcategory_id}', [SubSubCategoryController::class, 'GetSubSubCategory']);
            Route::post('/store', [SubSubCategoryController::class, 'SubSubCategoryStore'])->name('sub.subcategory.store');
            Route::get('/edit/{id}', [SubSubCategoryController::class, 'SubSubCategoryEdit'])->name('sub.subcategory.edit');
            Route::post('/update', [SubSubCategoryController::class, 'SubSubCategoryUpdate'])->name('sub.subcategory.update');
            Route::get('/delete/{id}', [SubSubCategoryController::class, 'SubSubCategoryDelete'])->name('sub.subcategory.delete');
        });
    });

});

Route::group(['prefix' => 'product'], function () {
    Route::get('/add', [ProductController::class, 'AddProduct'])->name('add.product');
    Route::post('/store', [ProductController::class, 'StoreProduct'])->name('store.product');
    Route::get('/manage', [ProductController::class, 'ManageProduct'])->name('manage.product');
    Route::get('/edit/{id}', [ProductController::class, 'EditProduct'])->name('edit.product');
    Route::post('/update', [ProductController::class, 'UpdateProduct'])->name('update.product');
    Route::get('/delete', [ProductController::class, 'DeleteProduct'])->name('delete.product');
});







Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $user = User::find(Auth::id());
    return view('dashboard', compact('user'));
})->name('dashboard');

    Route::get('/', [IndexController::class, 'index']);
Route::group(['prefix' => 'user'], function () {
    Route::get('/logout', [IndexController::class, 'UserLogout'])->name('user.logout');
    Route::get('/profile', [IndexController::class, 'UserProfile'])->name('user.profile');
    Route::post('/profile/store', [IndexController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::get('/change/password', [IndexController::class, 'UserChangePassword'])->name('change.password');
    Route::post('/password/update', [IndexController::class, 'UserPasswordUpdate'])->name('user.password.update');
});


<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminPageController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth'])->name('admin');
require __DIR__.'/auth.php';

Route::middleware('auth')->group(function(){
    // ===================================== USER ====================================
    Route::GET('admin/user/list', [AdminUserController::class, 'list'])->name('user.list');

    Route::GET('admin/user/add', [AdminUserController::class, 'add'])->name('user.add');
    Route::POST('admin/user/store', [AdminUserController::class, 'store'])->name('user.store');

    Route::GET('admin/user/delete/{id}', [AdminUserController::class, 'delete'])->name('user.delete');

    Route::POST('admin/user/action', [AdminUserController::class, 'action'])->name('user.action');

    Route::GET('admin/user/edit/{id}', [AdminUserController::class, 'edit'])->name('user.edit');
    Route::POST('admin/user/update/{id}', [AdminUserController::class, 'update'])->name('user.update');

    Route::GET('admin/user/changeStatus', [AdminUserController::class, 'change_status'])->name('user.change_status');

    // profile
    Route::GET('admin/user/profile', [AdminUserController::class, 'profile'])->name('user.profile');
    Route::POST('admin/user/changePassword', [AdminUserController::class, 'changePassword'])->name('user.change_password');
    Route::POST('admin/user/updateProfile', [AdminUserController::class, 'updateProfile'])->name('user.update_profile');

    // ===================================== PAGE ====================================
    Route::GET('admin/page/list', [AdminPageController::class, 'list'])->name('page.list');
    Route::GET('admin/page/add', [AdminPageController::class, 'add'])->name('page.add');
    Route::POST('admin/page/store', [AdminPageController::class, 'store'])->name('page.store');
    Route::GET('admin/page/edit/{id}', [AdminPageController::class, 'edit'])->name('page.edit');
    Route::POST('admin/page/update/{id}', [AdminPageController::class, 'update'])->name('page.update');
    Route::GET('admin/page/delete/{id}', [AdminPageController::class, 'delete'])->name('page.delete');

    Route::group(['prefix' => 'laravel-filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    // ===================================== PRODUCT ====================================
    Route::GET('admin/product/list', [AdminProductController::class, 'list'])->name('product.list');
    Route::GET('admin/product/add', [AdminProductController::class, 'add'])->name('product.add');
    Route::POST('admin/product/store', [AdminProductController::class, 'store'])->name('product.store');
    Route::GET('admin/product/edit/{id}', [AdminProductController::class, 'edit'])->name('product.edit');
    Route::POST('admin/product/update/{id}', [AdminProductController::class, 'update'])->name('product.update');
    Route::GET('admin/product/delete/{id}', [AdminProductController::class, 'delete'])->name('product.delete');
    /*cat*/
    Route::GET('admin/product/cat/list', [AdminCatProductController::class, 'listCat'])->name('product.cat.list');
    Route::POST('admin/product/cat/store', [AdminCatProductController::class, 'storeCat'])->name('product.cat.store');
    Route::GET('admin/product/cat/edit/{id}', [AdminCatProductController::class, 'editCat'])->name('product.cat.edit');
    Route::POST('admin/product/cat/update/{id}', [AdminCatProductController::class, 'updateCat'])->name('product.cat.update');
    Route::GET('admin/product/cat/delete/{id}', [AdminCatProductController::class, 'deleteCat'])->name('product.cat.delete');
});


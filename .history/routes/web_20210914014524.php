<?php

use App\Http\Controllers\AdminUserController;
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
    // USER
    Route::GET('admin/user/list', [AdminUserController::class, 'list'])->name('user.list');
    Route::GET('admin/user/add', [AdminUserController::class, 'add'])->name('user.add');
    Route::POST('admin/user/store', [AdminUserController::class, 'store'])->name('user.store');
    Route::
});

<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;

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

Route::get('/' , fn() => 'jksa')->name('switchLan');
Route::get('/pro' , fn() => 'jksa')->name('profile');
Route::middleware('auth')->group(function(){

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('home' , [AdminHomeController::class , 'index'])->name('home');

    // role  -----------------
    Route::get('role/data' , [RoleController::class , 'data'])->name('roles.data');
    Route::resource('roles' , RoleController::class);
    Route::delete('bulk_delete', fn()=> '')->name('roles.bulk_delete');

    // Admins Data  -----------------------
    Route::get('admin/data' , [AdminController::class , 'data'])->name('admins.data');
    Route::resource('admin' , AdminController::class);
    Route::delete('admin/bulk_delete', fn()=> '')->name('admin.bulk_delete');

    // Admins Data  -----------------------
    Route::get('user/data' , [AdminUsersController::class , 'data'])->name('user.data');
    Route::resource('user' , AdminUsersController::class);
    Route::delete('user/bulk_delete', fn()=> '')->name('user.bulk_delete');

    Route::get('setting' , [SettingController::class , 'index'])->name('setting');
    Route::post('setting' , [SettingController::class , 'Store'])->name('setting.store');



});
})

;
// Route::get('user/data' , [AdminUsersController::class , 'data'])->name('user.data');

// Route::get('admin/data' , [AdminController::class , 'data'])->name('admins.data');


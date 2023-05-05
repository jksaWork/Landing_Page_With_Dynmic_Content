<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use Illuminate\Contracts\Session\Session;
use Laratrust\Http\Controllers\RolesController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    Route::get('/', fn () => 'jksa')->name('switchLan');
    Route::get('/pro', fn () => 'jksa')->name('profile');
    Route::middleware('auth')->group(function () {

        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('home', [AdminHomeController::class, 'index'])->name('home');

            // role  -----------------
            Route::get('role/data', [RoleController::class, 'data'])->name('roles.data');
            Route::resource('roles', RoleController::class);
            Route::delete('bulk_delete', fn () => '')->name('roles.bulk_delete');

            // Admins Data  -----------------------
            Route::get('admin/data', [AdminController::class, 'data'])->name('admins.data');
            Route::resource('admin', AdminController::class);
            Route::delete('admin/bulk_delete', fn () => '')->name('admin.bulk_delete');

            // Admins Data  -----------------------
            Route::get('user/data', [AdminUsersController::class, 'data'])->name('user.data');
            Route::resource('user', AdminUsersController::class);
            Route::delete('user/bulk_delete', fn () => '')->name('user.bulk_delete');

            Route::get('setting', [SettingController::class, 'index'])->name('setting');
            Route::post('setting', [SettingController::class, 'Store'])->name('setting.store');

            Route::resource('product', ProductController::class);
            Route::resource('categories', CategoriesController::class);
        });
    });
    // Route::get('user/data' , [AdminUsersController::class , 'data'])->name('user.data');
    // Route::get('admin/data' , [AdminController::class , 'data'])->name('admins.data');
});

Route::get('locale/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return redirect()->back();
})->name('switchLan');
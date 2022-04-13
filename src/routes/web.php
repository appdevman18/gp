<?php

use Illuminate\Support\Facades\Route;

Auth::routes();
// Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\Home\HomeController::class, 'index'])->name('home');
Route::get('/help', [App\Http\Controllers\Home\HomeController::class, 'help'])->name('help');
Route::get('/price', [App\Http\Controllers\Home\HomeController::class, 'price'])->name('price');

Route::post('/checkUrl', [App\Http\Controllers\Scrape\ScrapeController::class, 'checkUrl'])->name('checkUrl');
Route::post('/followProduct', [App\Http\Controllers\Product\FollowController::class, 'followProduct'])->name('followProduct');

Route::group(['middleware' => ['auth', 'role:admin']], function () {

    Route::prefix('admin')->group(function () {
        Route::get('/dashboard',
            'App\Http\Controllers\Admin\DashboardController@index')->name('admin.dashboard')->middleware('role:admin');
        Route::resource('/users', 'App\Http\Controllers\Admin\UserController');
        Route::resource('/roles', 'App\Http\Controllers\Admin\RoleController');
        Route::resource('/permissions', 'App\Http\Controllers\Admin\PermissionController');
        Route::resource('/products', 'App\Http\Controllers\Admin\ProductController')->only([
            'index',
            'create',
            'store',
            'show',
            'destroy'
        ]);
    });

});
Route::group(['middleware' => 'auth'], function () {

    Route::prefix('profile')->group(function () {
        Route::get('/dashboard', 'App\Http\Controllers\Profile\DashboardController@index')->name('profile.dashboard');
        Route::resource('/account', 'App\Http\Controllers\Profile\AccountController')->only([
            'edit',
            'update',
            'show',
            'destroy'
        ]);
        Route::resource('/products', 'App\Http\Controllers\Product\ProductController')->only([
            'index',
            'create',
            'store',
            'show',
            'destroy'
        ])->names([
            'index' => 'profile.products.index',
            'create' => 'profile.products.create',
            'store' => 'profile.products.store',
            'show' => 'profile.products.show',
            'destroy' => 'profile.products.destroy',
        ]);
    });

});

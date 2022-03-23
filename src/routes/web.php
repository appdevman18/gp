<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Profile\UserController;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/help', [App\Http\Controllers\HomeController::class, 'help'])->name('help');
Route::get('/price', [App\Http\Controllers\HomeController::class, 'price'])->name('price');

Route::post('/checkUrl', [App\Http\Controllers\Scrape\ScrapeController::class, 'checkUrl'])->name('checkUrl');
Route::post('/followProduct', [App\Http\Controllers\Product\FollowController::class, 'followProduct'])->name('followProduct');

Route::group(['middleware' => 'auth'], function () {

//    Route::prefix('profile')->group(function () {

        Route::get('/dashboard', function () {
            return view('pages.profile.dashboard.index');
        })->name('dashboard');

        Route::resource('/users', 'App\Http\Controllers\Profile\UserController')->middleware('role:admin');

        Route::resource('/roles', 'App\Http\Controllers\Admin\RoleController')->middleware('role:admin');
        Route::resource('/permissions', 'App\Http\Controllers\Admin\PermissionController')->middleware('role:admin');

        Route::resource('/products', 'App\Http\Controllers\Profile\ProductController')->only([
            'index', 'create', 'store', 'show', 'destroy'
        ]);

//    });

});

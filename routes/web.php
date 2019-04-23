<?php

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


use App\Http\Middleware\MAdmin;

Auth::routes();

Route::get('/', 'HomeController@welcome')->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'HomeController@logout')->name('logout')->middleware("auth");

Route::resource('user', 'UserController')->middleware("auth");
Route::get('car/{plate}', 'CarController@carinfo')->middleware("auth");
//Route::get('dashboard/car/{query?}', 'DashboardController@carquery')->middleware("auth")->name("car.ser");

Route::get('run/{plate}', 'DashboardController@run')->middleware("auth");
Route::get('/api/checkw/{plate}', 'DashboardController@checkw');
Route::post('whitelist/', 'DashboardController@saveWhite')->middleware("auth")->name("whitelist.s");

Route::middleware(['madmin'])->group(function () {
    Route::get('dashboard/log/{query?}', 'DashboardController@log')->middleware("auth");
    Route::get('dashboard/car/{query?}', 'DashboardController@car')->middleware("auth")->name("car.ser");
    Route::get('dashboard/approve/{lp}', 'DashboardController@approve')->middleware("auth");
    Route::get('dashboard/user/approve/{id}', 'DashboardController@uapprove')->middleware("auth");
    Route::get('dashboard/user/delete/{id}', 'DashboardController@udelete')->middleware("auth");
    Route::get('dashboard/user/{query?}', 'DashboardController@user')->middleware("auth");
    Route::get('dashboard/perm/{query?}', 'DashboardController@perm')->middleware("auth");
    Route::get('dashboard', 'DashboardController@index')->middleware("auth");
    Route::get('upload/', 'DashboardController@upload')->middleware("auth");
    Route::get('recognise/', 'DashboardController@recognise')->middleware("auth")->name("recognise");
//    Route::post('whitelistt/', 'DashboardController@saveWhitee')->middleware("auth")->name("whitelist.sr");
    Route::get('whitelist/{id?}', 'DashboardController@deleteWhite')->middleware("auth")->name("whitelist.sr");
});
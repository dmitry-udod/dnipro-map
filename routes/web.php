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
Auth::routes();

Route::domain('{city}.' . env('DOMAIN_NAME'))->middleware(['only_valid_city'])->group(function () {

    Route::get('/', function ($city) {
        return view('welcome', compact('city'));
    });

    // Admin area
	Route::middleware(['can_access_to_admin_area'])
	    ->namespace('Admin')
	    ->prefix('admin')
        ->as('admin.')
	    ->group(function () {
		    Route::resource('users', 'UserController');
		    Route::resource('cities', 'CityController');
	    });

	Route::middleware(['can_access_to_admin_area'])->get('/admin/home', 'HomeController@index')->name('home');
});
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

Route::domain('{city}.' . env('DOMAIN_NAME'))->middleware('only_valid_city')->group(function () {

	// Admin area
	Route::middleware([])->prefix('admin')->group(function () {
		Route::get('/home', 'HomeController@index')->name('home');
	});

    Route::get('/', function ($city) {
        return view('welcome', compact('city'));
    });
});
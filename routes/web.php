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

    Route::get('/', 'HomeController@index');
    Route::get('/categories/{slug}', 'HomeController@index')->name('categories')->where(['slug' => '[a-zA-Z0-9_-]+']);

    // Admin area
	Route::middleware(['auth', 'can_access_to_admin_area'])
	    ->namespace('Admin')
	    ->prefix('admin')
        ->as('admin.')
	    ->group(function () {
		    Route::resource('users', 'UserController');
		    Route::middleware(['only_super_admin'])->resource('cities', 'CityController');
		    Route::resource('categories', 'CategoryController');
		    Route::resource('types', 'TypeController');
		    Route::resource('districts', 'DistrictController');
		    Route::resource('structures', 'StructureController');
            Route::post('/structures/upload', 'StructureController@upload');
            Route::post('/structures/upload-remove', 'StructureController@uploadRemove');
	    });

    Route::middleware(['can_access_to_admin_area'])->get('/admin/home', 'Admin\StructureController@index')->name('home');
});
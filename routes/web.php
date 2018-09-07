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

    Route::get('/', 'HomeController@index')->name('main');
    Route::get('/contacts', 'HomeController@contacts')->name('contacts');
    Route::get('/categories/{slug}', 'HomeController@index')->name('categories')->where(['slug' => '[a-zA-Z0-9_-]+']);
    Route::get('/list/categories/{slug}', 'HomeController@index')->name('main_list')->where(['slug' => '[a-zA-Z0-9_-]+']);

    // User Claims
    Route::post('/claims/create', 'ClaimController@create')->name('create_claim');
    Route::get('/claims/check-status/{uuid?}', 'ClaimController@checkStatus')->name('claim_check_status');

    // User Requests
    Route::post('/new-structures/create', 'NewStructureController@create')->name('create_structure_request');
    Route::post('/previous-record/create', 'PreviousRecordController@create')->name('create_previous_record');

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
		    Route::resource('claims', 'ClaimController');
		    Route::resource('previousrecords', 'PreviousRecordController');
		    Route::resource('structurerequests', 'StructureRequestController');
            Route::post('/structures/upload', 'StructureController@upload');
            Route::post('/structures/upload-remove', 'StructureController@uploadRemove');
            Route::get('/structures/create-from-request/{id}', 'StructureRequestController@createStructureFromUserRequest')
                ->name('structures.create_from_user_request');

            // Import
            Route::get('/import', 'ImportController@index')->name('import.index');
            Route::post('/import/save-data', 'ImportController@saveData')->name('import.save_data');

            // Statistics
            Route::get('/statistics', 'StatisticsController@index')->name('statistics');
	    });

    Route::middleware(['can_access_to_admin_area'])->get('/admin/home', 'Admin\StructureController@index')->name('home');
});

Route::get('/', 'HomeController@index')->name('select_city');
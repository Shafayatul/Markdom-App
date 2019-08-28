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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {



	Route::get('/home', 'HomeController@index')->name('home');
	
	Route::resource('categories', 'CategoriesController');
	Route::resource('sub-categories', 'SubCategoriesController');
	Route::resource('sub-sub-categories', 'SubSubCategoriesController');
	Route::resource('stores', 'StoresController');

	Route::resource('products', 'ProductsController');
	Route::resource('service-types', 'ServiceTypesController');
	Route::resource('reviews', 'ReviewsController');
	Route::resource('orders', 'OrdersController');
	Route::resource('offers', 'OffersController');
	Route::resource('days', 'DaysController');
	Route::resource('schedule-types', 'ScheduleTypesController');


	Route::resource('roles', 'RolesController');
	Route::resource('users', 'UsersController');
	Route::post('/assign-user', 'UsersController@userAssigned')->name('assign-user');
	Route::get('/user-active/{id}', 'UsersController@userActivated');
	Route::get('/user-inactive/{id}', 'UsersController@userInactivated');
	Route::get('/password-change', 'UsersController@passwordChangeView');
	Route::post('/password-changed', 'UsersController@passwordChanged')->name('password-change');

	Route::get('/schedule/{id}', 'SchedulesController@index');
	Route::get('/schedules/{id}/edit', 'SchedulesController@edit');
	Route::get('/schedules/{day_id}/{store_id}', 'SchedulesController@show');
	Route::get('/schedules/create', 'SchedulesController@create');
	Route::post('/schedules', 'SchedulesController@store');
	Route::delete('/schedules/{id}', 'SchedulesController@destroy');
	
	// Route::resource('schedules', 'SchedulesController');
	Route::patch('/schedules/{id}', 'SchedulesController@update');
	Route::resource('booked-schedules', 'BookedSchedulesController');
});






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

	Route::resource('roles', 'RolesController');
	Route::resource('categories', 'CategoriesController');
	Route::resource('sub-categories', 'SubCategoriesController');
	Route::resource('users', 'UsersController');
	Route::post('/assign-user', 'UsersController@userAssigned')->name('assign-user');
	Route::get('/user-active/{id}', 'UsersController@userActivated');
	Route::get('/user-inactive/{id}', 'UsersController@userInactivated');

});

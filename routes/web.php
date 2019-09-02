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

//FrontEnd Route Starts From Here
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function()
{
	Route::get('/', 'FrontEnd\FrontEndController@index');
	Route::get('/user-login', 'FrontEnd\FrontEndController@userLogin')->name('user-login');
	Route::get('/user-signup', 'FrontEnd\FrontEndController@userSignup')->name('user-signup');

	Route::get('/chat', 'FrontEnd\FrontEndController@chat')->name('chat');

	Route::get('/restaurant', 'FrontEnd\RestaurantsController@index')->name('restaurant');
	Route::get('/sub-category/restaurant', 'FrontEnd\RestaurantsController@subCategoryRestaurant')->name('sub-category-restaurant');
	Route::get('/restaurant-details', 'FrontEnd\RestaurantsController@restaurantDetails')->name('restaurant-details');

	Route::get('/order-details','OrdersController@orderDetails')->name('order-details');
	Route::get('/order-notification','OrdersController@orderNotification')->name('order-notification');

	Route::get('/worker', 'FrontEnd\WorkerController@index')->name('worker');
	Route::get('/sub-category/worker', 'FrontEnd\WorkerController@subCategoryWorker')->name('sub-category-worker');
	Route::get('/sub-sub-category/worker', 'FrontEnd\WorkerController@subSubCategoryWorker')->name('sub-sub-category-worker');
	Route::get('/worker-details', 'FrontEnd\WorkerController@workerDetails')->name('worker-details');
	Route::get('/worker-service-delivery', 'FrontEnd\WorkerController@workerServiceDelivery')->name('worker-service-delivery');
	Route::get('/order-delivery-time', 'OrdersController@orderDeliveryTime')->name('order-delivery-time');
});

//FrontEnd Route Ends Here

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
	Route::resource('modules', 'ModulesController');
	Route::resource('worker-service-costs', 'WorkerServiceCostsController');
	Route::resource('countries', 'CountriesController');
	Route::resource('states', 'StatesController');
	Route::resource('cities', 'CitiesController');
	Route::resource('addresses', 'AddressesController');
	Route::resource('payment-types', 'PaymentTypesController');
	Route::resource('order-status', 'OrderStatusController');
});

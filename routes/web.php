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

	//User Login
	Route::get('/user-login', 'FrontEnd\FrontEndController@userLogin')->name('user-login');
	Route::post('/user-login', 'FrontEnd\FrontEndController@userLoginSubmit');
	Route::get('/user-logout', 'FrontEnd\FrontEndController@logout');

	//User Signup
	Route::get('/user-signup', 'FrontEnd\FrontEndController@userSignup')->name('user-signup');
	Route::post('/signup-form', 'FrontEnd\FrontEndController@singupForm');

	Route::get('/chat', 'FrontEnd\FrontEndController@chat')->name('chat');

	Route::get('/restaurant', 'FrontEnd\RestaurantsController@index')->name('restaurant');
	Route::get('/sub-category/restaurant/{id}', 'FrontEnd\RestaurantsController@subCategoryRestaurant')->name('sub-category-restaurant');
	Route::get('/restaurant-details/{id}', 'FrontEnd\RestaurantsController@restaurantDetails')->name('restaurant-details');

	Route::get('/order-details/{id}','OrdersController@orderDetails')->name('order-details');
	Route::get('/order-notification','OrdersController@orderNotification')->name('order-notification');

	Route::get('/worker', 'FrontEnd\WorkerController@index')->name('worker');
	Route::get('/sub-category-worker/{id}', 'FrontEnd\WorkerController@subCategoryWorker');
	Route::get('/sub-sub-category-worker/{id}', 'FrontEnd\WorkerController@subSubCategoryWorker');
	Route::get('/worker-details/{id}', 'FrontEnd\WorkerController@workerDetails')->name('worker-details');
	Route::get('/service-sub-category-worker/{id}', 'FrontEnd\WorkerController@serviceSubCategoryWorker')->name('service-sub-category-worker');
	Route::get('product-by-service-sub-category/{id}', 'FrontEnd\WorkerController@productByServiceSubCategory')->name('product-by-service-sub-category');
	Route::get('/worker-product-details/{id}', 'FrontEnd\WorkerController@workerProductDetails')->name('worker-product-details');
	Route::get('/worker-service-delivery', 'FrontEnd\WorkerController@workerServiceDelivery')->name('worker-service-delivery');
	Route::get('/worker-save-service-type/{id}', 'FrontEnd\WorkerController@workerSaveServiceType')->name('worker-save-service-type');

	Route::get('/worker-service-time/{id}/{date?}', 'FrontEnd\WorkerController@workerServiceTime')->name('worker-service-time');
	Route::get('/worker-cart', 'FrontEnd\WorkerController@workercart')->name('worker-cart');
	Route::get('/worker-place-holder', 'FrontEnd\WorkerController@workerPlaceOrder')->name('worker-place-holder');

	Route::get('/add-to-cart-service/{id}', 'FrontEnd\WorkerController@addToCartService')->name('add-to-cart-service');

	Route::get('/order-delivery-time', 'OrdersController@orderDeliveryTime')->name('order-delivery-time');
	Route::get('/place-order', 'OrdersController@placeOrder')->name('place-order');
	Route::get('/worker-notification', 'FrontEnd\WorkerController@workerNotification')->name('worker-notification');

	// Store Route
	Route::get('/store', 'FrontEnd\StoreController@index')->name('store');
	Route::get('/sub-category-store/{id}', 'FrontEnd\StoreController@subCategoryStore');
	Route::get('/store-details/{id}', 'FrontEnd\StoreController@storeDetails')->name('store-details');
	Route::get('/store-product-details/{id}', 'FrontEnd\StoreController@storeProductDetails')->name('store-product-details');
	Route::get('/store-cart', 'FrontEnd\StoreController@storeCart')->name('store-cart');
	Route::get('/store-place-order', 'FrontEnd\StoreController@storePlaceOrder')->name('store-place-order');

	// Api Route for Store

});

//FrontEnd Route Ends Here

Auth::routes();
Route::middleware(['auth'])->group(function () {

	Route::get('/home', 'HomeController@index')->name('home');

	Route::resource('categories', 'CategoriesController');
	Route::get('get-categories-list', 'AjaxController@getCategoryList');
	Route::get('get-subcategories-list', 'AjaxController@getSubCategoryList');
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
	Route::resource('order-activities', 'OrderActivitiesController');
	Route::resource('service-categories', 'ServiceCategoriesController');
	Route::resource('service-sub-categories', 'ServiceSubCategoriesController');
	Route::resource('service-sub-sub-categories', 'ServiceSubSubCategoriesController');
});


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

	Route::post('/ajax-is-driver', 'FrontEnd\FrontEndController@isDriver');

	Route::post('/check-promo-code', 'FrontEnd\StoreController@checkPromoCode')->name('check-promo-code');


	//Store Section
	Route::get('/store', 'FrontEnd\StoreController@index')->name('store');
	Route::get('/sub-category-store/{id}', 'FrontEnd\StoreController@subCategoryStore');
	Route::get('/store-details/{id}', 'FrontEnd\StoreController@storeDetails')->name('store-details');
	Route::get('/store-product-details/{id}', 'FrontEnd\StoreController@storeProductDetails')->name('store-product-details');
	Route::get('/store-cart/{id}', 'FrontEnd\StoreController@storeCart')->name('store-cart');
	Route::get('/add-to-cart-store/{id}', 'FrontEnd\StoreController@addToCartStore')->name('add-to-cart-store');
	Route::get('/store-place-order/{id}', 'FrontEnd\StoreController@storePlaceOrder')->name('store-place-order');


	//User Signup
	Route::get('/user-signup', 'FrontEnd\FrontEndController@userSignup')->name('user-signup');
	Route::post('/signup-form', 'FrontEnd\FrontEndController@singupForm');

	Route::get('/chat', 'FrontEnd\FrontEndController@chat')->name('chat');
	// Route::get('/waiting', 'FrontEnd\FrontEndController@waiting')->name('waiting');

	Route::get('/restaurant', 'FrontEnd\RestaurantsController@index')->name('restaurant');
	Route::get('/sub-category/restaurant/{id}', 'FrontEnd\RestaurantsController@subCategoryRestaurant')->name('sub-category-restaurant');
	Route::get('/restaurant-details/{id}', 'FrontEnd\RestaurantsController@restaurantDetails')->name('restaurant-details');

	Route::get('/add-to-cart-restuarent/{id}', 'FrontEnd\RestaurantsController@addToCartRestaurant')->name('add-to-cart-restuarent');

	Route::post('customer-order', 'FrontEnd\RestaurantsController@customerOrder');
	Route::get('waiting-for-offer/{restuarent_customer_order_id}', 'FrontEnd\RestaurantsController@waitingForOffer');
	Route::get('order-details/{user_id}/{store_id}','OrdersController@orderDetails')->name('order-details');
	Route::get('/order-notification','OrdersController@orderNotification')->name('order-notification');
	Route::get('see-order-detail-by-driver/{restuarent_order_id}', 'FrontEnd\RestaurantsController@see_order_detail_by_driver');




	Route::get('/worker', 'FrontEnd\WorkerController@index')->name('worker');
	Route::get('/service-category-by-worker/{id}', 'FrontEnd\WorkerController@service_category_show_by_store_id');
	// Route::get('/sub-category-worker/{id}', 'FrontEnd\WorkerController@subCategoryWorker');
	// Route::get('/sub-sub-category-worker/{id}', 'FrontEnd\WorkerController@subSubCategoryWorker');
	// Route::get('/worker-details/{id}', 'FrontEnd\WorkerController@workerDetails')->name('worker-details');
	Route::get('/service-sub-category-worker/{id}', 'FrontEnd\WorkerController@serviceSubCategoryWorker')->name('service-sub-category-worker');
	Route::get('/service-sub-sub-by-service-sub-category/{id}', 'FrontEnd\WorkerController@serviceSubSubCategoryWorker')->name('service-sub-sub-by-service-sub-category');
	Route::get('product-by-service-sub-sub-category/{id}', 'FrontEnd\WorkerController@productByServiceSubSubCategory')->name('product-by-service-sub-sub-category');
	Route::get('/worker-product-details/{id}', 'FrontEnd\WorkerController@workerProductDetails')->name('worker-product-details');
	// Route::get('/worker-service-delivery', 'FrontEnd\WorkerController@workerServiceDelivery')->name('worker-service-delivery');
	Route::get('/worker-save-service-type/{id}', 'FrontEnd\WorkerController@workerSaveServiceType')->name('worker-save-service-type');

	Route::get('/worker-service-time/{id}/{date?}', 'FrontEnd\WorkerController@workerServiceTime')->name('worker-service-time');
	// Route::get('/worker-cart', 'FrontEnd\WorkerController@workercart')->name('worker-cart');

	Route::get('worker-schedule-time/{id}', 'FrontEnd\WorkerController@workerScheduleTime')->name('worker-schedule-time');
	Route::get('address-select/{address_id}', 'FrontEnd\WorkerController@addressAdd');

	Route::get('/worker-place-holder/{id}', 'FrontEnd\WorkerController@workerPlaceOrder')->name('worker-place-holder');

	Route::post('/worker-order-submit', 'FrontEnd\WorkerController@workerOrderSubmit')->name('worker-order-submit');
	// Worker Address
	Route::get('/worker-address', 'FrontEnd\WorkerController@addressesView');
	Route::get('/worker-add-address', 'FrontEnd\WorkerController@addressView');
	Route::post('/worker-address-submit', 'FrontEnd\WorkerController@addressSubmit');



	Route::get('/add-to-cart-service/{id}', 'FrontEnd\WorkerController@addToCartService')->name('add-to-cart-service');

	Route::get('/order-delivery-time', 'OrdersController@orderDeliveryTime')->name('order-delivery-time');
	Route::get('/place-order', 'OrdersController@placeOrder')->name('place-order');
	Route::get('/worker-notification', 'FrontEnd\WorkerController@workerNotification')->name('worker-notification');
	

	Route::get('/address', 'FrontEnd\FrontEndController@addressesView');
	Route::get('/add-address', 'FrontEnd\FrontEndController@addressView');
	Route::post('/address-submit', 'FrontEnd\FrontEndController@addressSubmit');

	// Cart
	Route::post('/ajax-update-quantity-cart', 'FrontEnd\FrontEndController@ajaxUpdateQuantityCart');
	Route::post('/ajax-delete-cart', 'FrontEnd\FrontEndController@ajaxDeleteCart');

	Route::post('/ajax-state-list','FrontEnd\FrontEndController@ajaxStateList');
	Route::post('/ajax-city-list','FrontEnd\FrontEndController@ajaxCityList');

	Route::post('/ajax-cod-submit', 'FrontEnd\FrontEndController@ajaxCodSubmit')->name('ajax-cod-submit');

	//Payment
	Route::get('/payment-method', 'PaymentsController@payment_method_view');
	Route::get('/paytabs-payment', 'PaymentsController@paytabsPayment');
	Route::post('/paytabs-response', 'PaymentsController@paytabsResponse');

	//Order route
	Route::get('/order-confirmation/{id?}','FrontEnd\FrontEndController@orderConfirmation');
	Route::post('/payment-bank-mada-transfer-submit', 'FrontEnd\FrontEndController@placeOrder');

	Route::get('/track-order/{id}', 'FrontEnd\FrontEndController@trackOrder');

});



/* Driver order in the front end */
// Route::group(['middleware' => ['role:admin|driver']], function () {
	Route::get('driver-orders-create', 'OrdersController@createDriver');
	Route::post('driver-orders-list', 'OrdersController@storeDriver');

	Route::get('driver-orders', 'DriverOrdersController@index');
	Route::get('driver-order/{id}', 'DriverOrdersController@show');
// });


//FrontEnd Route Ends Here

Route::get('/message/{message_uid}', 'FrontEnd\RestaurantsController@chat')->name('home');
Auth::routes();
Route::middleware(['auth'])->group(function () {




	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('get-categories-list', 'AjaxController@getCategoryList');
	Route::get('get-subcategories-list', 'AjaxController@getSubCategoryList');
	Route::get('get-products-list', 'AjaxController@getProductsList');
	Route::get('get-product-data', 'AjaxController@getProductData');
	Route::get('get-discount-data', 'AjaxController@getDiscountData');

	Route::group(['middleware' => ['role:admin']], function () {

		Route::resource('categories', 'CategoriesController');

		Route::resource('sub-categories', 'SubCategoriesController');
		Route::resource('sub-sub-categories', 'SubSubCategoriesController');
		Route::resource('stores', 'StoresController');



		Route::get('store-order', 'StoreOrdersController@index');
		Route::get('store-order/{id}', 'StoreOrdersController@show');
		Route::delete('/store-order-delete/{id}', 'StoreOrdersController@destroy');

		Route::get('worker-orders', 'WorkerOrdersController@index');
		Route::get('worker-order/{id}', 'WorkerOrdersController@show');
		Route::delete('worker-order-delete/{id}', 'WorkerOrdersController@destroy');

		Route::get('order-in-store/{id}', 'StoresController@orderShowByStoreId');


		Route::resource('products', 'ProductsController');
		Route::resource('service-types', 'ServiceTypesController');
		Route::resource('reviews', 'ReviewsController');
		Route::resource('orders', 'OrdersController');


		//Driver Order Section
		Route::get('driver-orders', 'DriverOrdersController@index');
		Route::get('driver-order/{id}', 'DriverOrdersController@show');
		Route::delete('driver-order-delete/{id}', 'DriverOrdersController@destroy');

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
		Route::resource('promo-codes', 'PromoCodesController');


		Route::post('store-order-status-change', 'StoreOrdersController@storeOrderStatusChange')->name('store-order-status-change');
		Route::get('/add-shipment-to-smsa/{order_id}/{user_id}/{address_id}', 'StoreOrdersController@addShipmentToSmsa');
		


		Route::post('worker-order-status-change', 'WorkerOrdersController@workerOrderStatusChange')->name('worker-order-status-change');
		
		Route::resource('restuarent-customer-orders', 'RestuarentCustomerOrdersController');

	});
	


	Route::group(['middleware' => ['role:admin|store']], function () {
		Route::resource('stores', 'StoresController');
		Route::get('store-order', 'StoreOrdersController@index');
		Route::get('store-order/{id}', 'StoreOrdersController@show');

		Route::get('order-in-store/{id}', 'StoresController@orderShowByStoreId');

		Route::resource('days', 'DaysController');
		Route::resource('schedule-types', 'ScheduleTypesController');

		Route::get('/schedule/{id}', 'SchedulesController@index');
		Route::get('/schedules/{id}/edit', 'SchedulesController@edit');
		Route::get('/schedules/{day_id}/{store_id}', 'SchedulesController@show');
		Route::get('/schedules/create', 'SchedulesController@create');
		Route::post('/schedules', 'SchedulesController@store');
		Route::delete('/schedules/{id}', 'SchedulesController@destroy');

		Route::patch('/schedules/{id}', 'SchedulesController@update');
		Route::resource('booked-schedules', 'BookedSchedulesController');
	});

	Route::group(['middleware' => ['role:admin|customer']], function () {
		Route::get('review/{id}', 'StoreOrdersController@reviewCreate');
		Route::post('/submit-reviews', 'StoreOrdersController@submitReview');

		Route::get('worker-review/{id}', 'WorkerOrdersController@reviewCreate');
		Route::post('/worker-submit-reviews', 'WorkerOrdersController@submitReview');
	});
});


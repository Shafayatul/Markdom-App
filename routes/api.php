<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// country - state - city
Route::get('country-list', 'Api\CountriesController@index');
Route::get('get-state/{country_id}', 'Api\CountriesController@state');
Route::get('get-city/{state_id}', 'Api\CountriesController@city');
Route::get('get-all-schedule-type-by-lang/{lang}', 'Api\WorkingHoursController@get_all_schedule_type_by_lang');

Route::get('get-modules', 'Api\ModulesController@get_modules');
Route::get('get-module/{module}', 'Api\ModulesController@get_module_by_module_name');
Route::get('get-categories-by-module/{id}', 'Api\CategoriesController@get_categories_by_module_id');
Route::get('get-offers-by-module/{id}', 'Api\OffersController@get_offers_by_module_id');

Route::get('get-subcategories-by-category/{id}', 'Api\CategoriesController@get_subcategories_by_category_id');

Route::get('get-stores-by-module-id/{id}', 'Api\StoresController@get_stores_by_module_id');
Route::get('get-stores-by-subcategory/{id}', 'Api\StoresController@get_stores_by_subcategory_id');
Route::get('get-store-detail/{id}', 'Api\StoresController@get_store_detail');
Route::get('get-store-by-category/{category_id}', 'Api\StoresController@get_stores_by_category_id');

Route::get('get-workinghours/{id}/{date}', 'Api\WorkingHoursController@get_workinghours_by_store_id_and_date');
Route::get('get-product-by-store/{id}', 'Api\StoresController@get_product_by_store_id');
Route::get('get-product-detail/{id}', 'Api\ProductsController@get_product_detail');

Route::get('get-sub-subcategories-by-sub-category/{id}', 'Api\SubCategoriesController@get_sub_sub_categories_by_sub_category_id');

Route::get('get-product-by-sub-sub-category/{id}', 'Api\ProductsController@get_product_by_subsubcategory_id');

Route::get('get-service-type-price', 'Api\WorkerServiceCostsController@get_service_type_price');

Route::get('get-review-by-store/{store_id}', 'Api\ReviewsController@get_review_by_store_id');

Route::get('get-service-category-by-store/{store_id}', 'Api\ServicesController@get_service_category_by_store_id');

Route::get('get-service-sub-category-by-service-category/{service_category_id}', 'Api\ServicesController@get_service_sub_category_by_service_category_id');

Route::get('get-products-by-service-sub-sub-category/{service_sub_sub_category_id}', 'Api\ServicesController@get_products_by_service_sub_sub_category_id');

Route::get('get-service-sub-sub-category-by-service-sub-category/{service_sub_category_id}', 'Api\ServicesController@get_service_sub_sub_category_by_service_sub_category_id');

Route::post('signup', 'Api\UsersController@signup');
Route::post('forgot/password', 'Api\ForgotPasswordController');

Route::get('get-promo-codes', 'Api\PromoCodesController@get_promo_codes');

Route::get('customer-detail/{id}', 'Api\UsersController@customer_detail');
Route::get('restuarant-customer-order-detail/{id}', 'Api\OrdersController@restuarant_customer_order_detail');


//Relocation Section
Route::get('get-relocation-store-by-module-id/{id}', 'Api\RelocationsController@get_stores_by_module_id');
Route::get('get-cartype-by-store-id/{store_id}', 'Api\RelocationsController@get_cartypes_by_store_id');

Route::get('get-store-by-store-id/{store_id}', 'Api\RelocationsController@get_store_by_store_id');
Route::get('get-cartype-by-cartype-id/{cartype_id}', 'Api\RelocationsController@get_cartype_by_carttype_id');

Route::group(['middleware' => ['auth:api']], function() {

	// Route::get('/test', 'Api\TestController@index');

	//Users Section

	Route::get('user-details', 'Api\UsersController@user_details');

	Route::post('get-current-user-data','Api\UsersController@get_current_user_data');

	Route::post('change-password', 'Api\UsersController@change_password');
	Route::post('change-language', 'Api\UsersController@change_language');
	Route::post('update-user-info', 'Api\UsersController@update_user_info');
	Route::post('logout','Api\UsersController@logoutApi');
	
	Route::post('check-driver','Api\UsersController@checkDriver');

	//Carts Section
	Route::get('view-cart/{module_id}','Api\CartsController@index');
	Route::post('add-to-cart','Api\CartsController@store');
	Route::post('update-quantity','Api\CartsController@update_quantity_cart');
	Route::post('delete-cart','Api\CartsController@destroy');

	//Review Section
	Route::post('post-review', 'Api\ReviewsController@post_review');

	//Address Section
	Route::post('delete-address','Api\AddressController@destroy');
	Route::post('add-address','Api\AddressController@store');
	Route::get('get-addresses','Api\AddressController@index');
	Route::get('get-single-address/{id}','Api\AddressController@get_single_address');

	//Order Section
	Route::post('worker-place-order', 'Api\OrdersController@worker_place_order');
	Route::post('place-order','Api\OrdersController@place_order');
	Route::get('get-order-history','Api\OrdersController@history');
	Route::get('get-order-summary/{city_id}/{promo_code?}','Api\OrdersController@get_order_summary');
	Route::get('order-details/{order_id}','Api\OrdersController@order_detail');
	Route::get('worker-order-details/{order_id}','Api\OrdersController@worker_order_detail');

	Route::post('promo-code-validation','Api\PromoCodesController@promo_code_validation');

	Route::get('get-customer-restuarent-order/{module}', 'Api\CustomersController@customer_restuarent_orders');

	Route::get('get-single-restuarent-order/{id}', 'Api\CustomersController@restaurent_single_order');
	Route::get('get-single-worker-order/{id}', 'Api\CustomersController@worker_single_order');
	Route::get('get-single-store-order/{id}', 'Api\CustomersController@store_single_order');

	Route::get('single-restaurent-complete/{id}', 'Api\CustomersController@restaurentOrderComplete');
	Route::get('single-worker-complete/{id}', 'Api\CustomersController@workerOrderComplete');
	Route::get('review-check-by-order-id/{id}/{type}', 'Api\CustomersController@order_review_check');

	Route::post('/order-review-submit', 'Api\CustomersController@order_review_submit');

	Route::post('/restaurant-place-order', 'Api\CustomersController@restaurant_place_order');

	Route::get('/receipt-download/{id}', 'Api\CustomersController@receipt_download');

	Route::post('/relocation-place-order', 'Api\RelocationsController@relocation_place_order');

	Route::get('get-customer-relocation-order', 'Api\RelocationsController@relocation_order_by_user');

	Route::get('get-single-relocation-order/{id}', 'Api\RelocationsController@relocation_order_by_order_id');
	Route::post('relocation-payment-data-update', 'Api\RelocationsController@relocation_order_data_update');
	Route::get('get-single-relocation-order-by-order-id/{id}', 'Api\RelocationsController@relocation_single_order');

});

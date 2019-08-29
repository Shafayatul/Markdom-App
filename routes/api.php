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
Route::get('get-categories-by-module/{id}', 'Api\CategoriesController@get_categories_by_module_id');
Route::get('get-offers-by-module/{id}', 'Api\OffersController@get_offers_by_module_id');

Route::get('get-subcategories-by-category/{id}', 'Api\CategoriesController@get_subcategories_by_category_id');

Route::get('get-stores-by-subcategory/{id}', 'Api\StoresController@get_stores_by_subcategory_id');
Route::get('get-store-detail/{id}', 'Api\StoresController@get_store_detail');

Route::get('get-workinghours-by-store/{id}', 'Api\WorkingHoursController@get_workinghours_by_store_id');
Route::get('get-product-by-store/{id}', 'Api\StoresController@get_product_by_store_id');
Route::get('get-product-detail/{id}', 'Api\ProductsController@get_product_detail');

Route::get('get-sub-subcategories-by-sub-category/{id}', 'Api\SubCategoriesController@get_sub_sub_categories_by_sub_category_id');

Route::get('get-product-by-sub-sub-category/{id}', 'Api\ProductsController@get_product_by_subsubcategory_id');

Route::get('get-service-type-price', 'Api\WorkerServiceCostsController@get_service_type_price');

Route::post('post-review', 'Api\ReviewsController@post_review');


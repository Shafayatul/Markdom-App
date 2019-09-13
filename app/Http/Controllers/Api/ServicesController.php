<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ServiceCategory;
use App\ServiceSubCategory;
use App\Product;

class ServicesController extends Controller
{
    public function get_service_category_by_store_id($store_id)
    {
    	$service_categories = ServiceCategory::where('store_id', $store_id)->get();
    	return response()->json($service_categories);
    }

    public function get_service_sub_category_by_service_category_id($service_category_id)
    {
    	$service_sub_categories = ServiceSubCategory::where('service_category_id', $service_category_id)->get();
    	return response()->json($service_sub_categories);
    }

    public function get_product_by_service_sub_category_id($service_sub_category_id)
    {
    	$products = Product::where('service_sub_category_id', $service_sub_category_id)->get();
    	return response()->json($products);
    }
}

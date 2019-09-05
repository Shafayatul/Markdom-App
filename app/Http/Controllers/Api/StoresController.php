<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Store;
use App\Product;

class StoresController extends Controller
{

    public function get_stores_by_subcategory_id($id)
    {
    	$stores = Store::where('sub_category_id', $id)->latest()->get();
    	return response()->json($stores);
    }

    public function get_store_detail($id)
    {
    	$store = Store::where('id', $id)->first();
    	return response()->json($store);
    }

    public function get_product_by_store_id($id)
    {
    	$products = Product::where('store_id', $id)->latest()->get();
    	return response()->json($products);
    }
}

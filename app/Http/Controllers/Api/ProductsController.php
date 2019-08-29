<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Product;

class ProductsController extends Controller
{
    public function get_product_detail($id)
    {
    	$product = Product::where('id', $id)->first();
    	return response()->json($product);
    }

    public function get_product_by_subsubcategory_id($id)
    {
    	$products = Product::where('sub_sub_category_id', $id)->get();
    	return response()->json($products);
    }
}

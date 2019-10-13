<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\SubCategory;
use App\Product;


class AjaxController extends Controller
{
    public function getCategoryList(Request $request)
    {
    	
        $category = Category::where('module_id',$request->module_id)->pluck('name','id');

        return response()->json($category);
    }

    public function getSubCategoryList(Request $request)
    {
    	$subcategory = SubCategory::where('category_id',$request->category_id)->pluck('name','id');

        return response()->json($subcategory);
    }

    public function getProductsList(Request $request)
    {
        $products = Product::where('store_id',$request->store_id)->pluck('name','id');

        return response()->json($products);
    }

    public function getProductData(Request $request)
    {
       $product = Product::where('id',$request->product_id)->first();

        return response()->json($product); 
    }
}

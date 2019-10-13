<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\SubCategory;
use App\Product;
use App\PromoCode;
use App\DriverOrder;
use Auth;


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

    public function getDiscountData(Request $request)
    {
        // $data = [];
        $id = Auth::id();
        $count_code_by_user = DriverOrder::where('user_id', $id)->where('promo_code', $request->code)->count();
        if($count_code_by_user == 0){
            $code = PromoCode::where('code', $request->code)->first();
            if($code != null){
                $data['msg'] = 'Found';
                $data['code'] = $code; 
            }else{
                $data['msg'] = 'Not Found';
                $data['code'] = ''; 
            }
        }else{
            $data['msg'] = 'You already used it'; 
            $data['code'] = ''; 
        }
        
        return response()->json($data);
    }
}

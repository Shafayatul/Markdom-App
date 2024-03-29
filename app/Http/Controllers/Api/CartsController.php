<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Cart;
use App\User;
use App\Product;
use App\Module;
use Log;

class CartsController extends Controller
{
    public function index($module_id){
        $data = [];
        $carts=Cart::where('user_id', Auth::id())->where('is_cart', '1')->where('module_id', $module_id)->latest()->get();
        foreach ($carts as $cart) {
            $product = Product::where('id', $cart->product_id)->first();

            $single_data = [];
            $single_data['cart_id']                 = $cart->id; 
            $single_data['product_id']              = $cart->product_id; 
            $single_data['product_name']            = $product->name; 
            $single_data['product_name_arabic']     = $product->name_arabic; 
            $single_data['preview_image']           = $product->preview_image;
            $single_data['total_price']             = $cart->quantity*$cart->unit_price; 
            $single_data['quantity']                = $cart->quantity;
            $single_data['price']                   = $cart->unit_price;
            array_push($data, $single_data);
        }
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $user_id        = Auth::id();
        $product_id     = $request->input('product_id');
        $module_id      = $request->input('module_id');
        $count = Cart::where('user_id', Auth::id())->where('is_cart', '1')->where('product_id', $product_id)->count();
        Log::debug($count);
        $current_product = Product::where('id', $request->input('product_id'))->first();
        $product_price = $current_product->price;

         if($current_product->is_offer == 1){
            if($current_product->offer_type == 'Amount'){
                $product_price = $current_product->offer_amount;
            }else{
                $product_price = $current_product->price*$current_product->offer_percent/100;
            }
        }

        if($count>0) {
            $id = Cart::where('user_id', Auth::id())->where('is_cart', '1')->where('product_id', $product_id)->first()->id;
            $old_quantity = Cart::where('id', $id)->first()->quantity;
            $quantity = 1+$old_quantity;
            $Cart = Cart::find($id);
            $Cart->quantity                  = $quantity;
            $Cart->save();
        }else{

            $Cart = new Cart;
            $Cart->user_id                      = $user_id;
            $Cart->product_id                   = $product_id;
            $Cart->module_id                    = $module_id;
            $Cart->quantity                     = $request->input('quantity');
            $Cart->unit_price                   = $product_price;
            $Cart->is_cart                      = 1;
            $Cart->save();            
        }

        if ($Cart) {
            $data['msg'] = 'Success';
            $data['status'] = 1; 
        }else{
            $data['msg'] = 'Failed';
            $data['status'] = 0; 
        }
        return response()->json($data);
    }

    public function update_quantity_cart(Request $request)
    {
        $id = $request->input('cart_id');

        // $old_quantity = Cart::where('id', $id)->first()->quantity;

        $quantity = $request->input('new_quantity'); //+$old_quantity;

        $Cart               = Cart::find($id);
        $Cart->quantity     = $quantity;
        $Cart->save();
        if ($Cart) {
            $data['msg'] = 'Success';
            $data['status'] = 1; 
        }else{
            $data['msg'] = 'Failed';
            $data['status'] = 0; 
        }
        return response()->json($data);
    }

    public function destroy(Request $request)
    {
        
        Cart::where('user_id', Auth::id())->where('id', $request->input('cart_id'))->delete();

        return response()->json([
            'message' => 'Successfully deleted.'
        ]);
    }
}
<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function place_order(Request $request)
    {
    	$total_price = 0;
        $final_price = 0;
        $paytab_transaction_id = null;
        $image = '';
        $cart_ids = [];
        $city_id = Address::where('id', $request->input('address_id'))->first()->city_id;
        $city  = City::where('id', $city_id)->first();
        $shipping_fees  = $city->delivery_fees;
        if($city->cod == 1){
            $time_stamp = time()+(3*24*60*60);
            $estimated_time = date("l", $time_stamp).' '.date('M d,Y', $time_stamp); ;
        }else{
            $time_stamp = time()+(5*24*60*60);
            $estimated_time = date("l", $time_stamp).' '.date('M d,Y', $time_stamp); ;
        }

        $cart=Cart::where('user_id', Auth::id())->where('is_cart', '1')->latest()->get();
        foreach ($cart as $single_cart) {
        	$total_price = $total_price + ($single_cart->quantity*$single_cart->price);
        	array_push($cart_ids, $single_cart->id);
        }
        $cart_ids = implode(',', $cart_ids);
        

        $final_price = $total_price + $shipping_fees;

        $cart = Cart::where('user_id', Auth::id())->where('is_cart', '1')->update(['is_cart'=>'0']);
        $order_status = OrderStatus::first()->id;

        if ($request->input("payment_method") == "COD") {
            $payment_method = 'COD';
            $final_price = $final_price+15;
        }elseif($request->input("payment_method") == "Paytab"){
            $payment_method = 'Paytab';
            $paytab_transaction_id = $request->input("paytab_transaction_id");
        }else{

            if($request->hasFile('image')){
                $image = $request->file('image');
                $image_fullname = uniqid().'.'.strtolower($image->getClientOriginalExtension());
                $path = 'uploads/';
                $image_url = $path.$image_fullname;
                $image->move($path,$image_fullname);
            }else{
                $image_url = "";
            }
            $image = $image_url;
            $payment_method = 'Bank Transfer';

        }

        $order 						      	= new Order;
		$order->user_id 			      	= Auth::id();
		$order->cart_ids 			      	= $cart_ids;
		$order->total_price 		      	= $total_price;
        $order->paytab_transaction_id     	= $paytab_transaction_id;
		$order->address_id 					= $request->input("address_id");
		$order->final_price 				= $final_price;
		$order->order_status 				= $order_status;
        $order->estimated_time      		= $estimated_time;
        $order->image               		= $image;
        $order->payment_method      		= $payment_method;
		$order->save();
        if ($order) {

        $order_status_obj               = OrderStatus::first();

        $OrderActivity                  = new OrderActivity;
        $OrderActivity->order_id        = $order->id;
        $OrderActivity->status          = $order_status_obj->order_status;
        $OrderActivity->status_arabic   = $order_status_obj->order_status_arabic;
        $OrderActivity->save();


            $data = [];
            $data['order_id'] = $order->id;
            $data['estimated_time'] = $estimated_time;
            return response()->json($data);
        }else{
            return response()->json(
                ['message' => "Failed"]
            );
        }
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Order;
use App\Address;
use App\City;
use App\State;
use App\Country;
use App\Cart;
use App\OrderStatus;
use App\OrderActivity;
use App\PromoCode;
use App\RestuarentCustomerOrder;
use Auth;

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
        	$total_price = $total_price + ($single_cart->quantity*$single_cart->unit_price);
        	array_push($cart_ids, $single_cart->id);
        }
        $cart_ids = implode(',', $cart_ids);
        
        $promo_code_cnt = PromoCode::where('code', $request->input("promo_code"))->count();
        if (($request->input("promo_code") !== null) && ($promo_code_cnt > 0)) {
            $promo_code = PromoCode::where('code', $request->input("promo_code"))->first();
            $only_promo_code = $promo_code->code;
            $discount_type = $promo_code->type;
            $discount_percent = $promo_code->percent;
            $discount_amount = $promo_code->amount;

            if ($discount_type == "Amount") {
              $final_price = $total_price - $discount_amount;
            }else{
              $final_price = $total_price - (($total_price*$discount_percent)/100);
            }
        }else{
            $final_price = $total_price;
            $discount_percent = '';
            $discount_amount = '';
            $only_promo_code = '';
        }

        $final_price = $final_price + $shipping_fees;

        $cart = Cart::where('user_id', Auth::id())->where('is_cart', '1')->update(['is_cart'=>'0']);
        $order_status = OrderStatus::first()->id;

        if ($request->input("payment_method") == "COD") {
            $payment_method = 'COD';
            $final_price = $final_price+15;
        }elseif($request->input("payment_method") == "Paytab"){
            $payment_method = 'Paytab';
            $paytab_transaction_id = $request->input("paytab_transaction_id");
        }else{

            // if($request->hasFile('image')){
            //     $image = $request->file('image');
            //     $image_fullname = uniqid().'.'.strtolower($image->getClientOriginalExtension());
            //     $path = 'uploads/';
            //     $image_url = $path.$image_fullname;
            //     $image->move($path,$image_fullname);
            // }else{
            //     $image_url = "";
            // }
            $image = $request->input("bank_image");
            $payment_method = 'Bank Transfer';

        }

        $order 						      	= new Order;
        $order->order_details               = $request->input('order_details');
		$order->user_id 			      	= Auth::id();
		$order->cart_ids 			      	= $cart_ids;
		$order->total_price 		      	= $total_price;
        $order->paytab_transation_id     	= $paytab_transaction_id;
		$order->address_id 					= $request->input("address_id");
		$order->final_price 				= $final_price;
		$order->order_status_id 			= $order_status;
        $order->estimated_time      		= $estimated_time;
        $order->image               		= $image_url;
        $order->payment_method      		= $payment_method;
        $order->discount_percent            = $discount_percent;
        $order->discount_amount             = $discount_amount;
        $order->promo_code                  = $only_promo_code;
		$order->save();
        if ($order) {

        $order_status_obj               = OrderStatus::first();

        $OrderActivity                  = new OrderActivity;
        $OrderActivity->order_id        = $order->id;
        $OrderActivity->status          = $order_status_obj->order_status;
        $OrderActivity->status_arabic   = $order_status_obj->order_status_arabic;
        $OrderActivity->save();


            $data = [];
            $data['id'] = $order->id;
            $data['estimated_time'] = $estimated_time;
            return response()->json($data);
        }else{
            return response()->json(
                ['message' => "Failed"]
            );
        }
    }


    public function history()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return response()->json($orders);
    }

    public function order_detail($order_id)
    {
        $data = [];
        $activity = [];

        $order = Order::where('id', $order_id)->first();
        $order_status = OrderStatus::get();
        $order_status_data = [];
        foreach ($order_status as $single_order_status) {
            $status = [];
            $status['id']           = $single_order_status->id;
            $status['name']         = $single_order_status->order_status;
            $status['arabic_name']  = $single_order_status->order_status_arabic;
            if ($order->order_status >= $single_order_status->id) {
                $status['status']   = 1;
            }else{
                $status['status']   = 0;
            }
            array_push($order_status_data, $status);
        }


        $data = [];
        $data['id']                     = $order->id;
        $data['order']                  = $order;
        $data['orderDate']              = $order->created_at;
        $data['status']                 = $order_status_data;
        $data['activity']               = OrderActivity::where('order_id', $order_id)->get();;
        return response()->json($data);
    }

    public function restuarant_customer_order_detail($id)
    {
        $restuarant_customer_order = RestuarentCustomerOrder::where('id', $id)->first();
        return response()->json($restuarant_customer_order);
    }

    public function get_order_summary($city_id, $promo_code=null){

        $total_price = 0;
        $final_price = 0;
        $cart_ids = [];
        $cart=Cart::where('user_id', Auth::id())->where('is_cart', '1')->latest()->get();
        foreach ($cart as $single_cart) {
            $total_price = $total_price + ($single_cart->quantity*$single_cart->unit_price);
            array_push($cart_ids, $single_cart->id);
        }
        $cart_ids = implode(',', $cart_ids);
        $promo_code_cnt = PromoCode::where('code', $promo_code)->count();
        if (($promo_code != '') && ($promo_code_cnt != 0)) {
            $promo_code_row = PromoCode::where('code', $promo_code)->first();
            $only_promo_code = $promo_code_row->code;
            $discount_type = $promo_code_row->type; 
            $discount_percent = $promo_code_row->percent; 
            $discount_amount = $promo_code_row->amount;

            // if ($discount_type != "Amount") {
            //     $discount_amount = $total_price - (($total_price*100)/$discount_amount);
            // }

            if ($discount_type == "Amount") {
                $discount_amount = $discount_amount;
            }else{
                $discount_amount = ($total_price*$discount_percent)/100;
            }



            $valid_promo_code = $promo_code;
        }else{
            $valid_promo_code = '';
            $discount_amount = 0;
        }

        $shipping_fees  = City::where('id', $city_id)->first()->delivery_fees;
        $grand_total    =  $total_price - $discount_amount + $shipping_fees;

        $data = [];
        $data['promo_code']         = $valid_promo_code;
        $data['total_price']        = $total_price;
        $data['discount_amount']    = $discount_amount;
        $data['shipping_fees']      = $shipping_fees;
        $data['grand_total']        = $grand_total;
        return response()->json($data);

    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\DriverOrder;
use App\RestuarentCustomerOrder;
use App\User;
use App\Module;
use App\WorkerPlaceOrder;
use App\Order;
use App\OrderActivity;
use App\Store;
use App\Cart;
use App\Address;
use App\Product;
use App\Schedule;
use App\ServiceType;
use App\OrderStatus;
use App\Review;
use App\RelocationStoreOrder;

class CustomersController extends Controller
{
    public function customer_restuarent_orders($module)
    {

    	$id = Auth::id();
    	if($module == 'restaurant'){
    		$type = 'Restaurant';
	    	$customer_orders = RestuarentCustomerOrder::where('user_id', $id)->get();
    	}elseif($module == 'worker')
    	{
    		$type = 'Worker';
	    	$customer_orders = WorkerPlaceOrder::where('user_id', $id)->get();
    	}else{
    		$type = 'Store';
    		$customer_orders = Order::where('user_id', $id)->get();
    	}

    	return response()->json(
    		[
    			'customer_orders' => $customer_orders,
    			'type' => $type
    		]
    	);
    }

    public function restaurent_single_order($id)
    {
    	$single_restaurent_order = RestuarentCustomerOrder::where('id', $id)->first();
    	$driver = User::where('id', $single_restaurent_order->driver_id)->first();
    	$store = Store::where('id', $single_restaurent_order->store_id)->first();
    	return response()->json(
    		[
    			'single_restaurent_order' => $single_restaurent_order,
    			'driver'                  => $driver,
    			'store'                   => $store
    		]
    	);
    }

    public function worker_single_order($id)
    {
    	$single_worker_order = WorkerPlaceOrder::where('id', $id)->first();
    	$address = Address::where('id', $single_worker_order->address_id)->first();
    	$schedule = Schedule::where('id', $single_worker_order->schedule_time_id)->first();
    	$product_id = Cart::where('id', $single_worker_order->cart_ids)->first()->product_id;
    	$product = Product::where('id', $product_id)->first();
    	$order_status = OrderStatus::where('id', $single_worker_order->order_status_id)->first();
    	$service_type = ServiceType::where('id', $single_worker_order->service_type_id)->first();
    	return response()->json(
    		[
    			'single_worker_order' => $single_worker_order,
    			'address'             => $address,
    			'schedule'            => $schedule,
    			'product'             => $product,
    			'order_status'        => $order_status,
    			'service_type'        => $service_type
    		]
    	);

    }

    public function store_single_order($id)
    {
    	$single_store_order = Order::where('id', $id)->first();
    	$cart_ids = explode(',',$single_store_order->cart_ids);

    	$product_ids = Cart::whereIn('id', $cart_ids)->select('product_id')->get();

    	$products = Product::whereIn('id', $product_ids)->get();
    	$order_status = OrderStatus::where('id', $single_store_order->order_status_id)->first();
    	return response()->json(
    		[
    			'single_store_order' => $single_store_order,
    			'products'           => $products,
    			'order_status'       => $order_status
    		]
    	);
    }

    public function restaurentOrderComplete($id)
    {
    	$single_restaurent_order = RestuarentCustomerOrder::where('id', $id)->first();
    	$single_restaurent_order->is_completed = 1;
    	$single_restaurent_order->save();
    	return response()->json(['message' => 'Success']);
    }

    public function workerOrderComplete($id)
    {
    	$single_worker_order = WorkerPlaceOrder::where('id', $id)->first();
    	$single_worker_order->is_completed = 1;
    	$single_worker_order->save();
    	return response()->json(['message' => 'Success']);
    }

    public function order_review_submit(Request $request)
    {
    	$id = Auth::id();
    	if($request->type == 'Restaurant'){
    		$restaurent_order = RestuarentCustomerOrder::where('id', $request->input('order_id'))->first();

    		$review = new Review;
    		$review->user_id = $id;
    		$review->star = $request->input('star');
    		$review->review = $request->input('review');
    		$review->driver_id = $restaurent_order->driver_id;
    		$review->restaurent_customer_order_id = $restaurent_order->id;
    		$review->save();
    		return response()->json(['message' => 'Success']);
    	}elseif ($request->type == 'Worker') {
    		$worker_order = WorkerPlaceOrder::where('id', $request->input('order_id'))->first();

    		$review = new Review;
    		$review->user_id = $id;
    		$review->star = $request->input('star');
    		$review->review = $request->input('review');
    		$review->worker_place_order_id = $worker_order->id;
    		$review->save();
    		return response()->json(['message' => 'Success']);
    	}elseif ($request->type == 'Relocation') {
            $relocation_order = RelocationStoreOrder::where('id', $request->input('order_id'))->first();

            $review = new Review;
            $review->user_id = $id;
            $review->star = $request->input('star');
            $review->review = $request->input('review');
            $review->relocation_order_id = $relocation_order->id;
            $review->save();
            return response()->json(['message' => 'Success']);
        }else{
    		$store_order = Order::where('id', $request->input('order_id'))->first();

    		$review = new Review;
    		$review->user_id = $id;
    		$review->star = $request->input('star');
    		$review->review = $request->input('review');
    		$review->save();
    		return response()->json(['message' => 'Success']);
    	}
    }

    public function order_review_check($id, $type)
    {
    	if($type == 'Restaurant'){
    		$review = Review::where('restaurent_customer_order_id', $id)->count();
    		if($review > 0){
    			return response()->json([
	    			'already_reviewed' => 1
	    		]);
    		}
    		return response()->json([
    			'already_reviewed' => 0
    		]);
    	}elseif($type == 'Worker'){
    		$review = Review::where('worker_place_order_id', $id)->count();
    		if($review > 0){
    			return response()->json([
	    			'already_reviewed' => 1
	    		]);
    		}
    		return response()->json([
    			'already_reviewed' => 0
    		]);
    	}elseif($type == 'Relocation'){
            $review = Review::where('relocation_order_id', $id)->count();
            if($review > 0){
                return response()->json([
                    'already_reviewed' => 1
                ]);
            }
            return response()->json([
                'already_reviewed' => 0
            ]);
        }
    }

    public function restaurant_place_order(Request $request)
    {
        $paytab_transaction_id = null;
        if($request->input("payment_method") == "COD"){
            $payment_method = 'COD';
        }else{
            $payment_method = 'Paytab';
            $paytab_transaction_id = $request->input("paytab_transaction_id");
        }

        $restaurentOrder                              = RestuarentCustomerOrder::where('id', $request->input('selected_restaurent_order_id'))->first();
        $restaurentOrder->paytab_transaction_id       = $paytab_transaction_id;
        $restaurentOrder->payment_method              = $payment_method;
        $restaurentOrder->is_completed                = $request->input("is_complete");
        $restaurentOrder->save();
        if ($restaurentOrder) {

        $order_status_obj               = OrderStatus::first();

        $OrderActivity                  = new OrderActivity;
        $OrderActivity->order_id        = $restaurentOrder->id;
        $OrderActivity->status          = $order_status_obj->order_status;
        $OrderActivity->status_arabic   = $order_status_obj->order_status_arabic;
        $OrderActivity->save();


            $data = [];
            $data['id'] = $restaurentOrder->id;
            return response()->json($data);
        }else{
            return response()->json(
                ['message' => "Failed"]
            );
        }
    }

    public function receipt_download($id)
    {
        $order = RestuarentCustomerOrder::findOrFail($id);
        return response()->json($order);
    }
}

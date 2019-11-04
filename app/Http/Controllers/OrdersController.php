<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\DriverOrder;
use App\DriverOrderData;
use App\Order;
use App\Store;
use App\Module;
use App\Category;
use App\Product;
use App\PromoCode;
use Auth;
use Illuminate\Http\Request;
use App\Address;
use App\State;
use App\City;
use App\Country;
use App\Cart;
use App\OrderStatus;
use App\OrderActivity;
use App\RestuarentCustomerOrder;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $orders = Order::where('order_details', 'LIKE', "%$keyword%")
                ->orWhere('promo_code', 'LIKE', "%$keyword%")
                ->orWhere('image', 'LIKE', "%$keyword%")
                ->orWhere('delivery_time', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $orders = Order::latest()->paginate($perPage);
        }

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
      
        $module = Module::where('name', 'Restaurant')->first();

        if(isset($module) != null){
            $stores     = Store::where('module_id', $module->id)->pluck('name', 'id');
        }else{
            $stores     = [];
        }
        
        return view('orders.create', compact('stores'));
    }    
    public function createDriver()
    {
      
        $module = Module::where('name', 'Restaurant')->first();

        if(isset($module) != null){
            $stores     = Store::where('module_id', $module->id)->pluck('name', 'id');
        }else{
            $stores     = [];
        }
        
        return view('orders.create-driver', compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function check_promo_code($code){
        $id = Auth::id();
        $count_code_by_user = DriverOrder::where('user_id', $id)->where('promo_code', $code)->count();
        if($count_code_by_user == 0){
            $code = PromoCode::where('code', $code)->first();
            if($code != null){
                return $code;
            }else{

                return 'not_found'; 
            }
        }else{
            return 'used';
        }
    }

    public function store(Request $request)
    {

        if($request->hasFile('receipt')){
            $image              = $request->file('receipt');
            $image_name         = uniqid().'.'.strtolower($image->getClientOriginalExtension());
            $path               = 'order-image/';
            $image_url          = $path.$image_name;
            $image->move($path,$image_name);
        }else{
            $image_url  = null;
        }
        $restuarent_customer_orders_id        = $request->unique_code;
        $RestuarentCustomerOrder              = RestuarentCustomerOrder::find($restuarent_customer_orders_id);
        $RestuarentCustomerOrder->driver_id   = Auth::id();
        $RestuarentCustomerOrder->offer_price = $request->offer_price;
        $RestuarentCustomerOrder->receipt     = $image_url;
        $RestuarentCustomerOrder->save();


        return redirect('driver-orders')->with('success', 'Order added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);

        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        if($request->hasFile('image')){
            $image              = $request->file('image');
            $image_name         = uniqid().'.'.strtolower($image->getClientOriginalExtension());
            $path               = 'order-image/';
            $image_url          = $path.$image_name;
            $image->move($path,$image_name);
            if($order->image != null){
                unlink($order->image);
            }
        }else{
            $image_url  = $order->image;
        }

        $order->order_details   = $request->order_details;
        $order->promo_code      = $request->promo_code;
        $order->delivery_time   = $request->delivery_time;
        $order->image           = $image_url;
        $order->save();

        return redirect('orders')->with('success', 'Order updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        if($order->image != null){
            unlink($order->image);
        }
        Order::destroy($id);

        return redirect('orders')->with('success', 'Order deleted!');
    }

    public function orderDetails($user_id, $store_id)
    {
      // $url      = env('MAIN_HOST_URL').'api/get-product-detail/'.$id;
      // $method   = 'GET';
      // $product  = $this->callApi($method, $url);
      return view('front-end.order.order-details', compact('user_id', 'store_id'));
    }
    public function orderNotification()
    {
      return view('front-end.order.order-notification');
    }

    public function orderDeliveryTime()
    {
      return view('front-end.order.order-delivery-time');
    }
    public function placeOrder()
    {
      return view('front-end.order.place-order');
    }

    



}

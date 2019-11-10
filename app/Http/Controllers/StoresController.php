<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Store;
use App\SubCategory;
use App\Category;
use App\Module;
use App\DriverOrder;
use App\DriverOrderData;
use App\Product;
use App\Order;
use App\StoreOrderData;
use App\WorkerPlaceOrder;
use App\RestuarentCustomerOrder;
use App\User;
use App\Cart;
use App\Address;
use App\Schedule;
use App\ServiceType;
use App\OrderStatus;
use Illuminate\Http\Request;
use Auth;
use App\City;
use App\State;
use App\Country;

class StoresController extends Controller
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
        $id = Auth::id();
        if (!empty($keyword)) {
            $stores = Store::where('sub_category_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('name_arabic', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('preview_image', 'LIKE', "%$keyword%")
                ->orWhere('multiple_images', 'LIKE', "%$keyword%")
                ->orWhere('lat', 'LIKE', "%$keyword%")
                ->orWhere('lan', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $stores = Store::where('store_owner_id', $id)->latest()->paginate($perPage);
        }
        $subcategories = SubCategory::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $modules = Module::pluck('name', 'id');
        return view('stores.index', compact('stores', 'subcategories', 'categories', 'modules'));
    }

    public function orderShowByStoreId($id)
    {
        $perPage = 25;
        $driverorders = WorkerPlaceOrder::where('store_id', $id)->latest()->paginate($perPage);
        $stores = Store::pluck('name', 'id');
        $orderstatus = OrderStatus::pluck('order_status', 'id');
        return view('stores.order-list', compact('driverorders', 'stores', 'orderstatus'));
    }

    public function orderShow($id)
    {
        $single_worker_order = WorkerPlaceOrder::where('id', $id)->first();
        $schedule = Schedule::where('id', $single_worker_order->schedule_time_id)->first();
        $product_id = Cart::where('id', $single_worker_order->cart_ids)->first()->product_id;
        $product = Product::where('id', $product_id)->first();
        $order_status = OrderStatus::where('id', $single_worker_order->order_status_id)->first();
        $service_type = ServiceType::where('id', $single_worker_order->service_type_id)->first();
        return view('stores.single-order-show', compact('single_worker_order', 'schedule', 'product', 'order_status', 'service_type'));
    }

    public function orderShowByStoreOrderId($id)
    {
        $perPage = 25;
        $storeorders = StoreOrderData::where('store_id', $id)->pluck('order_id');
        $orders = Order::whereIn('id', $storeorders)->paginate($perPage);
        $orderstatus = OrderStatus::pluck('order_status', 'id');
        $store = Store::where('id', $id)->first();
        return view('stores.store-order-list', compact('orders', 'orderstatus', 'store'));
    }

    public function storeOrderShow($id)
    {
        $single_store_order = Order::where('id', $id)->first();
        $cart_ids = explode(',', $single_store_order->cart_ids);
        $user = User::where('id', $single_store_order->user_id)->first();
        $address = Address::where('id', $single_store_order->address_id)->first();
        $city = City::where('id', $address->city_id)->first();
        $state = State::where('id', $address->state_id)->first();
        $country = Country::where('id', $address->country_id)->first();
        $product_ids = Cart::whereIn('id',$cart_ids)->pluck('product_id');
        $products = Product::whereIn('id', $product_ids)->get();
        $order_status = OrderStatus::where('id', $single_store_order->order_status_id)->first();
        $stores = Store::pluck('name', 'id');
        return view('stores.single-store-order-show', compact('single_store_order', 'products', 'order_status', 'address', 'user', 'city', 'state', 'country', 'stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $subcategories = SubCategory::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $modules = Module::pluck('name', 'id');
        return view('stores.create', compact('subcategories', 'categories', 'modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        if($request->hasFile('preview_image')){
            $preview_image      = $request->file('preview_image');
            $preview_image_name = uniqid().'.'.strtolower($preview_image->getClientOriginalExtension());
            $preview_image_path = 'store-images/';
            $preview_image_url  = $preview_image_path.$preview_image_name;
            $preview_image->move($preview_image_path,$preview_image_name);
        }else{
            $preview_image_url  = null;
        }

        if($request->hasFile('multiple_images')){
            $multi_images      = $request->file('multiple_images');

            foreach($multi_images as $image)
            {
                $multi_image_name = uniqid().'.'.strtolower($image->getClientOriginalExtension());
                $multi_image_path = 'store-images/';
                $multi_image_url  = $multi_image_path.$multi_image_name;
                $image->move($multi_image_path, $multi_image_name);
                $data[] = $multi_image_url;  
            }
        }else{
            $data[]  = null;
        }
        
        $store                          = new Store();
        $store->sub_category_id         = $request->sub_category_id;
        $store->category_id             = $request->category_id;
        $store->module_id               = $request->module_id;
        $store->name                    = $request->name;
        $store->name_arabic             = $request->name_arabic;
        $store->description             = $request->description;
        $store->arabic_description      = $request->arabic_description;
        $store->lat                     = $request->lat;
        $store->lan                     = $request->lan;
        $store->status                  = $request->status;
        $store->store_owner_id          = Auth::user()->id;
        $store->preview_image           = $preview_image_url;
        if($data[0] == null){
            $data_img = null;
        }else{
            $data_img = implode(',', $data);
        }
        // dd($data_img);
        $store->multiple_images         = $data_img;
        $store->location                = $request->location;
        $store->arabic_location         = $request->arabic_location;
        $store->save();

        return redirect('stores')->with('success', 'Store added!');
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
        $store = Store::findOrFail($id);
        $subcategories = SubCategory::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $modules = Module::pluck('name', 'id');
        return view('stores.show', compact('store', 'subcategories', 'categories', 'modules'));
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
        $subcategories = SubCategory::pluck('name', 'id');
        $store = Store::findOrFail($id);
        $categories = Category::pluck('name', 'id');
        return view('stores.edit', compact('store', 'subcategories', 'categories'));
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
        
        $store = Store::findOrFail($id);
        if($request->hasFile('preview_image')){
            $preview_image      = $request->file('preview_image');
            $preview_image_name = uniqid().'.'.strtolower($preview_image->getClientOriginalExtension());
            $preview_image_path = 'store-images/';
            $preview_image_url  = $preview_image_path.$preview_image_name;
            $preview_image->move($preview_image_path,$preview_image_name);
            if($store->preview_image != null){
                unlink($store->preview_image);
            }
        }else{
            $preview_image_url  = $store->preview_image;
        }

        if($request->hasFile('multiple_images')){
            $multi_images      = $request->file('multiple_images');

            foreach($multi_images as $image)
            {
                $multi_image_name = uniqid().'.'.strtolower($image->getClientOriginalExtension());
                $multi_image_path = 'store-images/';
                $multi_image_url  = $multi_image_path.$multi_image_name;
                $image->move($multi_image_path, $multi_image_name);
                $data[] = $multi_image_url;  
            }
            if($store->multiple_images != null){
                $multiple_img = explode(',', $store->multiple_images);
                foreach($multiple_img as $img)
                {
                    unlink($img);
                }
            }
        }else{
            $data[]  = $store->multiple_images;
        }
        

        $store->sub_category_id         = $store->sub_category_id;
        $store->category_id             = $store->category_id;
        $store->module_id             = $store->module_id;
        $store->name                    = $request->name;
        $store->name_arabic             = $request->name_arabic;
        $store->description             = $request->description;
        $store->arabic_description      = $request->arabic_description;
        $store->lat                     = $request->lat;
        $store->lan                     = $request->lan;
        $store->status                  = $request->status;
        $store->store_owner_id          = Auth::user()->id;
        $store->preview_image           = $preview_image_url;
        if($data[0] == null){
            $data_img = null;
        }else{
            $data_img = implode(',', $data);
        }
        // dd($data_img);
        $store->multiple_images         = $data_img;
        $store->location                = $request->location;
        $store->arabic_location         = $request->arabic_location;
        $store->save();

        return redirect('stores')->with('success', 'Store updated!');
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
        $store = Store::findOrFail($id);
        if($store->preview_image != null){
            unlink($store->preview_image);
        }
        if($store->multiple_images != null){
            $multiple_img = explode(',', $store->multiple_images);
            foreach($multiple_img as $img)
            {
                unlink($img);
            }
        }
        Store::destroy($id);

        return redirect('stores')->with('success', 'Store deleted!');
    }

    public function orderDelete($id)
    {
        WorkerPlaceOrder::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Order Deleted');
    }

    public function storeOrderDelete($id)
    {
        $order = Order::findOrFail($id);
        if($order->image != null){
            unlink($order->image);
        }
        Order::destroy($id);
        StoreOrderData::where('order_id', $id)->delete();
        return redirect()->back()->with('success', 'Order Deleted');
    }
}

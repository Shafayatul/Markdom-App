<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use App\RestuarentCustomerOrder;
use App\Store;

class RestaurantsController extends Controller
{
    public function index()
    {

      $url                    = env('MAIN_HOST_URL').'api/get-categories-by-module/1';
      $method                 = 'GET';
      $categories             = $this->callApi($method, $url);

      $url                    = env('MAIN_HOST_URL').'api/get-offers-by-module/1';
      $method                 = 'GET';
      $offers                 = $this->callApi($method, $url);

      return view('front-end.restaurant.index', compact('categories', 'offers'));
    }

    public function subCategoryRestaurant($id)
    {
      $url                    = env('MAIN_HOST_URL').'api/get-subcategories-by-category/'.$id;
      $method                 = 'GET';
      $sub_categories         = $this->callApi($method, $url);

      $url                    = env('MAIN_HOST_URL').'api/get-store-by-category/'.$id;
      $method                 = 'GET';
      $stores                 = $this->callApi($method, $url);

      return view('front-end.restaurant.sub-category-restaurant', compact('sub_categories', 'stores'));
    }

    public function restaurantDetails($id)
    {

      $current_date           = Carbon::now()->format('Y-m-d');
      $current_time           = time();

      $url_store              = env('MAIN_HOST_URL').'api/get-store-detail/'.$id;
      $method_method          = 'GET';
      $store                  = $this->callApi($method_method, $url_store);

      $url_product            = env('MAIN_HOST_URL').'api/get-product-by-store/'.$id;
      $method_product         = 'GET';
      $products               = $this->callApi($method_product, $url_product);

      $url_review             = env('MAIN_HOST_URL').'api/get-review-by-store/'.$id;
      $method_review          = 'GET';
      $review                 = $this->callApi($method_review, $url_review);

      $url_workinghours       = env('MAIN_HOST_URL').'api/get-workinghours/'.$id.'/'.$current_date;
      $method_workinghours    = 'GET';
      $slot                   = $this->callApi($method_workinghours, $url_workinghours);

      $is_available           = false;
      foreach ($slot as $row) {
        $time_ary             = explode('-', $row->timespan);

        $d1                   = new DateTime($time_ary[0].':00', new DateTimeZone('Asia/Riyadh'));
        $t1                   = $d1->getTimestamp();

        $d2                   = new DateTime($time_ary[1].':00', new DateTimeZone('Asia/Riyadh'));
        $t2                   = $d2->getTimestamp();

        if (($t1 <= $current_time) && ($t2 > $current_time)) {
          if ($row->is_booked == 0) {
            $is_available     = true;
          }
        }
      }
      // dd($store);
      return view('front-end.restaurant.restaurant-details', compact('store', 'products', 'review', 'is_available'));
    }

    public function customerOrder(Request $request)
    {
        if($request->hasFile('image')){
            $image              = $request->file('image');
            $image_name         = uniqid().'.'.strtolower($image->getClientOriginalExtension());
            $path               = 'customer-order-image/';
            $image_url          = $path.$image_name;
            $image->move($path,$image_name);
        }else{
            $image_url  = null;
        }

        $url_store    = env('MAIN_HOST_URL').'api/get-store-detail/'.$request->store_id;
        $method_store = 'GET';
        $store        = $this->callApi($method_store, $url_store);
        
        $restuarent_customer_order                = new RestuarentCustomerOrder();
        $restuarent_customer_order->user_id       = $request->user_id;
        $restuarent_customer_order->store_id      = $request->store_id;
        $restuarent_customer_order->order_details = $request->order_details;
        $restuarent_customer_order->image         = $image_url;
        $restuarent_customer_order->is_accepted   = 0;
        $restuarent_customer_order->save();

        return view('front-end.chat.waiting', compact('restuarent_customer_order', 'store'));
    }

    public function see_order_detail_by_driver($id)
    {
        $url_restuarant_customer_order    = env('MAIN_HOST_URL').'api/restuarant-customer-order-detail/'.$id;
        $method_restuarant_customer_order = 'GET';
        $restuarant_customer_order        = $this->callApi($method_restuarant_customer_order, $url_restuarant_customer_order);

        $url_customer    = env('MAIN_HOST_URL').'api/customer-detail/'.$restuarant_customer_order->user_id;
        $method_customer = 'GET';
        $customer        = $this->callApi($method_customer, $url_customer);

        
        $url_store    = env('MAIN_HOST_URL').'api/get-store-detail/'.$restuarant_customer_order->store_id;
        $method_store = 'GET';
        $store        = $this->callApi($method_store, $url_store);
      return view('front-end.order.see-customer-order-detail', compact('customer', 'store', 'id', 'restuarant_customer_order'));
    }

}

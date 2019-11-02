<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Session;
use Log;
use App\Product;

class WorkerController extends Controller
{

    public function index()
    {
      $url = env('MAIN_HOST_URL').'api/get-stores-by-module-id/2';
      $method = 'GET';
      $stores = $this->callApi($method, $url);

      $url        = env('MAIN_HOST_URL').'api/get-offers-by-module/2';
      $method     = 'GET';
      $offers     = $this->callApi($method, $url);

      return view('front-end.workers.index', compact('stores', 'offers'));
    }

    public function service_category_show_by_store_id($store_id)
    {
      $url                = env('MAIN_HOST_URL').'api/get-service-category-by-store/'.$store_id;
      $method             = 'GET';
      $service_categories = $this->callApi($method, $url);
      return view('front-end.workers.service-category-worker', compact('service_categories'));
    }

    // public function subCategoryWorker($id)
    // {
    //   $url_category = env('MAIN_HOST_URL').'api/get-subcategories-by-category/'.$id;
    //   $method_category = 'GET';
    //   $subCategories = $this->callApi($method_category, $url_category);

    //   $url    = env('MAIN_HOST_URL').'api/get-store-by-category/'.$id;
    //   $method = 'GET';
    //   $stores = $this->callApi($method, $url);
    //   // dd($stores);
    //   return view('front-end.workers.sub-category-worker', compact('subCategories', 'stores'));
    // }

    public function workerServiceTime($id, $date = null){
      // dd($id);
      if($date == null){
        $current_date           = Carbon::now()->format('Y-m-d');
      }else{
        $current_date           = $date;
      }

      $current_time           = time();

      $lang = app()->getLocale();

      $url_workinghours       = env('MAIN_HOST_URL').'api/get-workinghours/'.$id.'/'.$current_date;
      $method_workinghours    = 'GET';
      $slot                   = $this->callApi($method_workinghours, $url_workinghours);
      
      $url_schedule           = env('MAIN_HOST_URL').'api/get-all-schedule-type-by-lang/'.$lang;
      $method_schedule        = 'GET';
      $schedules              = $this->callApi($method_schedule, $url_schedule);
      // dd($slot);

      $product_id = Session::get('selected_product_id');
      return view('front-end.workers.worker-delivery-time', compact('id', 'slot', 'schedules', 'current_date', 'product_id'));
      

    }

    // public function workerDetails($id)
    // {
    
    //   $url      = env('MAIN_HOST_URL').'api/get-store-detail/'.$id;
    //   $method   = 'GET';
    //   $store    = $this->callApi($method, $url);

      

    //   $url      = env('MAIN_HOST_URL').'api/get-review-by-store/'.$id;
    //   $method   = 'GET';
    //   $review   = $this->callApi($method, $url);

    //   $url                = env('MAIN_HOST_URL').'api/get-service-category-by-store/'.$id;
    //   $method             = 'GET';
    //   $service_categories = $this->callApi($method, $url);

    //   return view('front-end.workers.worker-details', compact('store', 'review', 'service_categories'));
    // }

    // public function subSubCategoryWorker($id)
    // {
    //   $url_sub_category = env('MAIN_HOST_URL').'api/get-sub-subcategories-by-sub-category/'.$id;
    //   $method_sub_category = 'GET';
    //   $subSubCategories = $this->callApi($method_sub_category, $url_sub_category);
    //   // dd($subSubCategories);
    //   return view('front-end.workers.sub-sub-category-worker');
    // }

    // public function workerServiceDelivery()
    // {
    //   return view('front-end.workers.worker-service-delivery');
    // }

    public function serviceSubCategoryWorker($id)
    {
      $url                        = env('MAIN_HOST_URL').'api/get-service-sub-category-by-service-category/'.$id;
      $method                     = 'GET';
      $service_sub_categories     = $this->callApi($method, $url);
      return view('front-end.workers.service-sub-category-worker', compact('service_sub_categories'));
    }

    public function serviceSubSubCategoryWorker($id)
    {
      Session::put('service_sub_cat_id', $id);
      $url      = env('MAIN_HOST_URL').'api/get-service-sub-sub-category-by-service-sub-category/'.$id;
      $method   = 'GET';
      $service_sub_sub_categories = $this->callApi($method, $url);
      return view('front-end.workers.service-sub-sub-category-worker', compact('service_sub_sub_categories'));
    }

    public function productByServiceSubSubCategory($id)
    {
      $service_sub_cat_id = Session::get('service_sub_cat_id');
      $url      = env('MAIN_HOST_URL').'api/get-products-by-service-sub-sub-category/'.$id;
      $method   = 'GET';
      $services = $this->callApi($method, $url);

      $url      = env('MAIN_HOST_URL').'api/get-service-sub-sub-category-by-service-sub-category/'.$service_sub_cat_id;
      $method   = 'GET';
      $service_sub_sub_categories = $this->callApi($method, $url);
      // dd($service_sub_sub_categories);
      return view('front-end.workers.product-view-by-service-sub-sub-category', compact('services', 'service_sub_sub_categories'));
    }

    public function workerProductDetails($id)
    {
      if ($this->check_expiration()) {

        $url      = env('MAIN_HOST_URL').'api/get-product-detail/'.$id;
        $method   = 'GET';
        $product = $this->callApi($method, $url);

        $url      = env('MAIN_HOST_URL').'api/add-to-cart';
        $method   = 'POST';
        $headers  = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
          ];
        $parameters = [
          'product_id'      => $id,
          'quantity'        => '1',
          'module_id'       => $product->module_id
        ];
        $body = $this->callApi($method, $url, $parameters, $headers);
        Session::put('selected_store_id', $product->store_id);
        Session::put('selected_product_id', $id);

      $url_service_type_price     = env('MAIN_HOST_URL').'api/get-service-type-price/'.$id;
      $method_service_type_price  = 'GET';
      $service_type_prices        = $this->callApi($method_service_type_price, $url_service_type_price);
      return view('front-end.workers.worker-service-delivery', compact('service_type_prices', 'product'));
      }else{
        return redirect('/user-login');
      }
    }

    public function workerSaveServiceType($id)
    {
      $store_id = Session::get('selected_store_id');
      Session::put('selected_service_type_id', $id);
      return redirect('/worker-service-time/'.$store_id);
    }

    public function workerScheduleTime($id)
    {
      Session::put('selected_service_schedule_id', $id);
      return redirect('/worker-address');
    }

    public function addressAdd($address_id)
    {
      $product_id = Session::get('selected_product_id');
      Session::put('address_id', $address_id);
      return redirect('/worker-place-holder/'.$product_id);
    }

    // public function workercart()
    // {
    //   //
    // }

    public function workerPlaceOrder($product_id)
    {
      // $product = Product::where('id', $product_id)->first();
      if ($this->check_expiration()) {
        $url      = env('MAIN_HOST_URL').'api/get-product-detail/'.$product_id;
        $method   = 'GET';
        $product = $this->callApi($method, $url);
        // dd($product);

        $url = env('MAIN_HOST_URL').'api/view-cart/'.$product->module_id;
        $method = 'GET';
        $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
          ];
        $body = $this->callApi($method, $url, [], $headers);

        $user_url     = env('MAIN_HOST_URL').'api/user-details';
        $user_method  = 'GET';
        $user_headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
          ];
        $user = $this->callApi($user_method, $user_url, [], $user_headers);
        $address_id = Session::get('address_id');

        if($address_id != null || $address_id != ''){
            $single_addres_url = env('MAIN_HOST_URL').'api/get-single-address/'.$address_id;
            $single_addres_method = 'GET';
            $single_addres_headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
            ];
            $single_address = $this->callApi($single_addres_method, $single_addres_url, [], $single_addres_headers);
        }else{
          $single_address = null;
        }

        // dd($single_address);
        $schedule_timspan_id = Session::get('selected_service_schedule_id');
        $service_type_id     = Session::get('selected_service_type_id');

        return view('front-end.workers.worker-place-order', compact('body', 'user', 'schedule_timspan_id', 'single_address', 'address_id', 'service_type_id'));
      }else{
        return redirect('/user-login');
      }
    }

    // public function workerNotification()
    // {
    //   return view('front-end.workers.worker-notification');
    // }

    // public function addToCartService($id)
    // {
    //   $product = Product::where('id', $id)->first();
    //   if ($this->check_expiration()) {
    //     $url      = env('MAIN_HOST_URL').'api/add-to-cart';
    //     $method   = 'POST';
    //     $headers  = [
    //           'Authorization' => 'Bearer ' . Session::get('access_token'),
    //           'Accept'        => 'application/json',
    //       ];
    //     $parameters = [
    //       'product_id'      => $id,
    //       'quantity'        => '1',
    //       'module_id'       => $product->module_id
    //     ];
    //     $body = $this->callApi($method, $url, $parameters, $headers);
    //     return redirect('/worker-place-holder/'.$id);
    //   }else{
    //     return redirect('/user-login');
    //   }
    // }

    public function check_expiration(){
      $remaining_time = Session::get('expires_at')-time();
      if ($remaining_time>0) {
        return true;
      }
      return false;
    }

    //Address Section
    public function addressesView()
    {
      $module_id = Session::get('module_id');
      $address_method = 'GET';
      $address_url = env('MAIN_HOST_URL').'api/get-addresses';
      $address_headers = [
            'Authorization' => 'Bearer ' . Session::get('access_token'),
            'Accept'        => 'application/json',
        ];
      $address = $this->callApi($address_method, $address_url, [], $address_headers);
      return view('front-end.workers.address', compact('address', 'module_id'));
    }

    public function addressView()
    {
      $url_country = env('MAIN_HOST_URL').'api/country-list';
      $method_country = 'GET';
      $country = $this->callApi($method_country, $url_country);
      return view('front-end.workers.add-address', compact('country'));
    }

    public function addressSubmit(Request $request)
    {
      if ($this->check_expiration()) {
      $url = env('MAIN_HOST_URL').'api/add-address';
      $method = 'POST';
      $headers = [
            'Authorization' => 'Bearer ' . Session::get('access_token'),
            'Accept'        => 'application/json',
        ];
      $parameters = [
            'flat_no'       => $request->flat_no,
            'location'      => $request->location,
            'country_id'    => $request->country_id,
            'state_id'      => $request->state_id,
            'city_id'       => $request->city_id,
            'pin_code'      => $request->pin_code,
            'phone_no'      => $request->phone_no

          ];
      $body = $this->callApi($method, $url, $parameters, $headers);
      return redirect('/worker-address');
      }else{
        return redirect('/user-login');
      }
    }

    public function workerOrderSubmit(Request $request)
    {
      if ($this->check_expiration()) {
      $url = env('MAIN_HOST_URL').'api/worker-place-order';
      $method = 'POST';
      $headers = [
            'Authorization' => 'Bearer ' . Session::get('access_token'),
            'Accept'        => 'application/json',
        ];
      $parameters = [
            'schedule_time_id' => $request->schedule_time_id,
            'service_type_id'  => $request->service_type_id,
            'address_id'       => $request->address_id,
            'promo_code'       => $request->promo_code

          ];
      $body = $this->callApi($method, $url, $parameters, $headers);
      return view('front-end.workers.worker-notification', compact('body'));
    }else{
      return redirect('/user-login');
    }
  }
}

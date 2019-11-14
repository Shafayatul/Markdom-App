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
use Paytabs;

class WorkerController extends Controller
{

    public function index()
    {

      $worker = 'Worker';
      $url = env('MAIN_HOST_URL').'api/get-module/'.$worker;
      $method = 'GET';
      $module = $this->callApi($method, $url);

      $url = env('MAIN_HOST_URL').'api/get-stores-by-module-id/'.$module->id;
      $method = 'GET';
      $stores = $this->callApi($method, $url);

      $url        = env('MAIN_HOST_URL').'api/get-offers-by-module/'.$module->id;
      $method     = 'GET';
      $offers     = $this->callApi($method, $url);

      return view('front-end.workers.index', compact('stores', 'offers'));
    }

    public function service_category_show_by_store_id($store_id)
    {
      $url                = env('MAIN_HOST_URL').'api/get-service-category-by-store/'.$store_id;
      $method             = 'GET';
      $service_categories = $this->callApi($method, $url);
      // dd($service_categories);
      return view('front-end.workers.service-category-worker', compact('service_categories'));
    }
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
      // dd($service_sub_sub_categories);
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

      $url_service_type_price     = env('MAIN_HOST_URL').'api/get-service-type-price';
      $method_service_type_price  = 'GET';
      $service_type_prices        = $this->callApi($method_service_type_price, $url_service_type_price);
        // dd($service_type_prices);
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
        // dd($schedule_timspan_id, $service_type_id);

        return view('front-end.workers.worker-place-order', compact('body', 'user', 'schedule_timspan_id', 'single_address', 'address_id', 'service_type_id'));
      }else{
        return redirect('/user-login');
      }
    }


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

    public function workerPaymentMethodView()
    {
      $result = null;
      return view('front-end.workers.payment-method', compact('result'));
    }

    public function ajaxCodSubmit(Request $request)
    {
      if ($this->check_expiration()) {
        $method = "POST";
        $url = env("MAIN_HOST_URL")."api/worker-place-order";
        $parameters = [
            'payment_method'      => 'COD',
            'address_id'          => $request->address_id,
            'promo_code'          => $request->promo_code,
            'schedule_timspan_id' => $request->schedule_timspan_id,
            'service_type_id'     => $request->service_type_id,
        ];
        $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
        ];
        $response = $this->callApi($method, $url, $parameters, $headers);
        // dd($response);
        return response()->json(['msg'=>'Success','response' =>$response]);
      }else{
        return redirect('/login');
      }
    }

    public function workerBankPlaceOrder(Request $request)
    {
      if ($this->check_expiration()) {

        if($request->payment_method == 'Bank Transfer'){
          if($request->hasFile('image')){
              $image = $request->file('image');
              // dd($image);
              $image_fullname = uniqid().'.'.strtolower($image->getClientOriginalExtension());
              $path = 'uploads/';
              $image_url = $path.$image_fullname;
              $image->move($path,$image_fullname);
          }else{
            $image_url = null;
          }
        }else{
           $image_url = null;
        }
        
        $method = "POST";
        $url = env("MAIN_HOST_URL")."api/worker-place-order";
        $parameters = [
            'address_id'            => $request->address_id,
            'promo_code'            => $request->promo_code,
            'payment_method'        => $request->payment_method,
            'paytab_transaction_id' => $request->paytab_transaction_id,
            'schedule_timspan_id'   => $request->schedule_timspan_id,
            'service_type_id'       => $request->service_type_id,
            'bank_image'            => $image_url
        ];
        $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
        ];

        $body = $this->callApi($method, $url, $parameters, $headers);

        return redirect('/worker-notification/'.$body->order->id);
      }else{
        return redirect('/user-login');
      }
    }


    public function workerNotification($id)
    {
      // dd($id);
      if($this->check_expiration()){
          $url = env('MAIN_HOST_URL').'api/worker-order-details/'.$id;
          $method = 'GET';
          $headers = [
                'Authorization' => 'Bearer ' . Session::get('access_token'),
                'Accept'        => 'application/json',
            ];
          $body = $this->callApi($method, $url, [], $headers);
          return view('front-end.workers.worker-notification', compact('body'));
      }else{
        return redirect('/user-login');
      }
        
    }

    public function paytabsPayment()
    {

      $worker = 'Worker';
      $url = env('MAIN_HOST_URL').'api/get-module/'.$worker;
      $method = 'GET';
      $module = $this->callApi($method, $url);

      $grand_total;
      $current_user;
      $single_address;
      $single_product;
      $carts;
      $product_name;
      $product_price;
      $product_quantity;



      $address_id = Session::get('address_id');
      // dd($address_id);

      if ($this->check_expiration()) {

        $url = env('MAIN_HOST_URL').'api/user-details';
        $method = 'GET';
        $headers = [
          'Authorization' => 'Bearer ' . Session::get('access_token'),
          'Accept'        => 'application/json',
        ];
        $current_user = $this->callApi($method, $url, [], $headers);

        $url = env('MAIN_HOST_URL').'api/get-single-address/'.$address_id;
        $method = 'GET';
        $headers = [
          'Authorization' => 'Bearer ' . Session::get('access_token'),
          'Accept'        => 'application/json',
        ];
        $single_address = $this->callApi($method, $url, [], $headers);

        $shipping_charge = $single_address->city->delivery_fees;

        $url = env('MAIN_HOST_URL').'api/view-cart/'.$module->id;
        $method = 'GET';
        $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
          ];
        $carts = $this->callApi($method, $url, [], $headers);
        $cnt = 0;
        foreach ($carts as $cart) {
          $cnt = $cnt + $cart->total_price;
        }
        $grand_total = $cnt+$shipping_charge;

        $product_name = '';
        $product_price = '';
        $product_quantity = '';
        foreach($carts as $cart){
          $product_name .=  $cart->product_name.' || ';
          $product_quantity.=  $cart->quantity.' || ';
          $url = env('MAIN_HOST_URL').'api/get-product-detail/'.$cart->product_id;
          $method = 'GET';
          $headers = [
                'Authorization' => 'Bearer ' . Session::get('access_token'),
                'Accept'        => 'application/json',
            ];
          $single_product = $this->callApi($method, $url, [], $headers);
          // dd($single_product);
          $product_price.=  $single_product->price.' || ';

          if($single_product->is_offer == 1){
            if($single_product->offer_type == 'Amount'){
                $product_price = $single_product->offer_amount;
            }else{
                $product_price = $single_product->price*$single_product->offer_percent/100;
            }
        }
        }

        }

      $name = $current_user->name;
      $email = $current_user->email;
      // $phone = $current_user->phone;
      $cc_phone_number = $single_address->country->code_arabic;

      $billing_address = $single_address->flat_no.' '.$single_address->location;
      // dd($billing_address);
      $city = $single_address->city->name;
      $state = $single_address->state->name;
      $postal_code = $single_address->pin_code;
      $country = $single_address->country->code;


      $arr_name = explode(" ", $name);
      $last_word  = $arr_name[count($arr_name)-1];
      $count_name_arr = count($arr_name);

      if($count_name_arr > 2){
          $first_name = $arr_name[0];
          $last_name = $last_word;

      }elseif ($count_name_arr == 2) {
          $first_name = $arr_name[0];
          $last_name = $arr_name[1];
      }else{
          $first_name = $arr_name[0];
          $last_name = 'ABCD';
      }

      $product_names = rtrim($product_name,' || ');
      $product_prices = rtrim($product_price,' || ');
      $product_quantities = rtrim($product_quantity,' || ');
      $shipping_charge = $single_address->city->delivery_fees;

      // dd($product_prices);
    $pt = Paytabs::getInstance(env("MERCHANT_EMAIL"), env("MERCHANT_SECRET"));
      // dd($pt);
    $result = $pt->create_pay_page(array(
      "merchant_email" => env("MERCHANT_EMAIL"),
      'secret_key' => env("MERCHANT_SECRET"),
      'title' => "Bill To ".$name,
      'cc_first_name' => $first_name,
      'cc_last_name' => $last_name,
      'email' => $email,
      'cc_phone_number' => $cc_phone_number,
      'phone_number' => '+8801751837757',
      'billing_address' => $billing_address,
      'city' => $city,
      'state' => $state,
      'postal_code' => $postal_code,
      'country' => $country,
      'address_shipping' => $billing_address,
      'city_shipping' => $city,
      'state_shipping' => $state,
      'postal_code_shipping' => $postal_code,
      'country_shipping' => $country,
      "products_per_title"=> $product_names,
      'currency' => "SAR",
      "unit_price"=> $product_prices,
      'quantity' => $product_quantities,
      'other_charges' => $shipping_charge,
      'amount' => $grand_total,
      'discount'=>"0",
      "msg_lang" => "en",
      "reference_no" => "1231231",
      "site_url" => "http://webencoder.space/demo/demo61/public/",
      'return_url' => "http://webencoder.space/demo/demo61/public/worker-paytabs-response",
      "cms_with_version" => "API USING PHP"
    ));
    // dd($result);

        if($result->response_code == 4012){
        return redirect($result->payment_url);
          }
          return $result->result;
    }

    public function paytabsResponse(Request $request)
    {
      $pt = Paytabs::getInstance(env("MERCHANT_EMAIL"), env("MERCHANT_SECRET"));
      $result = $pt->verify_payment($request->payment_reference);

      if($result->response_code == 100){
        return view('front-end.workers.payment-method', compact('result'));
      }
      return redirect()->back()->with('msg', 'Payment Not Successfull');
    }

}

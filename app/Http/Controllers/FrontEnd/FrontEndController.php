<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Auth;
use Session;
use App\Order;
use App\Address;
use App\City;
use App\State;
use App\Country;
use App\Cart;
use App\PromoCode;
use App\OrderStatus;
use App\OrderActivity;

class FrontEndController extends Controller
{

    public function index()
    {
      $url        = env('MAIN_HOST_URL').'api/get-modules';
      $method     = 'GET';
      $models     = $this->callApi($method, $url);

      return view('front-end.home', compact('models'));
    }

    public function isDriver()
    {
      $url = env('MAIN_HOST_URL').'api/check-driver';
      $method = 'POST';
      $headers = [
            'Authorization' => 'Bearer ' . Session::get('access_token'),
            'Accept'        => 'application/json',
        ];
      $is_driver = $this->callApi($method, $url, [], $headers)->message;
      return response()->json([
        'is_driver' => $is_driver
      ]);
    }


    public function userLogin()
    {
      return view('front-end.auth-user.user-login');
    }

    public function userLoginSubmit(Request $request)
    {
     
      if($this->autoLogin($request->email, $request->password)){
        return redirect('/');
      }else{
        return redirect()->back()->with('message', 'Credentials do not match.');
      }
    }

    public function userSignup()
    {
      return view('front-end.auth-user.user-signup');
    }

    public function singupForm(Request $request)
    {
      $method = "POST";
      $url = env("MAIN_HOST_URL")."api/signup";
      $parameters = [
          'name'      => $request->name,
          'email'     => $request->email,
          'password'  => $request->password
      ];
      $response = $this->callApi($method, $url, $parameters);
      
      if ($response->message == "Signup is successful")
      {
        if($this->autoLogin($request->email, $request->password)){
          return redirect('/');
        }
        else
        {
          return redirect()->back()->with('message', 'SORRY SIGNUP NOT SUCCESSFULL');
        }
      }else
      {
        return redirect()->back()->with('message', 'SORRY SIGNUP NOT SUCCESSFULL');
      }
    }

    public function chat()
    {
      return view('front-end.chat.chat');
    }

    public function autoLogin($email, $password)
    {
      $client = new \GuzzleHttp\Client();
      $response_login = $client->request('POST', 'http://webencoder.space/demo/demo61/public/oauth/token', [
        'form_params' => [
            'client_id'      => env('CLIENT_ID'),
            'client_secret'  => env('CLIENT_SECRET'),
            'grant_type'     => 'password',
            'username'       => $email,
            'password'       => $password
        ],
        'http_errors' => false
      ]);
      $statusCode = $response_login->getStatusCode();
      if ($statusCode == 200) {
        $body_login            = json_decode($response_login->getBody());
        if ($body_login)
        {
          Session::put('token_type', (string)$body_login->token_type);
          Session::put('expires_at', (string)$body_login->expires_in+time()-50000);
          Session::put('access_token', (string)$body_login->access_token);
          Session::put('refresh_token', (string)$body_login->refresh_token);
          // Session::put('is_driver', (string)$is_driver);
        }
        return true;
      }else{
        return false;
      }

    }

    public function logout()
    {
      $url = env('MAIN_HOST_URL').'api/logout';
      $method = 'POST';
      $headers = [
            'Authorization' => 'Bearer ' . Session::get('access_token'),
            'Accept'        => 'application/json',
        ];
      $body = $this->callApi($method, $url, [], $headers);
      Session::flush();
      return redirect('/');
    }

    public function ajaxUpdateQuantityCart(Request $request)
    {
      if ($this->check_expiration())
      {
        $url_cart = env('MAIN_HOST_URL').'/api/update-quantity';
        $method_cart = 'POST';
        $parameters = [
            'cart_id'      => $request->cart_id,
            'new_quantity' => $request->new_quantity
        ];
        $headers = [
          'Authorization' => 'Bearer ' . Session::get('access_token'),
          'Accept'        => 'application/json',
        ];
        $update_quantity = $this->callApi($method_cart, $url_cart, $parameters, $headers);

        return response()->json(array('msg'=>$update_quantity), 200);
      }else
      {
        return response()->json(array('msg'=>'Error'), 200);
      }
    }

    public function ajaxDeleteCart(Request $request)
    {
      if ($this->check_expiration())
      {
        $url_cart = env('MAIN_HOST_URL').'api/delete-cart';
        $method_cart = 'POST';
        $parameters = [
            'cart_id'      => $request->cart_id
        ];
        $headers = [
          'Authorization' => 'Bearer ' . Session::get('access_token'),
          'Accept'        => 'application/json',
        ];
        $delete_cart = $this->callApi($method_cart, $url_cart, $parameters, $headers);

        return response()->json(array('msg'=>$delete_cart), 200);
      }else
      {
        return response()->json(array('msg'=>'Error'), 200);
      }
    }

    public function check_expiration(){
      $remaining_time = Session::get('expires_at')-time();
      if ($remaining_time>0) {
        return true;
      }
      return false;
    }

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
      return view('front-end.address', compact('address', 'module_id'));
    }

    public function addressView()
    {
      $url_country = env('MAIN_HOST_URL').'api/country-list';
      $method_country = 'GET';
      $country = $this->callApi($method_country, $url_country);
      return view('front-end.add-address', compact('country'));
    }

    public function addressSubmit(Request $request)
    {

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
      return redirect('/address');
    }

    public function ajaxStateList(Request $request)
    {
      $country_id = $request->country_id;
      $url_state = env('MAIN_HOST_URL').'api/get-state/'.$country_id;

      $method_state = 'GET';
      $states = $this->callApi($method_state, $url_state);
      return response()->json(array('msg'=> 'Got State Id', 'states'=>$states), 200);
    }

    public function ajaxCityList(Request $request)
    {


      $state_id = $request->state_id;
      $url_city = env('MAIN_HOST_URL').'api/get-city/'.$state_id;

      $method_city = 'GET';
      $cities = $this->callApi($method_city, $url_city);
      return response()->json(array('msg'=> 'Got State Id', 'cities'=>$cities), 200);
    }

    public function ajaxCodSubmit(Request $request)
    {
      if ($this->check_expiration()) {
        $method = "POST";
        $url = env("MAIN_HOST_URL")."api/place-order";
        $parameters = [
            'address_id'     => $request->address_id,
            'promo_code'     => $request->promo_code,
            'payment_method'     => 'COD'
        ];
        $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
        ];
        $response = $this->callApi($method, $url, $parameters, $headers);
        // dd($order_id);
        return response()->json(['msg'=>'Success','response' =>$response]);
      }
    }

    public function orderConfirmation($id=null)
    {
      // dd($id);
      $order = null;
      if ($id != null) {
        $order = Order::find($id);
        dd($order);
      }
      return view('front-end.order.order-confirmation', compact('order'));
    }

    public function placeOrder(Request $request)
    {
      // $total_price = 0;
      // $final_price = 0;
      // $paytab_transaction_id = null;
      // $image = '';
      // $cart_ids = [];
      // $city_id = Address::where('id', $request->input('address_id'))->first()->city_id;
      // $city  = City::where('id', $city_id)->first();
      // $shipping_fees  = $city->delivery_fees;
      // if($city->cod == 1){
      //     $time_stamp = time()+(3*24*60*60);
      //     $estimated_time = date("l", $time_stamp).' '.date('M d,Y', $time_stamp); ;
      // }else{
      //     $time_stamp = time()+(5*24*60*60);
      //     $estimated_time = date("l", $time_stamp).' '.date('M d,Y', $time_stamp); ;
      // }

      // $cart=Cart::where('user_id', Auth::id())->where('is_cart', '1')->latest()->get();
      // foreach ($cart as $single_cart) {
      //   $total_price = $total_price + ($single_cart->quantity*$single_cart->price);
      //   array_push($cart_ids, $single_cart->id);
      // }
      // $cart_ids = implode(',', $cart_ids);
      // $promo_code_cnt = PromoCode::where('code', $request->input("promo_code"))->count();
      // if (($request->input("promo_code") !== null) && ($promo_code_cnt > 0)) {
      //   $promo_code = PromoCode::where('code', $request->input("promo_code"))->first();
      //   $only_promo_code = $promo_code->code;
      //   $discount_type = $promo_code->type;
      //   $discount_percent = $promo_code->percent;
      //   $discount_amount = $promo_code->amount;

      //   if ($discount_type == "Amount") {
      //     $final_price = $total_price - $discount_amount;
      //   }else{
      //     $final_price = $total_price - (($total_price*$discount_percent)/100);
      //   }
      // }else{
      //   $final_price = $total_price;
      //   $discount_percent = '';
      //   $discount_amount = '';
      //   $only_promo_code = '';
      // }

      // $final_price = $final_price + $shipping_fees;

      // $cart = Cart::where('user_id', Auth::id())->where('is_cart', '1')->update(['is_cart'=>'0']);
      // $order_status = OrderStatus::first()->id;

      // if ($request->input("payment_method") == "COD") {
      //     $payment_method = 'COD';
      //     $final_price = $final_price+15;
      // }elseif($request->input("payment_method") == "Paytab"){
      //     $payment_method = 'Paytab';
      //     $paytab_transaction_id = $request->input("paytab_transaction_id");
      // }else{
      //     if($request->hasFile('image')){
      //         $image = $request->file('image');
      //         $image_fullname = uniqid().'.'.strtolower($image->getClientOriginalExtension());
      //         $path = 'uploads/';
      //         $image_url = $path.$image_fullname;
      //         $image->move($path,$image_fullname);
      //     }else{
      //         $image_url = "";
      //     }
      //     $image = $image_url;
      //     $payment_method = 'Bank Transfer';
      // }

      // $order                           = new Order;
      // $order->user_id                  = Auth::id();
      // $order->cart_ids                 = $cart_ids;
      // $order->total_price              = $total_price;
      // $order->discount_percent         = $discount_percent;
      // $order->discount_amount          = $discount_amount;
      // $order->paytab_transation_id     = $paytab_transaction_id;
      // $order->address_id               = $request->input("address_id");
      // $order->promo_code               = $only_promo_code;
      // $order->final_price              = $final_price;
      // $order->order_status_id          = $order_status;
      // $order->estimated_time           = $estimated_time;
      // $order->image                    = $image;
      // $order->payment_method           = $payment_method;
      // $order->save();

      // if ($order) {

      // $order_status_obj = OrderStatus::first();

      // $OrderActivity                  = new OrderActivity;
      // $OrderActivity->order_id        = $order->id;
      // $OrderActivity->status          = $order_status_obj->order_status;
      // $OrderActivity->status_arabic   = $order_status_obj->order_status_arabic;
      // $OrderActivity->save();

      if ($this->check_expiration()) {
        $method = "POST";
        $url = env("MAIN_HOST_URL")."api/place-order";
        $parameters = [
            'address_id'     => $request->address_id,
            'promo_code'     => $request->promo_code,
            'payment_method'     => 'Bank Transfer'
        ];
        $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
        ];
        $order = $this->callApi($method, $url, $parameters, $headers);
        // dd($order);

      return view('front-end.order.order-confirmation', compact('order'));
    }
  }
}

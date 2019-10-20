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
use App\User;
use SmsaSDK\Smsa;

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

        // $order = Order::find($id);
        $url = env('MAIN_HOST_URL').'api/order-details/'.$id;
        $method = 'GET';
        $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
          ];
        $order = $this->callApi($method, $url, [], $headers);
        // dd($order);
      }
      return view('front-end.order.order-confirmation', compact('order'));
    }

    public function placeOrder(Request $request)
    {
      if ($this->check_expiration()) {
        $method = "POST";
        $url = env("MAIN_HOST_URL")."api/place-order";
        $parameters = [
            'address_id'            => $request->address_id,
            'promo_code'            => $request->promo_code,
            'payment_method'        => $request->payment_method,
            'paytab_transaction_id' => $request->paytab_transaction_id,
            'image'                 => $request->image
        ];
        $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
        ];

        $order_details = $this->callApi($method, $url, $parameters, $headers);
        
        $url = env('MAIN_HOST_URL').'api/order-details/'.$order_details->id;
        $method = 'GET';
        $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
          ];
        $order = $this->callApi($method, $url, [], $headers);

      return view('front-end.order.order-confirmation', compact('order'));
    }
  }

  public function addShipmentToSmsa($order_id, $user_id, $address_id)
  {
    $user_data          = User::where('id', $user_id)->first();
    $order_data         = Order::where('id', $order_id)->first();
    $address_data       = Address::where('id', $address_id)->first();
    $state_data         = State::where('id', $address_data->state_id)->first();
    $city_data          = City::where('id', $address_data->city_id)->first();
    $country_data       = Country::where('id',$address_data->country_id)->first();

    if (($order_data->payment_method == "Paytab") && ($order_data->paytab_transaction_id != null)) {
        $cod_amount = 0;
    }else{
        $cod_amount = $order_data->final_price;
    }

    $refNo              = $order_data->id;
    $name               = $user_data->name;
    $email              = $user_data->email;
    $country            = $country_data->code;
    $city               = $state_data->state;
    $mobile             = $address_data->phone_no;
    $address1           = "Neighbor ".$city_data->city.", ";
    $address2           = "Location: ".$address_data->location.", ".$address_data->pin_code;
    $ship_type          = "DLV";
    $pcs                = 1;
    $weight             = '0.5';
    $item_description   = 'Mobile case';
    Smsa::nullValues('');
    $shipmentData = [
            'refNo' => $refNo, // shipment reference in your application
            'cName' => $name, // customer name
            'Cntry' => $country, // shipment country
            'cCity' => $city, // shipment city, try: Smsa::getRTLCities() to get the supported cities
            'cMobile' => $mobile, // customer mobile
            'cAddr1' => $address1, // customer address
            'cAddr2' => $address2, // customer address 2
            'shipType' => $ship_type, // shipment type
            'PCs' => $pcs, // quantity of the shipped pieces
            'cEmail' => $email, // customer email
            'codAmt' => $cod_amount, // payment amount if it's cash on delivery, 0 if not cash on delivery
            'weight' => $weight, // pieces weight
            'itemDesc' => $item_description, // extra description will be printed
        ];
    $shipment = Smsa::addShipment($shipmentData);
    $awbNumber = $shipment->getAddShipmentResult();


    if (is_numeric($awbNumber)) {

        $order                  = Order::where('id', $order_id)->first();
        $order->smsa_awb_number = $awbNumber;
        $order->order_status    = 5;
        $order->save();

    }else{

        if (strpos($awbNumber, '#') !== false) {
            $oldawbNumber =  explode('# ', $awbNumber);

            $order                  = Order::where('id', $order_id)->first();
            $order->smsa_awb_number = $oldawbNumber[1];
            $order->order_status    = 5;
            $order->save();
        }else{
            dd($awbNumber);
        }

    }

    $lang = $user_data->language;
    if ($lang == 'en') {
        $body = "Your product is shipped. Tracking Number: ".$order->smsa_awb_number;
    }else{
        // Arabic here
        $body = "Your product is shipped. Tracking Number: ".$order->smsa_awb_number;
    }
    // notification - FCM
    $optionBuilder = new OptionsBuilder();
    $optionBuilder->setTimeToLive(60*20);
    $notificationBuilder = new PayloadNotificationBuilder('Pixel Store');
    $notificationBuilder->setBody($body)
                        ->setSound('default');

    $dataBuilder = new PayloadDataBuilder();
    $dataBuilder->addData(['a_data' => 'my_data']);

    $option = $optionBuilder->build();
    $notification = $notificationBuilder->build();
    $data = $dataBuilder->build();

    $token = User::where('id', $order->user_id)->first()->fcm_token;

    $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

    return back();
  }

      public function trackOrder($id)
    {
      if ($this->check_expiration()) {
        $headers = [
          'Authorization' => 'Bearer ' . Session::get('access_token'),
          'Accept'        => 'application/json',
        ];

        $url_order_details = env('MAIN_HOST_URL').'api/order-details/'.$id;
        $method_order_details = 'GET';
        $order_details = $this->callApi($method_order_details, $url_order_details, [], $headers);
        // $order = Order::where('id', $id)->first();
        return view('front-end.track-order', compact('order_details'));
      }else{
        return redirect()->back();
      }

    }
}

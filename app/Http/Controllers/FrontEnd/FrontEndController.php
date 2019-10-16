<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Auth;
use Session;

class FrontEndController extends Controller
{

    public function index()
    {
      $url        = env('MAIN_HOST_URL').'api/get-modules';
      $method     = 'GET';
      $models     = $this->callApi($method, $url);

      return view('front-end.home', compact('models'));
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
      return view('front-end.chat.waiting');
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
}

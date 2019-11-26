<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Session;
use Paytabs;
session_start();

class RelocationsController extends Controller
{
    public function index()
    {
    	$renting = 'Relocation';
    	$url = env('MAIN_HOST_URL').'api/get-module/'.$renting;
    	$method = 'GET';
    	$module = $this->callApi($method, $url);

    	$url = env('MAIN_HOST_URL').'api/get-relocation-store-by-module-id/'.$module->id;
	    $method = 'GET';
	    $stores = $this->callApi($method, $url);
	    return view('front-end.relocation.store-list', compact('stores'));

    }

    public function selectLocationView($id)
    {
    	if ($this->check_expiration()) {
    		Session::put('selected_relocation_store_id', $id);
    		return view('front-end.relocation.pick-drop-map', compact('id'));
    	}else{
    		return redirect('/login');
    	}
    	
    }

    public function selectLocationTwoView(){
    	return view('front-end.relocation.pick-drop-map-two');
    }

    public function selectLocationFinalStepView(){
    	$store_id = Session::get('selected_relocation_store_id');
    	$url = env('MAIN_HOST_URL').'api/get-cartype-by-store-id/'.$store_id;
	    $method = 'GET';
	    $cartypes = $this->callApi($method, $url);
	    return view('front-end.relocation.pickup-drop-map-final', compact('cartypes'));
    }

    public function ajaxGetPrice(Request $request){
    	$store_id = $request->get('store_id');
    	$url = env('MAIN_HOST_URL').'api/get-store-by-store-id/'.$store_id;
	    $method = 'GET';
	    $store = $this->callApi($method, $url);

	    $lat1 = $request->get('lat1');
	    $lat2 = $request->get('lat2');

	    $lng1 = $request->get('lng1');
	    $lng2 = $request->get('lng2');

	    $car_type_id = $request->get('cartype');
	    $url = env('MAIN_HOST_URL').'api/get-cartype-by-cartype-id/'.$car_type_id;
	    $method = 'GET';
	    $cartype = $this->callApi($method, $url);



	    $distance1 = $this->getdistance($store->lat, $store->lng, $lat1, $lng1, "k");

	    $distance2 = $this->getdistance($lat1, $lng1, $lat2, $lng2, "k");

	    $total_distance = $distance1 + $distance2;

	    $total_price = $total_distance*$cartype->per_mile_price;

    	return response()->json(['msg' => 'Success', 'price' => $total_price]);
    }

    protected function getdistance($lat1, $lon1, $lat2, $lon2, $unit) {

	  $theta = $lon1 - $lon2;
	  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	  $dist = acos($dist);
	  $dist = rad2deg($dist);
	  $miles = $dist * 60 * 1.1515;
	  $unit = strtoupper($unit);

	  if ($unit == "K") {
	      return ($miles * 1.609344);
	  } else if ($unit == "N") {
	      return ($miles * 0.8684);
	  } else {
	      return $miles;
	  }
	}

	public function relocationPlaceOrder(Request $request){
		if ($this->check_expiration()) {
       		$url = env('MAIN_HOST_URL').'api/relocation-place-order';
	      	$method = 'POST';
	      	$headers = [
	            'Authorization' => 'Bearer ' . Session::get('access_token'),
	            'Accept'        => 'application/json',
	        ];
	      	$parameters = [
	            'car_type_id'   => $request->cart_type,
	            'store_id'   => $request->store_id,
	            'lat1'      => $request->lat1,
	            'lng1'    => $request->lng1,
	            'lat2'      => $request->lat2,
	            'lng2'       => $request->lng2,
	            'price'      => $request->price
	          ];
	      	$body = $this->callApi($method, $url, $parameters, $headers);
	      	return view('front-end.relocation.success');
      }else{
        return redirect('/user-login');
      }
	}

	public function relocationOrderView()
	{
		if ($this->check_expiration()) {
	        $url = env('MAIN_HOST_URL').'api/get-customer-relocation-order';
            $method = 'GET';
            $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
            ];
            $response = $this->callApi($method, $url, [], $headers);
            $stores = json_decode(json_encode($response->stores), true);
            $cartypes = json_decode(json_encode($response->cartypes), true);

            return view('front-end.auth-user.customer-relocation-order-view', compact('response', 'stores', 'cartypes'));
    	}else{
    		return redirect('/user-login');
    	}
	}

	public function relocationAddressView($id)
	{
		if ($this->check_expiration()) {
			Session::put('selected_relocation_order_id', $id);
			$address_method = 'GET';
      		$address_url = env('MAIN_HOST_URL').'api/get-addresses';
      		$address_headers = [
            	'Authorization' => 'Bearer ' . Session::get('access_token'),
            	'Accept'        => 'application/json',
        	];
      		$address = $this->callApi($address_method, $address_url, [], $address_headers);
      		return view('front-end.relocation.address', compact('address'));
	  	}else{
	  		return redirect('/user-login');
	  	}
	}

	public function relocationAddAddressView()
	{
		$url_country = env('MAIN_HOST_URL').'api/country-list';
      	$method_country = 'GET';
      	$country = $this->callApi($method_country, $url_country);
      	return view('front-end.relocation.add-address', compact('country'));
	}

	public function relocationAddressSubmit(Request $request)
	{
		if ($this->check_expiration()) {
			$store_id = Session::get('selected_relocation_order_id');
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
	      	return redirect('relocation-address/'.$store_id);
	    }else{
	        return redirect('/user-login');
	    }
	}

	public function relocationPaymentMethodView($address_id)
	{
		if ($this->check_expiration()) {
			Session::put('selected_address_id', $address_id);
			$result = null;
      		return view('front-end.relocation.payment-method', compact('address_id', 'result'));
	  	}else{
	  		return redirect('/user-login');
	  	}
	}

	public function paytabsPayment(){
		$current_user; //customer
      	$single_address;

      	$single_relocation_order;


      	$address_id = Session::get('selected_address_id');
      	$selected_relocation_order_id = Session::get('selected_relocation_order_id');

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

        	$url = env('MAIN_HOST_URL').'api/get-single-relocation-order/'.$selected_relocation_order_id;
        	$method = 'GET';
        	$headers = [
          		'Authorization' => 'Bearer ' . Session::get('access_token'),
          		'Accept'        => 'application/json',
        	];
        	$single_relocation_order = $this->callApi($method, $url, [], $headers);
        	// dd($single_restaurent_order);
        }else{
            return redirect('/login');
        }
        $name = $current_user->name;
       	$email = $current_user->email;
      // $phone = $current_user->phone;
        $cc_phone_number = $single_address->country->code_arabic;

        $billing_address = $single_address->flat_no.' '.$single_address->location;
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
          "products_per_title"=> 'Food Delivery Service',
          'currency' => "SAR",
          "unit_price"=> $single_relocation_order->price,
          'quantity' => "1",
          'other_charges' => "0",
          'amount' => $single_relocation_order->price,
          'discount'=>"0",
          "msg_lang" => "en",
          "reference_no" => "1231231",
          "site_url" => "http://webencoder.space/demo/demo61/public/",
          'return_url' => "http://webencoder.space/demo/demo61/public/relocation-paytabs-response",
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
	        $address_id = Session::get('selected_address_id');
	        return view('front-end.relocation.payment-method', compact('result', 'address_id'));
	    }

	    return redirect()->back()->with('msg', 'Payment Not Successfull');
	}

	public function relocationPaymentSubmit(Request $request)
	{
		if ($this->check_expiration()) {
            $selected_relocation_order_id = Session::get('selected_relocation_order_id');
            $method = "POST";
            $url = env("MAIN_HOST_URL")."api/relocation-payment-data-update";
            $parameters = [
                'payment_method'               => $request->payment_method,
                'paytab_transaction_id'        => $request->paytab_transaction_id,
                'selected_relocation_order_id' => $selected_relocation_order_id
            ];
            $headers = [
                  'Authorization' => 'Bearer ' . Session::get('access_token'),
                  'Accept'        => 'application/json',
            ];

            $this->callApi($method, $url, $parameters, $headers);
            return redirect('/customer-relocation-order');
        }else{
            return redirect('/login');
        }
	}

	public function relocationReview($id, $type){
		if ($this->check_expiration()) {
	        $url = env('MAIN_HOST_URL').'api/review-check-by-order-id/'.$id.'/'.$type;
            $method = 'GET';
            $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
            ];
            $response = $this->callApi($method, $url, [], $headers);
            if($response->already_reviewed == 1){
            	return redirect()->back()->with('review-msg', true);
            }else{
            	return view('front-end.order-review', compact('id', 'type'));
            }
            
    	}else{
    		return redirect('/user-login');
    	}
	}

	public function relocationSingleorder($id){
		if ($this->check_expiration()) {
			$method = 'GET';
      		$url = env('MAIN_HOST_URL').'api/get-single-relocation-order-by-order-id/'.$id;
      		$headers = [
            	'Authorization' => 'Bearer ' . Session::get('access_token'),
            	'Accept'        => 'application/json',
        	];
      		$response = $this->callApi($method, $url, [], $headers);
      		// dd($response);
      		$stores = json_decode(json_encode($response->stores), true);
            $cartypes = json_decode(json_encode($response->cartypes), true);
      		return view('front-end.relocation-single-order', compact('response', 'stores', 'cartypes'));
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
}

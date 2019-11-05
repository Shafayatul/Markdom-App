<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Auth;
use Session;
use Storage;
use Paytabs;

class CustomersController extends Controller
{
    public function customerOrder($module)
    {
    	if ($this->check_expiration()) {
	        $url = env('MAIN_HOST_URL').'api/get-customer-restuarent-order/'.$module;
            $method = 'GET';
            $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
            ];
            $response = $this->callApi($method, $url, [], $headers);
            return view('front-end.auth-user.customer-order-view', compact('response'));
    	}else{
    		return redirect('/user-login');
    	}
    }

    public function restaurentSingleOrder($id)
    {
    	if ($this->check_expiration()) {
	        $url = env('MAIN_HOST_URL').'api/get-single-restuarent-order/'.$id;
            $method = 'GET';
            $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
            ];
            $response = $this->callApi($method, $url, [], $headers);
            return view('front-end.restaurent-single-order-view', compact('response'));
    	}else{
    		return redirect('/user-login');
    	}
    }

    public function workerSingleOrder($id)
    {
    	if ($this->check_expiration()) {
	        $url = env('MAIN_HOST_URL').'api/get-single-worker-order/'.$id;
            $method = 'GET';
            $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
            ];
            $response = $this->callApi($method, $url, [], $headers);
            return view('front-end.worker-single-order-view', compact('response'));
    	}else{
    		return redirect('/user-login');
    	}
    }
    

    public function storeSingleOrder($id)
    {
    	if ($this->check_expiration()) {
	        $url = env('MAIN_HOST_URL').'api/get-single-store-order/'.$id;
            $method = 'GET';
            $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
            ];
            $response = $this->callApi($method, $url, [], $headers);
            return view('front-end.store-single-order-view', compact('response'));
    	}else{
    		return redirect('/user-login');
    	}
    }

    public function restaurentOrderComplete($id)
    {
    	if ($this->check_expiration()) {
	        $url = env('MAIN_HOST_URL').'api/single-restaurent-complete/'.$id;
            $method = 'GET';
            $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
            ];
            $this->callApi($method, $url, [], $headers);
            return redirect()->back()->with('success', 'Order Completed');
    	}else{
    		return redirect('/user-login');
    	}
    }

    public function workerOrderComplete($id)
    {
    	if ($this->check_expiration()) {
	        $url = env('MAIN_HOST_URL').'api/single-worker-complete/'.$id;
            $method = 'GET';
            $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
            ];
            $this->callApi($method, $url, [], $headers);
            return redirect()->back()->with('success', 'Order Completed');
    	}else{
    		return redirect('/user-login');
    	}
    }

    public function orderReview($id, $type)
    {
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

    public function orderReviewSubmit(Request $request)
    {
    	if ($this->check_expiration()) {
	        $url = env('MAIN_HOST_URL').'api/order-review-submit';
            $method = 'POST';
            $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
            ];
            $parameters = [
            	'order_id' => $request->order_id,
            	'type' => $request->type,
            	'star' => $request->star,
            	'review' => $request->review
            ];
            $response = $this->callApi($method, $url, $parameters, $headers);
            return redirect('/')->with('success', 'Order Review Success');
    	}else{
    		return redirect('/user-login');
    	}
    }

    public function orderPayNow($id)
    {
        Session::put('selected_restaurent_order_id', $id);
        return redirect('/restaurent-address');
       
    }

    public function addressView(){
        $url_country = env('MAIN_HOST_URL').'api/country-list';
        $method_country = 'GET';
        $country = $this->callApi($method_country, $url_country);
        return view('front-end.restaurant.add-address', compact('country'));
    }

    public function addressesView()
    {
        $address_method = 'GET';
        $address_url = env('MAIN_HOST_URL').'api/get-addresses';
        $address_headers = [
            'Authorization' => 'Bearer ' . Session::get('access_token'),
            'Accept'        => 'application/json',
        ];
        $address = $this->callApi($address_method, $address_url, [], $address_headers);
        return view('front-end.restaurant.address', compact('address')); 
    }

    public function restaurantAddressSubmit(Request $request)
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
      return redirect('/restaurent-address');
      }else{
        return redirect('/user-login');
      }
    }

    public function restaurantPaymentMethodView($address_id)
    {
        Session::put('selected_address_id', $address_id);
        $result = null;
        return view('front-end.restaurant.payment-method', compact('result', 'address_id'));
    }

    public function paytabsPayment()
    {
      //offer price
      $current_user; //customer
      $single_address;

      $single_restaurent_order;


      $address_id = Session::get('selected_address_id');
      $selected_restaurent_order_id = Session::get('selected_restaurent_order_id');

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

        $url = env('MAIN_HOST_URL').'api/get-single-restuarent-order/'.$selected_restaurent_order_id;
        $method = 'GET';
        $headers = [
          'Authorization' => 'Bearer ' . Session::get('access_token'),
          'Accept'        => 'application/json',
        ];
        $single_restaurent_order = $this->callApi($method, $url, [], $headers);
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
          "unit_price"=> $single_restaurent_order->single_restaurent_order->offer_price,
          'quantity' => "1",
          'other_charges' => "0",
          'amount' => $single_restaurent_order->single_restaurent_order->offer_price,
          'discount'=>"0",
          "msg_lang" => "en",
          "reference_no" => "1231231",
          "site_url" => "http://webencoder.space/demo/demo61/public/",
          'return_url' => "http://webencoder.space/demo/demo61/public/restaurant-paytabs-response",
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
      $pt = Paytabs::getInstance("webencoder32@gmail.com", "sdNT6F26xhReY6xv61rOrwsOgrZoEpN7CB1Ih3PPkH3jNAOUCgI4MbS2CRrhgfoSQpB8trXO807WBWQdczhZK91n0tFhI39ztKIX");
      $result = $pt->verify_payment($request->payment_reference);

      if($result->response_code == 100){
        $address_id = Session::get('selected_address_id');
        return view('front-end.restaurant.payment-method', compact('result', 'address_id'));
      }

      return redirect()->back()->with('msg', 'Payment Not Successfull');
    }

    public function restaurentPlaceOrder(Request $request)
    {
        if ($this->check_expiration()) {
            $selected_restaurent_order_id = Session::get('selected_restaurent_order_id');
            $method = "POST";
            $url = env("MAIN_HOST_URL")."api/restaurant-place-order";
            $parameters = [
                'payment_method'               => $request->payment_method,
                'paytab_transaction_id'        => $request->paytab_transaction_id,
                'is_complete'                  => 1,
                'selected_restaurent_order_id' => $selected_restaurent_order_id
            ];
            $headers = [
                  'Authorization' => 'Bearer ' . Session::get('access_token'),
                  'Accept'        => 'application/json',
            ];

            $order_details = $this->callApi($method, $url, $parameters, $headers);
            return redirect('/');
        }else{
            return redirect('/login');
        }
    }

    public function ajaxCodSubmit(Request $request)
    {
      if ($this->check_expiration()) {
        $selected_restaurent_order_id = Session::get('selected_restaurent_order_id');
        $method = "POST";
        $url = env("MAIN_HOST_URL")."api/restaurant-place-order";
        $parameters = [
            'payment_method'               => 'COD',
            'is_complete'                  => 1,
            'selected_restaurent_order_id' => $selected_restaurent_order_id
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

    public function receiptDownload($id)
    {
      if ($this->check_expiration()) {
        $method = "GET";
        $url = env("MAIN_HOST_URL")."api/receipt-download/".$id;
        $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
        ];
        $response = $this->callApi($method, $url, [], $headers);
        if($response->receipt != null){
          return response()->download($response->receipt);
        }else{
          return redirect()->back()->with('success', 'File Not Found!');
        }
      }else{
        return redirect('/login');
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

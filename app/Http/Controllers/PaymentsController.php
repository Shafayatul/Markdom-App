<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Storage;
use Paytabs;
use App\Order;


class PaymentsController extends Controller
{
    public function payment_method_view()
    {
      $result = null;
      return view('front-end.payments.payment-method', compact('result'));
    }

        public function paytabsPayment()
    {

      $grand_total;
      $current_user;
      $single_address;
      $single_product;
      $carts;
      $product_name;
      $product_price;
      $product_quantity;



      $address_id = Session::get('current_user_address');

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

        $url = env('MAIN_HOST_URL').'api/view-cart/3';
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
      'cc_phone_number' => $cc_phone_number,
      'phone_number' => '1751837757',
      'email' => $email,
      "products_per_title"=> $product_names,
      "unit_price"=> $product_prices,
      'quantity' => $product_quantities,
      'other_charges' => $shipping_charge,
      'amount' => $grand_total,
      'discount'=>"0",
      'currency' => "SAR",
      "reference_no" => "ABC-123",
      'billing_address' => $billing_address,
      'city' => $city,
      'state' => $state,
      'postal_code' => $postal_code,
      'country' => $country,
      'address_shipping' => $billing_address,
      'state_shipping' => $state,
      'city_shipping' => $city,
      'postal_code_shipping' => $postal_code,
      'country_shipping' => $country,
      "msg_lang" => "en",
      "site_url" => "http://webencoder.space/demo/demo61/public/",
      'return_url' => "http://webencoder.space/demo/demo61/public/paytabs-response",
      "cms_with_version" => "API USING PHP"
    ));

      
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
        return view('front-end.payments.payment-method', compact('result'));
      }
      return redirect()->back()->with('msg', 'Payment Not Successfull');
    }

    public function check_expiration(){
      $remaining_time = Session::get('expires_at')-time();
      if ($remaining_time>0) {
        return true;
      }
      return false;
    }
}
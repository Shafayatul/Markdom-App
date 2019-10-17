<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Session;
use Log;
use App\Product;

class StoreController extends Controller
{
    public function index()
    {
      $url              = env('MAIN_HOST_URL').'api/get-categories-by-module/3';
      $method           = 'GET';
      $categories       = $this->callApi($method, $url);

      $url_offer        = env('MAIN_HOST_URL').'api/get-offers-by-module/3';
      $method_offer     = 'GET';
      $categories_offer = $this->callApi($method_offer, $url_offer);

      return view('front-end.store.index', compact('categories', 'categories_offer'));
    }

    public function subCategoryStore($id)
    {
      $url_category     = env('MAIN_HOST_URL').'api/get-subcategories-by-category/'.$id;
      $method_category  = 'GET';
      $subCategories    = $this->callApi($method_category, $url_category);

      $url              = env('MAIN_HOST_URL').'api/get-store-by-category/'.$id;
      $method           = 'GET';
      $stores           = $this->callApi($method, $url);

      return view('front-end.store.sub-category-store', compact('subCategories', 'stores'));
    }

    public function storeDetails($id)
    {
      $url_store        = env('MAIN_HOST_URL').'api/get-store-detail/'.$id;
      $method_store     = 'GET';
      $stores_details   = $this->callApi($method_store, $url_store);

      $url_product      = env('MAIN_HOST_URL').'api/get-product-by-store/'.$id;
      $method_product   = 'GET';
      $product_details  = $this->callApi($method_product, $url_product);

      return view('front-end.store.store-details', compact('stores_details', 'product_details'));
    }

    public function storeProductDetails($id)
    {
      $url_product      = env('MAIN_HOST_URL').'api/get-product-detail/'.$id;
      $method_product   = 'GET';
      $product_details  = $this->callApi($method_product, $url_product);

      return view('front-end.store.store-product-details', compact('product_details'));
    }

    public function storeCart($module_id)
    {
      if ($this->check_expiration()) {
        $url = env('MAIN_HOST_URL').'api/view-cart/'.$module_id;
        $method = 'GET';
        $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
          ];
        $body = $this->callApi($method, $url, [], $headers);

        return view('front-end.store.store-cart', compact('body', 'module_id'));
      }else{
        return redirect('/user-login');
      }
    }

    public function storePlaceOrder($address_id)
    {
      Session::put('current_user_address',$address_id);
      if ($this->check_expiration()) {
        $module_id = Session::get('module_id');
        $url = env('MAIN_HOST_URL').'api/view-cart/'.$module_id;
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

        $single_addres_url = env('MAIN_HOST_URL').'api/get-single-address/'.$address_id;
        $single_addres_method = 'GET';
        $single_addres_headers = [
          'Authorization' => 'Bearer ' . Session::get('access_token'),
          'Accept'        => 'application/json',
        ];
        $single_address = $this->callApi($single_addres_method, $single_addres_url, [], $single_addres_headers);

        return view('front-end.store.store-place-order', compact('body', 'user', 'single_address'));
      }else{
        return redirect('/user-login');
      }
    }

    public function addToCartStore($id)
    {

      $url        = env('MAIN_HOST_URL').'api/get-product-detail/'.$id;
      $method     = 'GET';
      $product   = $this->callApi($method, $url);

      Session::put('module_id', $product->module_id);

      if ($this->check_expiration()) {
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
        return redirect('/store-cart/'.$product->module_id);
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

    public function checkPromoCode(Request $request)
    {
      $promo_code = $request->get('promo_code');
      $city_id    = $request->get('city_id');

      $url = env('MAIN_HOST_URL').'api/promo-code-validation';
      $method = 'POST';
      $headers = [
            'Authorization' => 'Bearer ' . Session::get('access_token'),
            'Accept'        => 'application/json',
      ];
      $parameters = [
            'code'      => $promo_code
      ];
      $code = $this->callApi($method, $url, $parameters, $headers);


      if($code->message == 'Failed'){
          return response()->json(['msg'=>'Failed']);
      }else{
        $url = env('MAIN_HOST_URL').'api/get-order-summary/'.$city_id.'/'.$promo_code;
        $method = 'GET';
        $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
          ];
        $order_summary = $this->callApi($method, $url, [], $headers);
        
        // \Log::debug($order_summary);
        return response()->json(['msg'=>'Success','order_summary' =>$order_summary]);
      }
    }
}

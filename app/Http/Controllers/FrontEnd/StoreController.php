<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

use App\Http\Controllers\Controller;

class StoreController extends Controller
{

  public function callApi($method, $url, $parameters=[], $headers=[]){
    $client = new \GuzzleHttp\Client();
    $response = $client->request($method, $url, [
      'form_params' => $parameters,
      'headers'     => $headers
    ]);
    $return_value       = json_decode($response->getBody());
    return $return_value;
  }

    public function index()
    {
      $url = env('MAIN_HOST_URL').'api/get-categories-by-module/1';
      $method = 'GET';
      $categories = $this->callApi($method, $url);

      return view('front-end.store.index', compact('categories'));
    }

    public function subCategoryStore($id)
    {
      return view('front-end.store.sub-category-store', compact('id'));
    }

    public function storeDetails()
    {
      return view('front-end.store.store-details');
    }

    public function storeProductDetails()
    {
      return view('front-end.store.store-product-details');
    }

    public function storeCart()
    {
      return view('front-end.store.store-cart');
    }

    public function storePlaceOrder()
    {
      return view('front-end.store.store-place-order');
    }
}

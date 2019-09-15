<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

use App\Http\Controllers\Controller;

class StoreController extends Controller
{



    public function index()
    {
      $url = env('MAIN_HOST_URL').'api/get-categories-by-module/3';
      $method = 'GET';
      $categories = $this->callApi($method, $url);

      $url_offer = env('MAIN_HOST_URL').'api/get-offers-by-module/3';
      $method_offer = 'GET';
      $categories_offer = $this->callApi($method_offer, $url_offer);
      // dd($categories_offer);

      return view('front-end.store.index', compact('categories', 'categories_offer'));
    }

    public function subCategoryStore($id)
    {
      $url_category = env('MAIN_HOST_URL').'api/get-subcategories-by-category/'.$id;
      $method_category = 'GET';
      $subCategories = $this->callApi($method_category, $url_category);

      $url    = env('MAIN_HOST_URL').'api/get-store-by-category/'.$id;
      $method = 'GET';
      $stores = $this->callApi($method, $url);
        // dd($stores);

      return view('front-end.store.sub-category-store', compact('subCategories', 'stores'));
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

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
      $url = env('MAIN_HOST_URL').'api/get-categories-by-module/1';
      $method = 'GET';
      $categories = $this->callApi($method, $url);

      return view('front-end.store.index', compact('categories'));
    }

    public function subCategoryStore($id)
    {
      $url_category = env('MAIN_HOST_URL').'api/get-subcategories-by-category/'.$id;
      $method_category = 'GET';
      $subCategories = $this->callApi($method_category, $url_category);

      return view('front-end.store.sub-category-store', compact('subCategories'));
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

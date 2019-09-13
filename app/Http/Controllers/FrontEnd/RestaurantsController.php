<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RestaurantsController extends Controller
{
    public function index()
    {

      $url        = env('MAIN_HOST_URL').'api/get-categories-by-module/1';
      $method     = 'GET';
      $categories = $this->callApi($method, $url);

      $url        = env('MAIN_HOST_URL').'api/get-offers-by-module/1';
      $method     = 'GET';
      $offers     = $this->callApi($method, $url);

      return view('front-end.restaurant.index', compact('categories', 'offers'));
    }

    public function subCategoryRestaurant($id)
    {
      $url            = env('MAIN_HOST_URL').'api/get-subcategories-by-category/'.$id;
      $method         = 'GET';
      $sub_categories = $this->callApi($method, $url);

      $url    = env('MAIN_HOST_URL').'api/get-store-by-category/'.$id;
      $method = 'GET';
      $stores = $this->callApi($method, $url);

      return view('front-end.restaurant.sub-category-restaurant', compact('sub_categories', 'stores'));
    }

    public function restaurantDetails($id)
    {
      $url    = env('MAIN_HOST_URL').'api/get-store-detail/'.$id;
      $method = 'GET';
      $store  = $this->callApi($method, $url);

      $url      = env('MAIN_HOST_URL').'api/get-product-by-store/'.$id;
      $method   = 'GET';
      $products = $this->callApi($method, $url);


      return view('front-end.restaurant.restaurant-details', compact('store', 'products'));
    }

}

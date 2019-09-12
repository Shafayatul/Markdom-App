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
      return view('front-end.restaurant.index', compact('categories'));
    }

    public function subCategoryRestaurant()
    {
      return view('front-end.restaurant.sub-category-restaurant');
    }

    public function restaurantDetails()
    {
      return view('front-end.restaurant.restaurant-details');
    }

    public function callApi($method, $url, $parameters=[], $headers=[]){
      $client = new \GuzzleHttp\Client();
      $response = $client->request($method, $url, [
        'form_params' => $parameters,
        'headers'     => $headers
      ]);
      $return_value       = json_decode($response->getBody());
      return $return_value;
    }

}

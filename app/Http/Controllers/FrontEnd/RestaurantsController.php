<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;

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

      $current_date = Carbon::now()->format('Y-m-d');
      $current_time = time();

      $url      = env('MAIN_HOST_URL').'api/get-store-detail/'.$id;
      $method   = 'GET';
      $store    = $this->callApi($method, $url);

      $url      = env('MAIN_HOST_URL').'api/get-product-by-store/'.$id;
      $method   = 'GET';
      $products = $this->callApi($method, $url);

      $url      = env('MAIN_HOST_URL').'api/get-review-by-store/'.$id;
      $method   = 'GET';
      $review   = $this->callApi($method, $url);

      $url      = env('MAIN_HOST_URL').'api/get-workinghours/'.$id.'/'.$current_date;
      $method   = 'GET';
      $slot     = $this->callApi($method, $url);

      $is_available = false;
      foreach ($slot as $row) {
        $time_ary = explode('-', $row->timespan);

        $d1 = new DateTime($time_ary[0].':00', new DateTimeZone('Asia/Riyadh'));
        $t1 = $d1->getTimestamp();

        $d2 = new DateTime($time_ary[1].':00', new DateTimeZone('Asia/Riyadh'));
        $t2 = $d2->getTimestamp();

        if (($t1 <= $current_time) && ($t2 > $current_time)) {
          if ($row->is_booked == 0) {
            $is_available = true;
          }
        }
      }

      return view('front-end.restaurant.restaurant-details', compact('store', 'products', 'review', 'is_available'));
    }

}

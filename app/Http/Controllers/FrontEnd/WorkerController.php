<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;

class WorkerController extends Controller
{

    public function index()
    {
      $url = env('MAIN_HOST_URL').'api/get-categories-by-module/2';
      $method = 'GET';
      $categories = $this->callApi($method, $url);

      $url        = env('MAIN_HOST_URL').'api/get-offers-by-module/2';
      $method     = 'GET';
      $offers     = $this->callApi($method, $url);

      return view('front-end.workers.index', compact('categories', 'offers'));
    }

    public function subCategoryWorker($id)
    {
      $url_category = env('MAIN_HOST_URL').'api/get-subcategories-by-category/'.$id;
      $method_category = 'GET';
      $subCategories = $this->callApi($method_category, $url_category);

      $url    = env('MAIN_HOST_URL').'api/get-store-by-category/'.$id;
      $method = 'GET';
      $stores = $this->callApi($method, $url);
      // dd($stores);
      return view('front-end.workers.sub-category-worker', compact('subCategories', 'stores'));
    }

    public function workerServiceTime($id){

      $current_date           = Carbon::now()->format('Y-m-d');
      $current_time           = time();

      $url_workinghours       = env('MAIN_HOST_URL').'api/get-workinghours/'.$id.'/'.$current_date;
      $method_workinghours    = 'GET';
      $slot                   = $this->callApi($method_workinghours, $url_workinghours);

      dd($slot);

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


    }

    public function workerDetails($id)
    {
    
      $url      = env('MAIN_HOST_URL').'api/get-store-detail/'.$id;
      $method   = 'GET';
      $store    = $this->callApi($method, $url);

      

      $url      = env('MAIN_HOST_URL').'api/get-review-by-store/'.$id;
      $method   = 'GET';
      $review   = $this->callApi($method, $url);

      $url                = env('MAIN_HOST_URL').'api/get-service-category-by-store/'.$id;
      $method             = 'GET';
      $service_categories = $this->callApi($method, $url);

      return view('front-end.workers.worker-details', compact('store', 'review', 'service_categories'));
    }

    public function subSubCategoryWorker($id)
    {
      $url_sub_category = env('MAIN_HOST_URL').'api/get-sub-subcategories-by-sub-category/'.$id;
      $method_sub_category = 'GET';
      $subSubCategories = $this->callApi($method_sub_category, $url_sub_category);
      // dd($subSubCategories);
      return view('front-end.workers.sub-sub-category-worker');
    }

    public function workerServiceDelivery()
    {
      return view('front-end.workers.worker-service-delivery');
    }

    public function serviceSubCategoryWorker($id)
    {
      $url                        = env('MAIN_HOST_URL').'api/get-service-sub-category-by-service-category/'.$id;
      $method                     = 'GET';
      $service_sub_categories     = $this->callApi($method, $url);
      return view('front-end.workers.service-sub-category-worker', compact('service_sub_categories'));
    }

    public function productByServiceSubCategory($id)
    {
      $url      = env('MAIN_HOST_URL').'api/get-products-by-service-sub-category/'.$id;
      $method   = 'GET';
      $services = $this->callApi($method, $url);

      $url      = env('MAIN_HOST_URL').'api/get-service-sub-sub-category-by-service-sub-category/'.$id;
      $method   = 'GET';
      $service_sub_sub_categories = $this->callApi($method, $url);
      // dd($service_sub_sub_categories);
      return view('front-end.workers.product-view-by-service-sub-category', compact('services', 'service_sub_sub_categories'));
    }

    public function workerProductDetails($id)
    {
      $url      = env('MAIN_HOST_URL').'api/get-product-detail/'.$id;
      $method   = 'GET';
      $service = $this->callApi($method, $url);
      // dd($service);
      return view('front-end.workers.worker-service-delivery', compact('service'));
    }
}

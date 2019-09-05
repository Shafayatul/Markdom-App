<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class WorkerController extends Controller
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
      $url = env('MAIN_HOST_URL').'api/get-categories-by-module/2';
      $method = 'GET';
      $categories = $this->callApi($method, $url);

      return view('front-end.workers.index', compact('categories'));
    }

    public function subCategoryWorker($id)
    {
      $url_category = env('MAIN_HOST_URL').'api/get-subcategories-by-category/'.$id;
      $method_category = 'GET';
      $subCategories = $this->callApi($method_category, $url_category);

      return view('front-end.workers.sub-category-worker', compact('subCategories'));
    }

    public function workerDetails()
    {
      return view('front-end.workers.worker-details');
    }

    public function subSubCategoryWorker()
    {
      return view('front-end.workers.sub-sub-category-worker');
    }

    public function workerServiceDelivery()
    {
      return view('front-end.workers.worker-service-delivery');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
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

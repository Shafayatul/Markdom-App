<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;


class RentingsController extends Controller
{
    public function index()
    {
    	$renting = 'Renting';
    	$url = env('MAIN_HOST_URL').'api/get-module/'.$renting;
    	$method = 'GET';
    	$module = $this->callApi($method, $url);



	    $url = env('MAIN_HOST_URL').'api/get-stores-by-module-id/'.$module->id;
	    $method = 'GET';
	    $stores = $this->callApi($method, $url);

	    $url        = env('MAIN_HOST_URL').'api/get-offers-by-module/'.$module->id;
	    $method     = 'GET';
	    $offers     = $this->callApi($method, $url);

	      return view('front-end.workers.index', compact('stores', 'offers'));
    }

    public function check_expiration(){
      	$remaining_time = Session::get('expires_at')-time();
      	if ($remaining_time>0) {
        	return true;
      	}
      	return false;
    }
}

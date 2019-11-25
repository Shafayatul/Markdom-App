<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Session;
session_start();

class RelocationsController extends Controller
{
    public function index()
    {
    	$renting = 'Relocation';
    	$url = env('MAIN_HOST_URL').'api/get-module/'.$renting;
    	$method = 'GET';
    	$module = $this->callApi($method, $url);

    	$url = env('MAIN_HOST_URL').'api/get-relocation-store-by-module-id/'.$module->id;
	    $method = 'GET';
	    $stores = $this->callApi($method, $url);
	    return view('front-end.relocation.store-list', compact('stores'));

    }

    public function selectLocationView($id)
    {
    	if ($this->check_expiration()) {
    		Session::put('selected_relocation_store_id', $id);
    		return view('front-end.relocation.pick-drop-map', compact('id'));
    	}else{
    		return redirect('/login');
    	}
    	
    }

    public function selectLocationTwoView(){
    	return view('front-end.relocation.pick-drop-map-two');
    }

    public function selectLocationFinalStepView(){
    	$store_id = Session::get('selected_relocation_store_id');
    	$url = env('MAIN_HOST_URL').'api/get-cartype-by-store-id/'.$store_id;
	    $method = 'GET';
	    $cartypes = $this->callApi($method, $url);
	    return view('front-end.relocation.pickup-drop-map-final', compact('cartypes'));
    }

    public function ajaxGetPrice(Request $request){
    	$store_id = $request->get('store_id');
    	$url = env('MAIN_HOST_URL').'api/get-store-by-store-id/'.$store_id;
	    $method = 'GET';
	    $store = $this->callApi($method, $url);

	    $lat1 = $request->get('lat1');
	    $lat2 = $request->get('lat2');

	    $lng1 = $request->get('lng1');
	    $lng2 = $request->get('lng2');

	    $car_type_id = $request->get('cartype');
	    $url = env('MAIN_HOST_URL').'api/get-cartype-by-cartype-id/'.$car_type_id;
	    $method = 'GET';
	    $cartype = $this->callApi($method, $url);



	    $distance1 = $this->getdistance($store->lat, $store->lng, $lat1, $lng1, "k");

	    $distance2 = $this->getdistance($lat1, $lng1, $lat2, $lng2, "k");

	    $total_distance = $distance1 + $distance2;

	    $total_price = $total_distance*$cartype->per_mile_price;

    	return response()->json(['msg' => 'Success', 'price' => $total_price]);
    }

    protected function getdistance($lat1, $lon1, $lat2, $lon2, $unit) {

	  $theta = $lon1 - $lon2;
	  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	  $dist = acos($dist);
	  $dist = rad2deg($dist);
	  $miles = $dist * 60 * 1.1515;
	  $unit = strtoupper($unit);

	  if ($unit == "K") {
	      return ($miles * 1.609344);
	  } else if ($unit == "N") {
	      return ($miles * 0.8684);
	  } else {
	      return $miles;
	  }
	}

	public function relocationPlaceOrder(Request $request){
		if ($this->check_expiration()) {
       		$url = env('MAIN_HOST_URL').'api/relocation-place-order';
	      	$method = 'POST';
	      	$headers = [
	            'Authorization' => 'Bearer ' . Session::get('access_token'),
	            'Accept'        => 'application/json',
	        ];
	      	$parameters = [
	            'car_type_id'   => $request->cart_type,
	            'store_id'   => $request->store_id,
	            'lat1'      => $request->lat1,
	            'lng1'    => $request->lng1,
	            'lat2'      => $request->lat2,
	            'lng2'       => $request->lng2,
	            'price'      => $request->price
	          ];
	      	$body = $this->callApi($method, $url, $parameters, $headers);
	      	return view('front-end.relocation.success');
      }else{
        return redirect('/user-login');
      }
	}

    public function check_expiration(){
      	$remaining_time = Session::get('expires_at')-time();
      	if ($remaining_time>0) {
        	return true;
      	}
      	return false;
    }
}

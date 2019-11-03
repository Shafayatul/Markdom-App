<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Auth;
use Session;

class CustomersController extends Controller
{
    public function customerOrder($module)
    {
    	if ($this->check_expiration()) {
	        $url = env('MAIN_HOST_URL').'api/get-customer-restuarent-order/'.$module;
            $method = 'GET';
            $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
            ];
            $response = $this->callApi($method, $url, [], $headers);
            return view('front-end.auth-user.customer-order-view', compact('response'));
    	}else{
    		return redirect('/user-login');
    	}
    }

    public function restaurentSingleOrder($id)
    {
    	if ($this->check_expiration()) {
	        $url = env('MAIN_HOST_URL').'api/get-single-restuarent-order/'.$id;
            $method = 'GET';
            $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
            ];
            $response = $this->callApi($method, $url, [], $headers);
            return view('front-end.restaurent-single-order-view', compact('response'));
    	}else{
    		return redirect('/user-login');
    	}
    }

    public function workerSingleOrder($id)
    {
    	if ($this->check_expiration()) {
	        $url = env('MAIN_HOST_URL').'api/get-single-worker-order/'.$id;
            $method = 'GET';
            $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
            ];
            $response = $this->callApi($method, $url, [], $headers);
            return view('front-end.worker-single-order-view', compact('response'));
    	}else{
    		return redirect('/user-login');
    	}
    }
    

    public function storeSingleOrder($id)
    {
    	if ($this->check_expiration()) {
	        $url = env('MAIN_HOST_URL').'api/get-single-store-order/'.$id;
            $method = 'GET';
            $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
            ];
            $response = $this->callApi($method, $url, [], $headers);
            return view('front-end.store-single-order-view', compact('response'));
    	}else{
    		return redirect('/user-login');
    	}
    }

    public function restaurentOrderComplete($id)
    {
    	if ($this->check_expiration()) {
	        $url = env('MAIN_HOST_URL').'api/single-restaurent-complete/'.$id;
            $method = 'GET';
            $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
            ];
            $this->callApi($method, $url, [], $headers);
            return redirect()->back()->with('success', 'Order Completed');
    	}else{
    		return redirect('/user-login');
    	}
    }

    public function workerOrderComplete($id)
    {
    	if ($this->check_expiration()) {
	        $url = env('MAIN_HOST_URL').'api/single-worker-complete/'.$id;
            $method = 'GET';
            $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
            ];
            $this->callApi($method, $url, [], $headers);
            return redirect()->back()->with('success', 'Order Completed');
    	}else{
    		return redirect('/user-login');
    	}
    }

    public function orderReview($id, $type)
    {
    	if ($this->check_expiration()) {
	        $url = env('MAIN_HOST_URL').'api/review-check-by-order-id/'.$id.'/'.$type;
            $method = 'GET';
            $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
            ];
            $response = $this->callApi($method, $url, [], $headers);
            if($response->already_reviewed == 1){
            	return redirect()->back()->with('review-msg', true);
            }else{
            	return view('front-end.order-review', compact('id', 'type'));
            }
            
    	}else{
    		return redirect('/user-login');
    	}
    	
    }

    public function orderReviewSubmit(Request $request)
    {
    	if ($this->check_expiration()) {
	        $url = env('MAIN_HOST_URL').'api/order-review-submit';
            $method = 'POST';
            $headers = [
              'Authorization' => 'Bearer ' . Session::get('access_token'),
              'Accept'        => 'application/json',
            ];
            $parameters = [
            	'order_id' => $request->order_id,
            	'type' => $request->type,
            	'star' => $request->star,
            	'review' => $request->review
            ];
            $response = $this->callApi($method, $url, $parameters, $headers);
            return redirect('customer-review/'.$request->order_id.'/'.$request->type)->with('success', 'Order Review Success');
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

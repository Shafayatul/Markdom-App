<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ServiceType;

class WorkerServiceCostsController extends Controller
{
    public function get_service_type_price()
    {
    	$worker_prices = ServiceType::get();
    	return response()->json($worker_prices); 
    }
}

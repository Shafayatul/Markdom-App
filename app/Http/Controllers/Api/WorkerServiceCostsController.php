<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WorkerServiceCost;

class WorkerServiceCostsController extends Controller
{
    public function get_service_type_price($product_id)
    {
    	$worker_prices = WorkerServiceCost::where('product_id', $product_id)->get();
    	return response()->json($worker_prices); 
    }
}

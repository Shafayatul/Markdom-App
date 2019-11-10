<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Offer;
use App\Product;

class OffersController extends Controller
{
    public function get_offers_by_module_id($id)
    {
    	// $offers = Offer::where('module_id', $id)->latest()->get();
    	$offers = Product::where('module_id', $id)->whereNotNull('is_offer')->limit(10)->get();
    	return response()->json($offers);
    }
}

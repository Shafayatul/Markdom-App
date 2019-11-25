<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RelocationStore;
use App\RelocationStoreOrder;
use App\CarType;
use Auth;

class RelocationsController extends Controller
{
    public function get_stores_by_module_id($id)
    {
    	$stores = RelocationStore::where('module_id', $id)->get();
    	return response()->json($stores);
    }

    public function get_cartypes_by_store_id($id)
    {
    	$cartypes = CarType::where('store_id', $id)->get();
    	return response()->json($cartypes);
    }

    public function get_store_by_store_id($id)
    {
        $store = RelocationStore::where('id', $id)->first();
        return response()->json($store);
    }

    public function get_cartype_by_carttype_id($id){
        $cartype = CarType::where('id', $id)->first();
        return response()->json($cartype);
    }

    public function relocation_place_order(Request $request){
        $order = new RelocationStoreOrder;
        $order->user_id = Auth::id();
        $order->store_id = $request->input('store_id');
        $order->car_type_id = $request->input('car_type_id');
        $order->lat1 = $request->input('lat1');
        $order->lng1 = $request->input('lng1');
        $order->lat2 = $request->input('lat2');
        $order->lng2 = $request->input('lng2');
        $order->price = $request->input('price');
        $order->status = "0";
        $order->save();
        if ($order) {
            return response()->json(['msg' => 'Success']);
        }else{
             return response()->json(['msg' => 'Failed']);
        }
    }
}

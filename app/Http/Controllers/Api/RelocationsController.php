<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RelocationStore;
use App\RelocationStoreOrder;
use App\CarType;
use App\OrderStatus;
use App\OrderActivity;
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

    public function relocation_order_by_user()
    {
        $relocation_orders = RelocationStoreOrder::where('user_id', Auth::id())->get();
        $cartypes = CarType::pluck('name', 'id')->toArray();
        $stores = RelocationStore::pluck('name', 'id')->toArray();

        return response()->json([
                'relocation_orders' => $relocation_orders,
                'cartypes'          => $cartypes,
                'stores'            => $stores
            ]);
    }

    public function relocation_order_by_order_id($id){
        $relocation_order = RelocationStoreOrder::where('id', $id)->first();
        return response()->json($relocation_order);
    }

    public function relocation_order_data_update(Request $request)
    {
        $id = $request->input('selected_relocation_order_id');
        $relocation_order = RelocationStoreOrder::findOrFail($id);
        $relocation_order->payment_method = $request->input('payment_method');
        $relocation_order->paytab_transaction_id = $request->input('paytab_transaction_id');
        $relocation_order->save();
        if($relocation_order){
            $order_status_obj               = OrderStatus::first();

            $OrderActivity                  = new OrderActivity;
            $OrderActivity->order_id        = $relocation_order->id;
            $OrderActivity->status          = $order_status_obj->order_status;
            $OrderActivity->status_arabic   = $order_status_obj->order_status_arabic;
            $OrderActivity->save();
            return response()->json(['msg' => 'Success']);

        }else{
             return response()->json(['msg' => 'Failed']);
        }
    }

    public function relocation_single_order($id)
    {
        $relocation_order = RelocationStoreOrder::where('id', $id)->first();
        $cartypes = CarType::pluck('name', 'id')->toArray();
        $stores = RelocationStore::pluck('name', 'id')->toArray();

        return response()->json([
                'relocation_order' => $relocation_order,
                'cartypes'          => $cartypes,
                'stores'            => $stores
            ]);
    }
}

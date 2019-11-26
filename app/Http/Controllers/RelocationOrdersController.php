<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RelocationStoreOrder;
use Auth;
use App\User;
use App\CarType;
use App\RelocationStore;

class RelocationOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $relocation_orders = RelocationStoreOrder::latest()->paginate(25);
        $users = User::pluck('name', 'id');
        $car_types = CarType::pluck('name', 'id');
        $stores = RelocationStore::pluck('name', 'id');
        return view('relocation-orders.index', compact('relocation_orders', 'users', 'car_types', 'stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $relocation_order = RelocationStoreOrder::findOrFail($id);
        $users = User::pluck('name', 'id');
        $car_types = CarType::pluck('name', 'id');
        $stores = RelocationStore::pluck('name', 'id');
        return view('relocation-orders.show', compact('relocation_order', 'users', 'car_types', 'stores'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function confirmedOrder($id){
        $order = RelocationStoreOrder::findOrFail($id);
        $order->status = "1";
        $order->save();
        return redirect('relocation-orders')->with('success', 'Status Updated');
    }

    public function pendingOrder($id)
    {
        $order = RelocationStoreOrder::findOrFail($id);
        $order->status = "0";
        $order->save();
        return redirect('relocation-orders')->with('success', 'Status Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RelocationStoreOrder::destroy($id);
        return redirect('relocation-orders')->with('success', 'Relocation Order Deleted');
    }
}

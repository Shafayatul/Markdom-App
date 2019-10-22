<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WorkerPlaceOrder;
use App\OrderStatus;
use Auth;

class WorkerOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 25;
        $user_id = Auth::id();
        $workerorders = WorkerPlaceOrder::where('user_id', $user_id)->latest()->paginate($perPage);
        $orderstatus = OrderStatus::pluck('order_status', 'id');
        return view('worker-orders.index', compact('workerorders', 'orderstatus'));
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
        $workerorder = WorkerPlaceOrder::where('id', $id)->first();
        $orderstatus = OrderStatus::pluck('order_status', 'id');
        return view('worker-orders.show', compact('workerorder', 'orderstatus'));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        WorkerPlaceOrder::destroy($id);

        return redirect('worker-orders')->with('success', 'Store Orders deleted!');
    }

    public function workerOrderStatusChange(Request $request)
    {
        $id = $request->order_id;
        $order = WorkerPlaceOrder::where('id',$id)->first();
        $order->order_status_id = $request->order_status_id;
        $order->save();
        return redirect('worker-orders')->with('success', 'Order Status updated!');
    }
}

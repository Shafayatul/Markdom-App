<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DriverOrder;
use App\DriverOrderData;
use App\User;
use App\Store;
use Auth;
use App\RestuarentCustomerOrder;

class DriverOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = 25;
        $user_id = Auth::id();
        $driverorders = RestuarentCustomerOrder::where('driver_id', $user_id)->latest()->paginate($perPage);
        return view('driver-orders.index', compact('driverorders'));
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
        $stores = Store::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $driverorder = RestuarentCustomerOrder::where('id', $id)->first();
        return view('driver-orders.show', compact('driverorder', 'stores', 'users'));
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
        $driverorder = RestuarentCustomerOrder::findOrFail($id);
        if(file_exists($driverorder->image)){

          unlink($driverorder->image);

        }

        if(file_exists($driverorder->receipt)){

          unlink($driverorder->receipt);

        }

        RestuarentCustomerOrder::destroy($id);

        return redirect('driver-orders')->with('success', 'Driver Orders deleted!');
    }
}

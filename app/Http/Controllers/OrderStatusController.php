<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\OrderStatus;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $orderstatus = OrderStatus::where('order_status', 'LIKE', "%$keyword%")
                ->orWhere('order_status_arabic', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $orderstatus = OrderStatus::latest()->paginate($perPage);
        }

        return view('order-status.index', compact('orderstatus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('order-status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        OrderStatus::create($requestData);

        return redirect('order-status')->with('success', 'OrderStatus added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $orderstatus = OrderStatus::findOrFail($id);

        return view('order-status.show', compact('orderstatus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $orderstatus = OrderStatus::findOrFail($id);

        return view('order-status.edit', compact('orderstatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $orderstatus = OrderStatus::findOrFail($id);
        $orderstatus->update($requestData);

        return redirect('order-status')->with('success', 'OrderStatus updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        OrderStatus::destroy($id);

        return redirect('order-status')->with('success', 'OrderStatus deleted!');
    }
}

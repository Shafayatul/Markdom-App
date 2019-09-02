<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\OrderActivity;
use Illuminate\Http\Request;

class OrderActivitiesController extends Controller
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
            $orderactivities = OrderActivity::where('order_id', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('status_arabic', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $orderactivities = OrderActivity::latest()->paginate($perPage);
        }

        return view('order-activities.index', compact('orderactivities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('order-activities.create');
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
        
        OrderActivity::create($requestData);

        return redirect('order-activities')->with('success', 'OrderActivity added!');
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
        $orderactivity = OrderActivity::findOrFail($id);

        return view('order-activities.show', compact('orderactivity'));
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
        $orderactivity = OrderActivity::findOrFail($id);

        return view('order-activities.edit', compact('orderactivity'));
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
        
        $orderactivity = OrderActivity::findOrFail($id);
        $orderactivity->update($requestData);

        return redirect('order-activities')->with('success', 'OrderActivity updated!');
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
        OrderActivity::destroy($id);

        return redirect('order-activities')->with('success', 'OrderActivity deleted!');
    }
}

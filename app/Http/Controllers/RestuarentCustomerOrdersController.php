<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\RestuarentCustomerOrder;
use Illuminate\Http\Request;

class RestuarentCustomerOrdersController extends Controller
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
            $restuarentcustomerorders = RestuarentCustomerOrder::where('user_id', 'LIKE', "%$keyword%")
                ->orWhere('store_id', 'LIKE', "%$keyword%")
                ->orWhere('order_details', 'LIKE', "%$keyword%")
                ->orWhere('driver_id', 'LIKE', "%$keyword%")
                ->orWhere('offer_price', 'LIKE', "%$keyword%")
                ->orWhere('image', 'LIKE', "%$keyword%")
                ->orWhere('is_accepted', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $restuarentcustomerorders = RestuarentCustomerOrder::latest()->paginate($perPage);
        }

        return view('restuarent-customer-orders.index', compact('restuarentcustomerorders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('restuarent-customer-orders.create');
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
        
        RestuarentCustomerOrder::create($requestData);

        return redirect('restuarent-customer-orders')->with('flash_message', 'RestuarentCustomerOrder added!');
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
        $restuarentcustomerorder = RestuarentCustomerOrder::findOrFail($id);

        return view('restuarent-customer-orders.show', compact('restuarentcustomerorder'));
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
        $restuarentcustomerorder = RestuarentCustomerOrder::findOrFail($id);

        return view('restuarent-customer-orders.edit', compact('restuarentcustomerorder'));
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
        
        $restuarentcustomerorder = RestuarentCustomerOrder::findOrFail($id);
        $restuarentcustomerorder->update($requestData);

        return redirect('restuarent-customer-orders')->with('flash_message', 'RestuarentCustomerOrder updated!');
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
        RestuarentCustomerOrder::destroy($id);

        return redirect('restuarent-customer-orders')->with('flash_message', 'RestuarentCustomerOrder deleted!');
    }
}

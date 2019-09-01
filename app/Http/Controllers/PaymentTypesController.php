<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PaymentType;
use Illuminate\Http\Request;

class PaymentTypesController extends Controller
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
            $paymenttypes = PaymentType::where('payment_type', 'LIKE', "%$keyword%")
                ->orWhere('payment_type_arabic', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $paymenttypes = PaymentType::latest()->paginate($perPage);
        }

        return view('payment-types.index', compact('paymenttypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('payment-types.create');
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
        
        PaymentType::create($requestData);

        return redirect('payment-types')->with('success', 'PaymentType added!');
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
        $paymenttype = PaymentType::findOrFail($id);

        return view('payment-types.show', compact('paymenttype'));
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
        $paymenttype = PaymentType::findOrFail($id);

        return view('payment-types.edit', compact('paymenttype'));
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
        
        $paymenttype = PaymentType::findOrFail($id);
        $paymenttype->update($requestData);

        return redirect('payment-types')->with('success', 'PaymentType updated!');
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
        PaymentType::destroy($id);

        return redirect('payment-types')->with('success', 'PaymentType deleted!');
    }
}

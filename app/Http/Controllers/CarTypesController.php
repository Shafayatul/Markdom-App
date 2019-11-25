<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CarType;
use Illuminate\Http\Request;
use App\RelocationStore;

class CarTypesController extends Controller
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
            $cartypes = CarType::where('store_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('name_arabic', 'LIKE', "%$keyword%")
                ->orWhere('per_mile_price', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $cartypes = CarType::latest()->paginate($perPage);
        }
        $relocstores = RelocationStore::pluck('name', 'id');
        return view('car-types.index', compact('cartypes', 'relocstores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $relocstores = RelocationStore::pluck('name', 'id');
        return view('car-types.create', compact('relocstores'));
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
        
        CarType::create($requestData);

        return redirect('car-types')->with('success', 'CarType added!');
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
        $cartype = CarType::findOrFail($id);
        $relocstores = RelocationStore::pluck('name', 'id');
        return view('car-types.show', compact('cartype', 'relocstores'));
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
        $cartype = CarType::findOrFail($id);
        $relocstores = RelocationStore::pluck('name', 'id');
        return view('car-types.edit', compact('cartype', 'relocstores'));
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
        
        $cartype = CarType::findOrFail($id);
        $cartype->update($requestData);

        return redirect('car-types')->with('success', 'CarType updated!');
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
        CarType::destroy($id);

        return redirect('car-types')->with('success', 'CarType deleted!');
    }
}

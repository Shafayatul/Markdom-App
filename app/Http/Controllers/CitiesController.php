<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\City;
use App\State;
use Illuminate\Http\Request;

class CitiesController extends Controller
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
            $cities = City::where('name', 'LIKE', "%$keyword%")
                ->orWhere('name_arabic', 'LIKE', "%$keyword%")
                ->orWhere('state_id', 'LIKE', "%$keyword%")
                ->orWhere('cod', 'LIKE', "%$keyword%")
                ->orWhere('bank_transfers', 'LIKE', "%$keyword%")
                ->orWhere('delivery_fees', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $cities = City::latest()->paginate($perPage);
        }
        $states = State::pluck('name', 'id');
        return view('cities.index', compact('cities', 'states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $states = State::pluck('name', 'id');
        return view('cities.create', compact('states'));
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
        
        City::create($requestData);

        return redirect('cities')->with('success', 'City added!');
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
        $city = City::findOrFail($id);
        $states = State::pluck('name', 'id');
        return view('cities.show', compact('city', 'states'));
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
        $city = City::findOrFail($id);
        $states = State::pluck('name', 'id');
        return view('cities.edit', compact('city', 'states'));
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
        
        $city = City::findOrFail($id);
        $city->update($requestData);

        return redirect('cities')->with('success', 'City updated!');
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
        City::destroy($id);

        return redirect('cities')->with('success', 'City deleted!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Address;
use App\City;
use App\State;
use App\Country;
use App\User;
use Illuminate\Http\Request;

class AddressesController extends Controller
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
            $addresses = Address::where('user_id', 'LIKE', "%$keyword%")
                ->orWhere('flat_no', 'LIKE', "%$keyword%")
                ->orWhere('location', 'LIKE', "%$keyword%")
                ->orWhere('pin_code', 'LIKE', "%$keyword%")
                ->orWhere('phone_no', 'LIKE', "%$keyword%")
                ->orWhere('state_id', 'LIKE', "%$keyword%")
                ->orWhere('city_id', 'LIKE', "%$keyword%")
                ->orWhere('country_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $addresses = Address::latest()->paginate($perPage);
        }
        $users      = User::pluck('name', 'id'); 
        $cities     = City::pluck('name', 'id');
        $states     = State::pluck('name', 'id');
        $countries  = Country::pluck('name', 'id');
        return view('addresses.index', compact('addresses', 'cities', 'states', 'countries', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $cities     = City::pluck('name', 'id');
        $states     = State::pluck('name', 'id');
        $countries  = Country::pluck('name', 'id');
        return view('addresses.create', compact('cities', 'states', 'countries'));
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
        
        Address::create($requestData);

        return redirect('addresses')->with('success', 'Address added!');
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
        $address    = Address::findOrFail($id);
        $cities     = City::pluck('name', 'id');
        $states     = State::pluck('name', 'id');
        $countries  = Country::pluck('name', 'id');
        $users      = User::pluck('name', 'id'); 
        return view('addresses.show', compact('address', 'cities', 'states', 'countries', 'users'));
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
        $address    = Address::findOrFail($id);
        $cities     = City::pluck('name', 'id');
        $states     = State::pluck('name', 'id');
        $countries  = Country::pluck('name', 'id');
        return view('addresses.edit', compact('address', 'cities', 'states', 'countries'));
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
        
        $address = Address::findOrFail($id);
        $address->update($requestData);

        return redirect('addresses')->with('success', 'Address updated!');
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
        Address::destroy($id);

        return redirect('addresses')->with('success', 'Address deleted!');
    }
}

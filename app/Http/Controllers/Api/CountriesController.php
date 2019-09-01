<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Country;
use App\State;
use App\City;

class CountriesController extends Controller
{
    public function index(){
        $countries = Country::latest()->get();
        return response()->json($countries);
    }

    public function state($country_id){
        $states = State::where('country_id', $country_id)->get();
        return response()->json($states);
    }
    
    public function city($state_id){
        $cities = City::where('state_id', $state_id)->get();
        return response()->json($cities);
    }
}

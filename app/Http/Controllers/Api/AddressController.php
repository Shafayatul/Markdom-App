<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Address;
use App\City;
use App\State;
use App\Country;

class AddressController extends Controller
{
    public function index(){
        $data = [];
        $addresses=Address::where('user_id', Auth::id())->latest()->get();
        foreach ($addresses as $address) {
            
            $single_data = [];

            $single_data["id"]         = $address->id;       
            $single_data["user_id"]    = $address->user_id;    
            $single_data["flat_no"]    = $address->flat_no;    
            $single_data["location"]   = $address->location;    
            $single_data["pin_code"]   = $address->pin_code;    
            $single_data["phone_no"]   = $address->phone_no;    
            $single_data["created_at"] = $address->created_at;       
            $single_data["updated_at"] = $address->updated_at;       
            $single_data["state_id"]   = $address->state_id;    
            $single_data["state"]      = State::where('id', $address->state_id)->first();    
            $single_data["city_id"]    = $address->city_id;    
            $single_data["city"]       = City::where('id', $address->city_id)->first(); 
            $single_data["country_id"] = $address->country_id;   
            $single_data["country"]    = Country::where('id', $address->country_id)->first();

            array_push($data, $single_data);

        }
        return response()->json($data);
    }
    
    public function get_single_address($id){
        $data = [];
        $address=Address::where('id', $id)->first();

        $single_data["id"]         = $address->id;       
        $single_data["user_id"]    = $address->user_id;    
        $single_data["flat_no"]    = $address->flat_no;    
        $single_data["location"]   = $address->location;    
        $single_data["pin_code"]   = $address->pin_code;    
        $single_data["phone_no"]   = $address->phone_no;    
        $single_data["created_at"] = $address->created_at;       
        $single_data["updated_at"] = $address->updated_at;       
        $single_data["state_id"]   = $address->state_id;    
        $single_data["state"]      = State::where('id', $address->state_id)->first();    
        $single_data["city_id"]    = $address->city_id;    
        $single_data["city"]       = City::where('id', $address->city_id)->first(); 
        $single_data["country_id"] = $address->country_id;   
        $single_data["country"]    = Country::where('id', $address->country_id)->first();

        return response()->json($single_data);
    }


    public function store(Request $request)
    {

        $flat_no = '';
        if (($request->input("flat_no") !== null) ) {
            $flat_no = $request->input('flat_no');
        }
        $location = '';
        if (($request->input("location") !== null) ) {
            $location = $request->input('location');
        }
        $pin_code = '';
        if (($request->input("pin_code") !== null) ) {
            $pin_code = $request->input('pin_code');
        }
        $country_id    = $request->input('country_id');  
        $state_id      = $request->input('state_id');  
        $city_id       = $request->input('city_id'); 



        if (!is_numeric($country_id)) {


            // get country id
            if(strlen($country_id) != mb_strlen($country_id, 'utf-8')){
                $country = Country::where('country_arabic', $country_id)->first();
            }else{
                $country = Country::where('country', $country_id)->first();
            }

            if ($country) {
                $country_id = $country->id; 
            }else{
                $country                    = new Country;
                $country->country           = $country_id;
                $country->country_arabic    = $country_id;
                $country->save();    
                $country_id = $country->id;            
            }

            // get state id 
            
            if(strlen($state_id) != mb_strlen($state_id, 'utf-8')){
                $state = State::where('state_arabic', $state_id)->where('country_id', $country_id)->first();
            }else{
                $state = State::where('state', $state_id)->where('country_id', $country_id)->first();
            }
            
            if ($state) {
                $state_id = $state->id; 
            }else{
                $state               = new State;
                $state->state        = $state_id;
                $state->state_arabic = $state_id;
                $state->country_id   = $country_id;
                $state->save();    
                $state_id = $state->id;            
            }

            // get city id 
            if(strlen($city_id) != mb_strlen($city_id, 'utf-8')){
                $city = City::where('city_arabic', $city_id)->where('state_id', $state_id)->first();
            }else{
                $city = City::where('city', $city_id)->where('state_id', $state_id)->first();
            }

            if ($city) {
                $city_id = $city->id; 
            }else{
                $city                   = new City;
                $city->city             = $city_id;
                $city->city_arabic      = $city_id;
                $city->state_id         = $state_id;
                $city->cod              = 1;
                $city->bank_transfers   = 1;
                $city->delivery_fees    = '35';
                $city->save();    
                $city_id = $city->id;            
            }

            
        }

		$address = new Address;
		$address->user_id    	= Auth::id();  
		$address->flat_no    	= $flat_no;  
		$address->location    	= $location;  
		$address->country_id    = $country_id;  
        $address->state_id      = $state_id;  
        $address->city_id       = $city_id;  
		$address->pin_code    	= $pin_code;  
		$address->phone_no    	= $request->input('phone_no');  
		$address->save();  

        return response()->json($address);
    }

    public function destroy(Request $request)
    {
        
		Address::where('user_id', Auth::id())->where('id', $request->input('address_id'))->delete();

        return response()->json([
            'message' => 'Successfully deleted.'
        ]);
    }
}

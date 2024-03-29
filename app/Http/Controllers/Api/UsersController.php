<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|unique:users',
            'password'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 1,
        ]);
        return response()->json([
                'message' => 'Signup is successful'
            ]);

        // if ($user){
        //     $user           = User::find($user->id);
        //     $user->phone    = $request->input('phone');
        //     $user->gender   = $request->input('gender');
        //     $user->status   = 1;
        //     $user->save();
            
        // }
    }

    public function checkDriver()
    {
        if (!Auth::check()) {
            return response()->json([
                'message' => 0
            ]);
        }else{
            $user = User::where('id', Auth::id())->first();
            if ($user->hasRole('driver')) {
                $is_driver = 1;
            }else{
                $is_driver = 0;
            }
            return response()->json([
                'message' => $is_driver
            ]);            
        }
    }


    public function user_details()
    {
    	$user = User::where('id', Auth::id())->first();
    	return response()->json($user);

    }

    public function customer_detail($id)
    {
        $user = User::where('id', $id)->first();
        return response()->json($user);

    }

    public function get_current_user_data(Request $request){
        $fcm_token = $request->input('fcm_token');
        if (($fcm_token != '') || ($fcm_token != null)) {
            $user            = User::find(Auth::id());
            $user->fcm_token = $fcm_token;
            $user->save();
        }
        $user = User::where('id', Auth::id())->first();
        return response()->json($user);
    }

    public function change_password(Request $request)
    {
    	$this->validate($request,[
            'old_password'      => ['required', 'string', 'min:8'],
            'new_password'      => ['required', 'string', 'min:8'],
            'confirm_password'  => ['required', 'string', 'min:8'],
        ]);

        $old_password       = $request->old_password;
        $new_password       = $request->new_password;
        $confirm_password   = $request->confirm_password;
        
        
        if($new_password == $confirm_password){
            $current_password = Auth::user()->password;
            if(Hash::check($old_password, $current_password))
            {
                $id             = Auth::user()->id;
                $user           = User::findOrFail($id);
                $user->password = Hash::make($new_password);
                $user->save(); 
                return response()->json(['message'=>'Passowrd Updated!']);
            }
        }else{
            return response()->json(['message'=>'New Password and Confirm password not matching!']);
        }
    }


    public function change_language(Request $request){
        $language = $request->input('language');
        if (($language != '') || ($language != null)) {
            $user            = User::find(Auth::id());
            $user->language  = $language;
            $user->save();
        }
        if ($user) {
            return response()->json([
                'status'  => '1',
                'message' => 'language changed success!'
            ]);
        }else{
            return response()->json([
                'status'  => '0',
                'message' => 'Unsuccess!'
            ]);
        }

    }

    public function update_user_info(Request $request){
        $name 		= $request->input('name');
        $language 	= $request->input('language');

        if (($name != '') || ($name != null)) {
            $user           	= User::find(Auth::id());
            $user->name  		= $name;
            $user->language  	= $language;
            $user->save();
        }
        if ($user) {
            return response()->json([
                'status'  => '1',
                'message' => 'User Info Updated success!'
            ]);
        }else{
            return response()->json([
                'status'  => '0',
                'message' => 'Unsuccess!'
            ]);
        }

    }

    public function logoutApi(Request $request){
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}

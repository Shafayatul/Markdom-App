<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PromoCode;

class PromoCodesController extends Controller
{
    public function get_promo_codes(){
        $textures=PromoCode::latest()->get();
        return response()->json($textures);
    }

    public function promo_code_validation(Request $request){
        $count=PromoCode::where('code', $request->input('code'))->count();
        if ($count>0) {
            $promo_code = PromoCode::where('code', $request->input('code'))->first();
	        return response()->json([
	            'message' => 'Success',
                'detail' => $promo_code
	        ]);
        }else{
	        return response()->json([
	            'message' => 'Failed'
	        ]);
        }
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Review;
use Auth;

class ReviewsController extends Controller
{
    public function post_review(Request $request)
    {
    	$this->validate($request,[
    		'star' => 'required',
    		'review' => 'required'
    	]);

    	$review 			= new Review;
    	$review->user_id 	= Auth::user()->id;
    	$review->star 		= $request->input('star');
    	$review->review 	= $request->input('review');
    	$review->save();

    	return response()->json([
            'message' => 'Successfully Sent'
        ]);
    }
}

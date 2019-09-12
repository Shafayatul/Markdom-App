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

        $review = Review::updateOrCreate(
            [
                'user_id'   => Auth::id(), 
                'store_id'  => $request->input('store_id')
            ],
            [
                'star'      =>  $request->input('star'), 
                'review'    =>  $request->input('review')
            ]
        );
        return response()->json($review);
    }

    public function get_review_by_store_id($store_id)
    {
        $reviews        = Review::where('store_id', $store_id)->get();
        $avg_reviews     = $reviews->avg('star');
        $avg_review     = ceil($avg_reviews);
        return response()->json($avg_review);
    }
}

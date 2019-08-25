<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Review;
use Illuminate\Http\Request;
use App\User;

class ReviewsController extends Controller
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
            $reviews = Review::where('user_id', 'LIKE', "%$keyword%")
                ->orWhere('star', 'LIKE', "%$keyword%")
                ->orWhere('review', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $reviews = Review::latest()->paginate($perPage);
        }
        $users = User::pluck('name', 'id');
        return view('reviews.index', compact('reviews', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name', 'id');
        return view('reviews.create', compact('users'));
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
        
        Review::create($requestData);

        return redirect('reviews/create')->with('success', 'Review added!');
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
        $review = Review::findOrFail($id);
        $users = User::pluck('name', 'id');
        return view('reviews.show', compact('review', 'users'));
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
        $review = Review::findOrFail($id);
        $users = User::pluck('name', 'id');
        return view('reviews.edit', compact('review', 'users'));
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
        
        $review = Review::findOrFail($id);
        $review->update($requestData);

        return redirect('reviews')->with('success', 'Review updated!');
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
        Review::destroy($id);

        return redirect('reviews')->with('success', 'Review deleted!');
    }
}

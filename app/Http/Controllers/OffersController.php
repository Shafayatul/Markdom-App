<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Offer;
use Illuminate\Http\Request;

class OffersController extends Controller
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
            $offers = Offer::where('title', 'LIKE', "%$keyword%")
                ->orWhere('title_arabic', 'LIKE', "%$keyword%")
                ->orWhere('is_amount', 'LIKE', "%$keyword%")
                ->orWhere('amount', 'LIKE', "%$keyword%")
                ->orWhere('percentage', 'LIKE', "%$keyword%")
                ->orWhere('image', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $offers = Offer::latest()->paginate($perPage);
        }

        return view('offers.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('offers.create');
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
        if($request->hasFile('image')){
            $image      = $request->file('image');
            $image_name = uniqid().'.'.strtolower($image->getClientOriginalExtension());
            $path       = 'offer-image/';
            $image_url  = $path.$image_name;
            $image->move($path,$image_name);
        }else{
            $image_url  = null;
        }

        $offer                  = new Offer();
        $offer->title           = $request->title;
        $offer->title_arabic    = $request->title_arabic;
        $offer->is_amount            = $request->type;
        $offer->amount          = $request->amount;
        $offer->percentage      = $request->percentage;
        $offer->image           = $image_url;
        $offer->save();

        return redirect('offers')->with('success', 'Offer added!');
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
        $offer = Offer::findOrFail($id);

        return view('offers.show', compact('offer'));
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
        $offer = Offer::findOrFail($id);

        return view('offers.edit', compact('offer'));
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
        $offer = Offer::findOrFail($id);
        if($request->hasFile('image')){
            $image      = $request->file('image');
            $image_name = uniqid().'.'.strtolower($image->getClientOriginalExtension());
            $path       = 'offer-image/';
            $image_url  = $path.$image_name;
            $image->move($path,$image_name);
            if($offer->image != null){
                unlink($offer->image);
            }
        }else{
            $image_url  = $offer->image;
        }

        $offer->title           = $request->title;
        $offer->title_arabic    = $request->title_arabic;
        $offer->is_amount            = $request->type;
        $offer->amount          = $request->amount;
        $offer->percentage      = $request->percentage;
        $offer->image           = $image_url;
        $offer->save();

        return redirect('offers')->with('success', 'Offer updated!');
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
        $offer = Offer::findOrFail($id);
        if($offer->image != null){
            unlink($offer->image);
        }
        Offer::destroy($id);

        return redirect('offers')->with('success', 'Offer deleted!');
    }
}

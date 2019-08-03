<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SubCategory;
use App\Category;
use Illuminate\Http\Request;

class SubCategoriesController extends Controller
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
            $subcategories = SubCategory::where('category_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('name_arabic', 'LIKE', "%$keyword%")
                ->orWhere('image', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $subcategories = SubCategory::latest()->paginate($perPage);
        }
        $category = Category::pluck('name','id');
        return view('sub-categories.index', compact('subcategories','category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $category = Category::pluck('name','id');
        return view('sub-categories.create',compact('category'));
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
            $path       = 'subcategory-image/';
            $image_url  = $path.$image_name;
            $image->move($path,$image_name);
        }else{
            $image_url  = null;
        }

        $subcategory               = new SubCategory();
        $subcategory->category_id  = $request->category_id;
        $subcategory->name         = $request->name;
        $subcategory->name_arabic  = $request->name_arabic;
        $subcategory->image        = $image_url;
        $subcategory->save();

        return redirect('sub-categories/create')->with('success', 'SubCategory added!');
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
        $subcategory = SubCategory::findOrFail($id);
        $category = Category::pluck('name','id');
        return view('sub-categories.show', compact('subcategory','category'));
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
        $subcategory = SubCategory::findOrFail($id);
        $category = Category::pluck('name','id');

        return view('sub-categories.edit', compact('subcategory','category'));
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
        $subcategory = SubCategory::findOrFail($id);

        if($request->hasFile('image')){
            $image      = $request->file('image');
            $image_name = uniqid().'.'.strtolower($image->getClientOriginalExtension());
            $path       = 'subcategory-image/';
            $image_url  = $path.$image_name;
            $image->move($path,$image_name);
            if($subcategory->image != null){
                unlink($subcategory->image);
            }
        }else{
            $image_url  = $subcategory->image;
        }

        $subcategory->category_id  = $request->category_id;
        $subcategory->name         = $request->name;
        $subcategory->name_arabic  = $request->name_arabic;
        $subcategory->image        = $image_url;
        $subcategory->save();

        return redirect('sub-categories')->with('success', 'SubCategory updated!');
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
        $subcategory = SubCategory::findOrFail($id);
        if($subcategory->image != null){
            unlink($subcategory->image);
        }

        SubCategory::destroy($id);

        return redirect('sub-categories')->with('success', 'SubCategory deleted!');
    }
}

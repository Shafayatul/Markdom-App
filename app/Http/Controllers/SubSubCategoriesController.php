<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SubSubCategory;
use App\SubCategory;
use App\Category;
use App\Module;
use Illuminate\Http\Request;

class SubSubCategoriesController extends Controller
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
            $subsubcategories = SubSubCategory::where('sub_category_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('name_arabic', 'LIKE', "%$keyword%")
                ->orWhere('image', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $subsubcategories = SubSubCategory::latest()->paginate($perPage);
        }
        $subcategories = SubCategory::pluck('name', 'id');
        $modules = Module::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        return view('sub-sub-categories.index', compact('subsubcategories', 'subcategories', 'modules', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $subcategories = SubCategory::pluck('name', 'id');
        $modules = Module::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        return view('sub-sub-categories.create', compact('subcategories', 'modules', 'categories'));
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
            $path       = 'sub-sub-category-img/';
            $image_url  = $path.$image_name;
            $image->move($path,$image_name);
        }else{
            $image_url  = null;
        }

        $subcategory                    = new SubSubCategory();
        $subcategory->sub_category_id   = $request->sub_category_id;
        $subcategory->category_id       = $request->category_id;
        $subcategory->module_id         = $request->module_id;
        $subcategory->name              = $request->name;
        $subcategory->name_arabic       = $request->name_arabic;
        $subcategory->image             = $image_url;
        $subcategory->save();

        return redirect('sub-sub-categories/create')->with('success', 'SubSubCategory added!');
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
        $subsubcategory = SubSubCategory::findOrFail($id);
        $subcategories = SubCategory::pluck('name', 'id');
        $modules = Module::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        return view('sub-sub-categories.show', compact('subsubcategory', 'subcategories', 'modules', 'categories'));
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
        $subsubcategory = SubSubCategory::findOrFail($id);
        $subcategories = SubCategory::pluck('name', 'id');
        $modules = Module::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        return view('sub-sub-categories.edit', compact('subsubcategory','subcategories', 'modules', 'categories'));
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
        
        $subsubcategory = SubSubCategory::findOrFail($id);
        if($request->hasFile('image')){
            $image      = $request->file('image');
            $image_name = uniqid().'.'.strtolower($image->getClientOriginalExtension());
            $path       = 'sub-sub-category-img/';
            $image_url  = $path.$image_name;
            $image->move($path,$image_name);
            if($subsubcategory->image != null){
                unlink($subsubcategory->image);
            }
        }else{
            $image_url  = $subsubcategory->image;
        }

        $subcategory->category_id           = $subsubcategory->category_id;
        $subcategory->module_id             = $subsubcategory->module_id;
        $subsubcategory->sub_category_id    = $subsubcategory->sub_category_id;
        $subsubcategory->name               = $request->name;
        $subsubcategory->name_arabic        = $request->name_arabic;
        $subsubcategory->image              = $image_url;
        $subsubcategory->save();

        return redirect('sub-sub-categories')->with('success', 'SubSubCategory updated!');
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
        $subsubcategory = SubSubCategory::findOrFail($id);
        if($subsubcategory->image != null){
            unlink($subsubcategory->image);
        }
        SubSubCategory::destroy($id);

        return redirect('sub-sub-categories')->with('success', 'SubSubCategory deleted!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ServiceSubCategory;
use App\ServiceCategory;
use Illuminate\Http\Request;
use Auth;

class ServiceSubCategoriesController extends Controller
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
            $servicesubcategories = ServiceSubCategory::where('user_id', 'LIKE', "%$keyword%")
                ->orWhere('service_category_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('name_arabic', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $servicesubcategories = ServiceSubCategory::latest()->paginate($perPage);
        }
        $service_categories = ServiceCategory::pluck('name', 'id');
        return view('service-sub-categories.index', compact('servicesubcategories', 'service_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $service_categories = ServiceCategory::pluck('name', 'id');
        return view('service-sub-categories.create', compact('service_categories'));
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
        if($request->hasFile('preview_image')){
            $image          = $request->file('preview_image');
            $image_name     = uniqid().'.'.strtolower($image->getClientOriginalExtension());
            $image_path     = 'services-sub-category-images/';
            $image_url      = $image_path.$image_name;
            $image->move($image_path, $image_name);
        }else{
            $image_url = null;
        }
        $servicesubcategory                         = new ServiceSubCategory();
        $servicesubcategory->user_id                = Auth::id();
        $servicesubcategory->service_category_id    = $request->service_category_id;
        $servicesubcategory->name                   = $request->name;
        $servicesubcategory->name_arabic            = $request->name_arabic;
        $servicesubcategory->preview_image          = $image_url;
        $servicesubcategory->save();

        return redirect('service-sub-categories')->with('success', 'ServiceSubCategory added!');
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
        $servicesubcategory = ServiceSubCategory::findOrFail($id);
        $service_categories = ServiceCategory::pluck('name', 'id');
        return view('service-sub-categories.show', compact('servicesubcategory', 'service_categories'));
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
        $servicesubcategory = ServiceSubCategory::findOrFail($id);
        $service_categories = ServiceCategory::pluck('name', 'id');
        return view('service-sub-categories.edit', compact('servicesubcategory', 'service_categories'));
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
        $servicesubcategory                         = ServiceSubCategory::findOrFail($id);
        if($request->hasFile('preview_image')){
            $image          = $request->file('preview_image');
            $image_name     = uniqid().'.'.strtolower($image->getClientOriginalExtension());
            $image_path     = 'services-sub-category-images/';
            $image_url      = $image_path.$image_name;
            $image->move($image_path, $image_name);
            if($servicesubcategory->preview_image != null){
                unlink($servicesubcategory->preview_image);
            }
        }else{
            $image_url = $servicesubcategory->preview_image;
        }
        $servicesubcategory->user_id                = Auth::id();
        $servicesubcategory->service_category_id    = $request->service_category_id;
        $servicesubcategory->name                   = $request->name;
        $servicesubcategory->name_arabic            = $request->name_arabic;
        $servicesubcategory->preview_image          = $image_url;
        $servicesubcategory->save();

        return redirect('service-sub-categories')->with('success', 'ServiceSubCategory updated!');
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
        $servicesubcategory = ServiceSubCategory::findOrFail($id);
        if($servicesubcategory->preview_image != null){
            unlink($servicesubcategory->preview_image);
        }
        ServiceSubCategory::destroy($id);

        return redirect('service-sub-categories')->with('success', 'ServiceSubCategory deleted!');
    }
}

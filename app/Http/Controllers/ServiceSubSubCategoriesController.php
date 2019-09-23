<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ServiceSubSubCategory;
use App\ServiceSubCategory;
use App\ServiceCategory;
use App\Store;
use App\Module;
use Illuminate\Http\Request;

class ServiceSubSubCategoriesController extends Controller
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
            $servicesubsubcategories = ServiceSubSubCategory::where('user_id', 'LIKE', "%$keyword%")
                ->orWhere('service_category_id', 'LIKE', "%$keyword%")
                ->orWhere('service_sub_category_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('name_arabic', 'LIKE', "%$keyword%")
                ->orWhere('preview_image', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $servicesubsubcategories = ServiceSubSubCategory::latest()->paginate($perPage);
        }
        $stores = Store::pluck('name', 'id');
        $modules = Module::pluck('name', 'id');
        $service_categories = ServiceCategory::pluck('name', 'id');
        $service_sub_categories = ServiceSubCategory::pluck('name', 'id');
        return view('service-sub-sub-categories.index', compact('servicesubsubcategories', 'service_categories', 'service_sub_categories', 'stores', 'modules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $service_categories = ServiceCategory::pluck('name', 'id');
        $service_sub_categories = ServiceSubCategory::pluck('name', 'id');
        $stores = Store::pluck('name', 'id');
        $modules = Module::pluck('name', 'id');
        return view('service-sub-sub-categories.create', compact('service_categories', 'service_sub_categories', 'stores', 'modules'));
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
            $image_path     = 'services-sub-sub-category-images/';
            $image_url      = $image_path.$image_name;
            $image->move($image_path, $image_name);
        }else{
            $image_url = null;
        }
        
       $servicesubsubcategory                           = new ServiceSubSubCategory();
       $servicesubsubcategory->service_category_id      = $request->service_category_id;
       $servicesubsubcategory->service_sub_category_id  = $request->service_sub_category_id;
       $servicesubsubcategory->store_id                 = $request->store_id;
       $servicesubsubcategory->module_id                = $request->module_id;
       $servicesubsubcategory->name                     = $request->name;
       $servicesubsubcategory->name_arabic              = $request->name_arabic;
       $servicesubsubcategory->preview_image            = $image_url;
       $servicesubsubcategory->save();

        return redirect('service-sub-sub-categories')->with('success', 'ServiceSubSubCategory added!');
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
        $servicesubsubcategory = ServiceSubSubCategory::findOrFail($id);
        $service_categories = ServiceCategory::pluck('name', 'id');
        $service_sub_categories = ServiceSubCategory::pluck('name', 'id');
        $stores = Store::pluck('name', 'id');
        $modules = Module::pluck('name', 'id');
        return view('service-sub-sub-categories.show', compact('servicesubsubcategory', 'service_categories', 'service_sub_categories', 'stores', 'modules'));
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
        $servicesubsubcategory = ServiceSubSubCategory::findOrFail($id);
        $service_categories = ServiceCategory::pluck('name', 'id');
        $service_sub_categories = ServiceSubCategory::pluck('name', 'id');
        $stores = Store::pluck('name', 'id');
        $modules = Module::pluck('name', 'id');
        return view('service-sub-sub-categories.edit', compact('servicesubsubcategory', 'service_categories', 'service_sub_categories', 'stores', 'modules'));
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
        $servicesubsubcategory = ServiceSubSubCategory::findOrFail($id);
        if($request->hasFile('preview_image')){
            $image          = $request->file('preview_image');
            $image_name     = uniqid().'.'.strtolower($image->getClientOriginalExtension());
            $image_path     = 'services-sub-sub-category-images/';
            $image_url      = $image_path.$image_name;
            $image->move($image_path, $image_name);
            if($servicesubsubcategory->preview_image != null){
                unlink($servicesubsubcategory->preview_image);
            }
        }else{
            $image_url = $servicesubsubcategory->preview_image;
        }

        $servicesubsubcategory->service_category_id      = $request->service_category_id;
        $servicesubsubcategory->service_sub_category_id  = $request->service_sub_category_id;
        $servicesubsubcategory->store_id                 = $request->store_id;
        $servicesubsubcategory->module_id                = $request->module_id;
        $servicesubsubcategory->name                     = $request->name;
        $servicesubsubcategory->name_arabic              = $request->name_arabic;
        $servicesubsubcategory->preview_image            = $image_url;
        $servicesubsubcategory->save();

        return redirect('service-sub-sub-categories')->with('success', 'ServiceSubSubCategory updated!');
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
        $servicesubsubcategory = ServiceSubSubCategory::findOrFail($id);
        if($servicesubsubcategory->preview_image != null){
            unlink($servicesubsubcategory->preview_image);
        }
        ServiceSubSubCategory::destroy($id);

        return redirect('service-sub-sub-categories')->with('success', 'ServiceSubSubCategory deleted!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ServiceCategory;
use App\Store;
use App\Module;
use Illuminate\Http\Request;
use Auth;

class ServiceCategoriesController extends Controller
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
            $servicecategories = ServiceCategory::where('user_id', 'LIKE', "%$keyword%")
                ->orWhere('store_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('name_arabic', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $servicecategories = ServiceCategory::latest()->paginate($perPage);
        }
        $stores = Store::where('store_owner_id', Auth::id())->pluck('name', 'id');
        $modules = Module::pluck('name', 'id');
        return view('service-categories.index', compact('servicecategories', 'stores', 'modules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $stores = Store::where('store_owner_id', Auth::id())->pluck('name', 'id');
        $modules = Module::pluck('name', 'id');
        return view('service-categories.create', compact('stores', 'modules'));
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
            $image_path     = 'services-category-images/';
            $image_url      = $image_path.$image_name;
            $image->move($image_path, $image_name);
        }else{
            $image_url = null;
        }
        $servicecategory                = new ServiceCategory();
        $servicecategory->store_id      = $request->store_id;
        $servicecategory->module_id     = $request->module_id;
        $servicecategory->user_id       = Auth::id();
        $servicecategory->name          = $request->name;
        $servicecategory->name_arabic   = $request->name_arabic;
        $servicecategory->preview_image = $image_url;
        $servicecategory->save();

        return redirect('service-categories')->with('success', 'ServiceCategory added!');
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
        $servicecategory = ServiceCategory::findOrFail($id);
        $stores = Store::where('store_owner_id', Auth::id())->pluck('name', 'id');
        $modules = Module::pluck('name', 'id');
        return view('service-categories.show', compact('servicecategory', 'stores', 'modules'));
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
        $servicecategory = ServiceCategory::findOrFail($id);
        $stores = Store::where('store_owner_id', Auth::id())->pluck('name', 'id');
        $modules = Module::pluck('name', 'id');
        return view('service-categories.edit', compact('servicecategory', 'stores', 'modules'));
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
        $servicecategory = ServiceCategory::findOrFail($id);
        if($request->hasFile('preview_image')){
            $image          = $request->file('preview_image');
            $image_name     = uniqid().'.'.strtolower($image->getClientOriginalExtension());
            $image_path     = 'services-category-images/';
            $image_url      = $image_path.$image_name;
            $image->move($image_path, $image_name);
            if($servicecategory->preview_image != null){
                unlink($servicecategory->preview_image);
            }
        }else{
            $image_url = $servicecategory->preview_image;
        }
        $servicecategory->store_id      = $request->store_id;
        $servicecategory->module_id     = $request->module_id;
        $servicecategory->user_id       = Auth::id();
        $servicecategory->name          = $request->name;
        $servicecategory->name_arabic   = $request->name_arabic;
        $servicecategory->preview_image = $image_url;
        $servicecategory->save();

        return redirect('service-categories')->with('success', 'ServiceCategory updated!');
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
        $servicecategory = ServiceCategory::findOrFail($id);
        if($servicecategory->preview_image != null){
            unlink($servicecategory->preview_image);
        }
        ServiceCategory::destroy($id);

        return redirect('service-categories')->with('success', 'ServiceCategory deleted!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Store;
use App\SubCategory;
use App\Category;
use App\Module;
use Illuminate\Http\Request;
use Auth;

class StoresController extends Controller
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
            $stores = Store::where('sub_category_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('name_arabic', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('preview_image', 'LIKE', "%$keyword%")
                ->orWhere('multiple_images', 'LIKE', "%$keyword%")
                ->orWhere('lat', 'LIKE', "%$keyword%")
                ->orWhere('lan', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $stores = Store::latest()->paginate($perPage);
        }
        $subcategories = SubCategory::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        return view('stores.index', compact('stores', 'subcategories', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $subcategories = SubCategory::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $modules = Module::pluck('name', 'id');
        return view('stores.create', compact('subcategories', 'categories', 'modules'));
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
            $preview_image      = $request->file('preview_image');
            $preview_image_name = uniqid().'.'.strtolower($preview_image->getClientOriginalExtension());
            $preview_image_path = 'store-images/';
            $preview_image_url  = $preview_image_path.$preview_image_name;
            $preview_image->move($preview_image_path,$preview_image_name);
        }else{
            $preview_image_url  = null;
        }

        if($request->hasFile('multiple_images')){
            $multi_images      = $request->file('multiple_images');

            foreach($multi_images as $image)
            {
                $multi_image_name = uniqid().'.'.strtolower($image->getClientOriginalExtension());
                $multi_image_path = 'store-images/';
                $multi_image_url  = $multi_image_path.$multi_image_name;
                $image->move($multi_image_path, $multi_image_name);
                $data[] = $multi_image_url;  
            }
        }else{
            $data[]  = null;
        }
        
        $store                          = new Store();
        $store->sub_category_id         = $request->sub_category_id;
        $store->category_id             = $request->category_id;
        $store->name                    = $request->name;
        $store->name_arabic             = $request->name_arabic;
        $store->description             = $request->description;
        $store->arabic_description      = $request->arabic_description;
        $store->lat                     = $request->lat;
        $store->lan                     = $request->lan;
        $store->status                  = $request->status;
        $store->store_owner_id          = Auth::user()->id;
        $store->preview_image           = $preview_image_url;
        if($data[0] == null){
            $data_img = null;
        }else{
            $data_img = implode(',', $data);
        }
        // dd($data_img);
        $store->multiple_images         = $data_img;
        $store->location                = $request->location;
        $store->arabic_location         = $request->arabic_location;
        $store->save();

        return redirect('stores')->with('success', 'Store added!');
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
        $store = Store::findOrFail($id);
        $subcategories = SubCategory::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        return view('stores.show', compact('store', 'subcategories', 'categories'));
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
        $subcategories = SubCategory::pluck('name', 'id');
        $store = Store::findOrFail($id);
        $categories = Category::pluck('name', 'id');
        return view('stores.edit', compact('store', 'subcategories', 'categories'));
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
        
        $store = Store::findOrFail($id);
        if($request->hasFile('preview_image')){
            $preview_image      = $request->file('preview_image');
            $preview_image_name = uniqid().'.'.strtolower($preview_image->getClientOriginalExtension());
            $preview_image_path = 'store-images/';
            $preview_image_url  = $preview_image_path.$preview_image_name;
            $preview_image->move($preview_image_path,$preview_image_name);
            if($store->preview_image != null){
                unlink($store->preview_image);
            }
        }else{
            $preview_image_url  = $store->preview_image;
        }

        if($request->hasFile('multiple_images')){
            $multi_images      = $request->file('multiple_images');

            foreach($multi_images as $image)
            {
                $multi_image_name = uniqid().'.'.strtolower($image->getClientOriginalExtension());
                $multi_image_path = 'store-images/';
                $multi_image_url  = $multi_image_path.$multi_image_name;
                $image->move($multi_image_path, $multi_image_name);
                $data[] = $multi_image_url;  
            }
            if($store->multiple_images != null){
                $multiple_img = explode(',', $store->multiple_images);
                foreach($multiple_img as $img)
                {
                    unlink($img);
                }
            }
        }else{
            $data[]  = $store->multiple_images;
        }
        

        $store->sub_category_id         = $store->sub_category_id;
        $store->category_id             = $store->category_id;
        $store->name                    = $request->name;
        $store->name_arabic             = $request->name_arabic;
        $store->description             = $request->description;
        $store->arabic_description      = $request->arabic_description;
        $store->lat                     = $request->lat;
        $store->lan                     = $request->lan;
        $store->status                  = $request->status;
        $store->store_owner_id          = Auth::user()->id;
        $store->preview_image           = $preview_image_url;
        if($data[0] == null){
            $data_img = null;
        }else{
            $data_img = implode(',', $data);
        }
        // dd($data_img);
        $store->multiple_images         = $data_img;
        $store->location                = $request->location;
        $store->arabic_location         = $request->arabic_location;
        $store->save();

        return redirect('stores')->with('success', 'Store updated!');
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
        $store = Store::findOrFail($id);
        if($store->preview_image != null){
            unlink($store->preview_image);
        }
        if($store->multiple_images != null){
            $multiple_img = explode(',', $store->multiple_images);
            foreach($multiple_img as $img)
            {
                unlink($img);
            }
        }
        Store::destroy($id);

        return redirect('stores')->with('success', 'Store deleted!');
    }
}

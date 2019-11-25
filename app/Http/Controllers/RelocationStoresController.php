<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\RelocationStore;
use Illuminate\Http\Request;
use App\Module;
use Auth;

class RelocationStoresController extends Controller
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
            $relocationstores = RelocationStore::where('name', 'LIKE', "%$keyword%")
                ->orWhere('name_arabic', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('arabic_description', 'LIKE', "%$keyword%")
                ->orWhere('preview_image', 'LIKE', "%$keyword%")
                ->orWhere('multiple_images', 'LIKE', "%$keyword%")
                ->orWhere('lat', 'LIKE', "%$keyword%")
                ->orWhere('lng', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('store_owner_id', 'LIKE', "%$keyword%")
                ->orWhere('location', 'LIKE', "%$keyword%")
                ->orWhere('arabic_location', 'LIKE', "%$keyword%")
                ->orWhere('module_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $relocationstores = RelocationStore::latest()->paginate($perPage);
        }
        $modules = Module::pluck('name', 'id');
        return view('relocation-stores.index', compact('relocationstores', 'modules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $modules = Module::pluck('name', 'id');
        $api_key = env('GOOGLE_MAP_API_KEY');
        return view('relocation-stores.create', compact('modules', 'api_key'));
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
            $preview_image_path = 'relocation-store-images/';
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
                $multi_image_path = 'relocation-store-images/';
                $multi_image_url  = $multi_image_path.$multi_image_name;
                $image->move($multi_image_path, $multi_image_name);
                $data[] = $multi_image_url;  
            }
        }else{
            $data[]  = null;
        }

        $relocationstore                          = new RelocationStore();
        $relocationstore->module_id               = $request->module_id;
        $relocationstore->name                    = $request->name;
        $relocationstore->name_arabic             = $request->name_arabic;
        $relocationstore->description             = $request->description;
        $relocationstore->arabic_description      = $request->arabic_description;
        $relocationstore->lat                     = $request->lat;
        $relocationstore->lng                     = $request->lng;
        $relocationstore->status                  = $request->status;
        $relocationstore->store_owner_id          = Auth::user()->id;
        $relocationstore->preview_image           = $preview_image_url;
        if($data[0] == null){
            $data_img = null;
        }else{
            $data_img = implode(',', $data);
        }
        // dd($data_img);
        $relocationstore->multiple_images         = $data_img;
        $relocationstore->location                = $request->location;
        $relocationstore->arabic_location         = $request->arabic_location;
        $relocationstore->save();


        return redirect('relocation-stores')->with('success', 'RelocationStore added!');
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
        $relocationstore = RelocationStore::findOrFail($id);
        $modules = Module::pluck('name', 'id');
        return view('relocation-stores.show', compact('relocationstore', 'modules'));
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
        $relocationstore = RelocationStore::findOrFail($id);
        $modules = Module::pluck('name', 'id');
        $api_key = env('GOOGLE_MAP_API_KEY');
        return view('relocation-stores.edit', compact('relocationstore', 'modules', 'api_key'));
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
        $relocationstore = RelocationStore::findOrFail($id);
        if($request->hasFile('preview_image')){
            $preview_image      = $request->file('preview_image');
            $preview_image_name = uniqid().'.'.strtolower($preview_image->getClientOriginalExtension());
            $preview_image_path = 'relocation-store-images/';
            $preview_image_url  = $preview_image_path.$preview_image_name;
            $preview_image->move($preview_image_path,$preview_image_name);
            if($relocationstore->preview_image != null){
                unlink($relocationstore->preview_image);
            }
        }else{
            $preview_image_url  = $relocationstore->preview_image;
        }

        if($request->hasFile('multiple_images')){
            $multi_images      = $request->file('multiple_images');

            foreach($multi_images as $image)
            {
                $multi_image_name = uniqid().'.'.strtolower($image->getClientOriginalExtension());
                $multi_image_path = 'relocation-store-images/';
                $multi_image_url  = $multi_image_path.$multi_image_name;
                $image->move($multi_image_path, $multi_image_name);
                $data[] = $multi_image_url;  
            }
            if($relocationstore->multiple_images != null){
                $multiple_img = explode(',', $relocationstore->multiple_images);
                foreach($multiple_img as $img)
                {
                    unlink($img);
                }
            }
        }else{
            $data[]  = $relocationstore->multiple_images;
        }
        
        
        $relocationstore->module_id               = $request->module_id;
        $relocationstore->name                    = $request->name;
        $relocationstore->name_arabic             = $request->name_arabic;
        $relocationstore->description             = $request->description;
        $relocationstore->arabic_description      = $request->arabic_description;
        $relocationstore->lat                     = $request->lat;
        $relocationstore->lng                     = $request->lng;
        $relocationstore->status                  = $request->status;
        $relocationstore->store_owner_id          = Auth::user()->id;
        $relocationstore->preview_image           = $preview_image_url;
        if($data[0] == null){
            $data_img = null;
        }else{
            $data_img = implode(',', $data);
        }
        // dd($data_img);
        $relocationstore->multiple_images         = $data_img;
        $relocationstore->location                = $request->location;
        $relocationstore->arabic_location         = $request->arabic_location;
        $relocationstore->save();

        return redirect('relocation-stores')->with('success', 'RelocationStore updated!');
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
        $relocationstore = RelocationStore::findOrFail($id);
        if($relocationstore->preview_image != null){
            unlink($relocationstore->preview_image);
        }
        if($relocationstore->multiple_images != null){
            $multiple_img = explode(',', $relocationstore->multiple_images);
            foreach($multiple_img as $img)
            {
                unlink($img);
            }
        }
        RelocationStore::destroy($id);

        return redirect('relocation-stores')->with('success', 'RelocationStore deleted!');
    }
}

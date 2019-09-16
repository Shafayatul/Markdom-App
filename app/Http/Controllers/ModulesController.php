<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Module;
use Illuminate\Http\Request;

class ModulesController extends Controller
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
            $modules = Module::where('name', 'LIKE', "%$keyword%")
                ->orWhere('name_arabic', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $modules = Module::latest()->paginate($perPage);
        }

        return view('modules.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('modules.create');
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
            $image_path     = 'module-images/';
            $image_url      = $image_path.$image_name;
            $image->move($image_path, $image_name);
        }else{
            $image_url = null;
        }
        
        $module                 = new Module();
        $module->name           = $request->name;
        $module->name_arabic    = $request->name_arabic;
        $module->preview_image  = $image_url;
        $module->save();

        return redirect('modules')->with('success', 'Module added!');
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
        $module = Module::findOrFail($id);

        return view('modules.show', compact('module'));
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
        $module = Module::findOrFail($id);

        return view('modules.edit', compact('module'));
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
        $module                 = Module::findOrFail($id);
        if($request->hasFile('preview_image')){
            $image              = $request->file('preview_image');
            $image_name         = uniqid().'.'.strtolower($image->getClientOriginalExtension());
            $image_path         = 'module-images/';
            $image_url          = $image_path.$image_name;
            $image->move($image_path, $image_name);
            if($module->preview_image != null){
                unlink($module->preview_image);
            }
        }else{
            $image_url          = $module->preview_image;
        }
        
        $module->name           = $request->name;
        $module->name_arabic    = $request->name_arabic;
        $module->preview_image  = $image_url;
        $module->save();

        return redirect('modules')->with('success', 'Module updated!');
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
        $module = Module::findOrFail($id);
        if($module->preview_image != null){
            unlink($module->preview_image);
        }
        Module::destroy($id);

        return redirect('modules')->with('success', 'Module deleted!');
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Module;

class ModulesController extends Controller
{
    public function get_modules()
    {
    	$modules = Module::get();
    	return response()->json($modules);
    }

    public function get_module_by_module_name($module)
    {
    	$module = Module::where('name', $module)->first();
    	return response()->json($module);
    }
}

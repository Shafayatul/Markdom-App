<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\SubCategory;
use App;


class CategoriesController extends Controller
{
    public function get_categories_by_module_id($id)
    {
    	$categories = Category::where('module_id', $id)->latest()->get();
    	return response()->json($categories);
    }

    public function get_subcategories_by_category_id($id)
    {
    	$sub_categories = SubCategory::where('category_id', $id)->latest()->get();
    	return response()->json($sub_categories);
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SubSubCategory;

class SubCategoriesController extends Controller
{
    public function get_sub_sub_categories_by_sub_category_id($id)
    {
    	$sub_sub_categories = SubSubCategory::where('sub_category_id', $id)->latest()->get();
    	return response()->json($sub_sub_categories);
    }
}

<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RestaurantsController extends Controller
{
    public function index()
    {
      return view('front-end.restaurant.index');
    }

    public function subCategoryRestaurant()
    {
      return view('front-end.restaurant.sub-category-restaurant');
    }
}

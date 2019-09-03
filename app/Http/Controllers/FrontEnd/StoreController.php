<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    public function index()
    {
      return view('front-end.store.index');
    }

    public function subCategoryStore()
    {
      return view('front-end.store.sub-category-store');
    }

    public function storeDetails()
    {
      return view('front-end.store.store-details');
    }
}

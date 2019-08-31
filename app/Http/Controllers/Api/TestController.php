<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class TestController extends Controller
{
    public function index()
    {
    	$id = Auth::user()->id;
    	$string = 'Test Api.';
    	return response()->json($id);
    }
}

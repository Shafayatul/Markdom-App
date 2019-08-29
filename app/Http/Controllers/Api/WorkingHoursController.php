<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Schedule;

class WorkingHoursController extends Controller
{
    public function get_workinghours_by_store_id($id)
    {
    	$working_hours = Schedule::where('store_id', $id)->latest()->get();
    	return response()->json($working_hours);
    }
}

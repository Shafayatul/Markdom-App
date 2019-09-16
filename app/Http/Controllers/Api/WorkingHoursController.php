<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Schedule;
use Carbon\Carbon;
use App\Day;
use App\BookedSchedule;

class WorkingHoursController extends Controller
{
    public function get_workinghours_by_store_id_and_date($id, $date)
    {
    	$day = Carbon::parse($date)->format('l');
    	$day_id = Day::where('name', $day)->first()->id;
    	$schedules = Schedule::where('store_id', $id)->where('day_id', $day_id)->latest()->get();
    	$working_schedule = [];
    	foreach($schedules as $schedule){
    		$row = [];
    		$row['timespan'] = $schedule->timespan;
    		$book_schedule_count = BookedSchedule::where('schedule_id', $schedule->id)->count();

    		if($book_schedule_count == 0){
    			$row['is_booked'] = 0;
    		}else{
    			$row['is_booked'] = 1;
    		}

    		array_push($working_schedule, $row);
    	}

    	return response()->json($working_schedule);
    }


}

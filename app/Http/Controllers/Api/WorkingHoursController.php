<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Schedule;
use Carbon\Carbon;
use App\Day;
use App\BookedSchedule;
use App\ScheduleType;

class WorkingHoursController extends Controller
{
    public function get_workinghours_by_store_id_and_date($id, $date)
    {
        // $schedule_types = ScheduleType::
    	$day = Carbon::parse($date)->format('l');
    	$day_id = Day::where('name', $day)->first()->id;
    	$schedules = Schedule::where('store_id', $id)->where('day_id', $day_id)->latest()->get();
    	$working_schedule = [];
    	foreach($schedules as $schedule){
    		$row = [];
    		$row['schedule_type_id'] = $schedule->schedule_type_id;
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

    public function get_all_schedule_type_by_lang($lang)
    {
        if($lang == 'en'){
            $schedule_type = ScheduleType::pluck('name', 'id');
        }else{
            $schedule_type = ScheduleType::pluck('name_arabic', 'id');
        }
        
        return response()->json($schedule_type);
        
    }


}

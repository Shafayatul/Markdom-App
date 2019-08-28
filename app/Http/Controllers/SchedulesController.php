<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Schedule;
use App\ScheduleType;
use App\Store;
use App\Day;
use App\BookedSchedule;
use Illuminate\Http\Request;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index($id)
    {
        $perPage = 25;
        $days = Day::pluck('name', 'id');
        $stores = Store::pluck('name', 'id');
        return view('schedules.index', compact('days', 'stores', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $stores = Store::pluck('name', 'id');
        $days = Day::pluck('name', 'id');
        $scheduletypes = ScheduleType::pluck('name', 'id');
        return view('schedules.create', compact('stores', 'days', 'scheduletypes'));
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
       
       for ($i=0; $i < count($request->from_time); $i++) {
            $slot =  $request->from_time[$i].'-'.$request->to_time[$i];
            $schedule = new Schedule();
            $schedule->schedule_type_id = $request->schedule_type_id;
            $schedule->day_id = $request->day_id;
            $schedule->store_id = $request->store_id;
            $schedule->timespan = $slot;
            $schedule->save();
       }

        return redirect()->back()->with('success', 'Schedule added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($day_id, $store_id)
    {
        $schedule = Schedule::where('day_id', $day_id)->where('store_id', $store_id)->get();
        $stores = Store::pluck('name', 'id');
        $days = Day::pluck('name', 'id');
        $scheduletypes = ScheduleType::pluck('name', 'id');
        $current_day = Day::where('id', $day_id)->first();
        // dd(gettype($schedule_ids));

        return view('schedules.show', compact('store_id', 'current_day', 'schedule', 'stores', 'days', 'scheduletypes'));
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
        $schedule = Schedule::findOrFail($id);
        $timespans = explode('-', $schedule->timespan);
        $stores = Store::pluck('name', 'id');
        $days = Day::pluck('name', 'id');
        $scheduletypes = ScheduleType::pluck('name', 'id');
        return view('schedules.edit', compact('schedule', 'stores', 'days', 'scheduletypes', 'timespans'));
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
        
        $schedule = Schedule::findOrFail($id);
        $slot =  $request->from_time.'-'.$request->to_time;
        $schedule->schedule_type_id = $request->schedule_type_id;
        $schedule->day_id = $request->day_id;
        $schedule->store_id = $request->store_id;
        $schedule->timespan = $slot;
        $schedule->save();

        return redirect('schedule/'.$schedule->store_id)->with('success', 'Schedule updated!');
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
        $store_id = Schedule::where('id', $id)->first()->store_id;
        Schedule::destroy($id);

        return redirect('schedule/'.$store_id)->with('success', 'Schedule deleted!');
    }
}

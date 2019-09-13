<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\BookedSchedule;
use App\Schedule;
use App\Store;
use App\Day;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class BookedSchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->get('book_date') !== null) {
            $book_date = Carbon::parse($request->get('book_date'))->format('Y-m-d');
        }else{
            $book_date = null;
        }
        // dd($book_date);
        $store_id = $request->get('store_id');

        $perPage = 25;
        if (!empty($book_date) || !empty($store_id)) {

            $booked_schedules = BookedSchedule::whereNotNull('id');

            if($book_date){
                $booked_schedules = $booked_schedules->where('date', $book_date);
            }

            if($store_id){
                $booked_schedules = $booked_schedules->where('store_id', $store_id);
            }
            $bookedschedule_ids = $booked_schedules->pluck('schedule_id')->toArray();

            // $book_date  --find day --- day_id -- schedule table -- day_id & store_id
            $book_day = Carbon::parse($request->get('book_date'))->format('l');

            $day = Day::where('name', $book_day)->first();
            // dd($store_id);
            $schedules = Schedule::where('day_id', $day->id)->where('store_id', $store_id)->latest()->paginate($perPage);
            $stores = Store::where('store_owner_id', Auth::user()->id)->pluck('name', 'id');
            
        } else {
            $today = Carbon::today()->format('l');
            $day = Day::where('name', $today)->first();
            if(isset($day->id)){
                $schedules = Schedule::where('day_id', $day->id)->latest()->paginate($perPage);
            }else{
                $schedules = Schedule::latest()->paginate($perPage);
            }
            $bookedschedule_ids = BookedSchedule::where('date',Carbon::today()->format('Y-m-d'))->pluck('schedule_id')->toArray();
            $stores = Store::where('store_owner_id', Auth::user()->id)->pluck('name', 'id');
        }
        
        // $stores = Store::where('user_id', Auth::id())->pluck('name', 'id');

// dd($schedules);

        return view('booked-schedules.index', compact('bookedschedule_ids', 'schedules', 'stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $stores = Store::pluck('name', 'id');
        $schedules = Schedule::pluck('timespan', 'id');
        return view('booked-schedules.create', compact('stores', 'schedules'));
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
        
        $requestData = $request->all();
        
        BookedSchedule::create($requestData);

        return redirect('booked-schedules')->with('success', 'BookedSchedule added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $bookedschedule = BookedSchedule::findOrFail($id);
        $stores = Store::pluck('name', 'id');
        $schedules = Schedule::pluck('timespan', 'id');
        return view('booked-schedules.show', compact('bookedschedule', 'stores', 'schedules'));
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
        $bookedschedule = BookedSchedule::findOrFail($id);
        $stores = Store::pluck('name', 'id');
        $schedules = Schedule::pluck('timespan', 'id');
        return view('booked-schedules.edit', compact('bookedschedule', 'stores', 'schedules'));
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
        
        $requestData = $request->all();
        
        $bookedschedule = BookedSchedule::findOrFail($id);
        $bookedschedule->update($requestData);

        return redirect('booked-schedules')->with('success', 'BookedSchedule updated!');
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
        BookedSchedule::where('schedule_id', $id)->delete();

        return redirect('booked-schedules')->with('success', 'BookedSchedule deleted!');
    }
}

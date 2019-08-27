<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\BookedSchedule;
use App\Schedule;
use App\Store;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookedSchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $book_date = $request->get('book_date');
        $store_id = $request->get('store_id');
        $perPage = 25;

        if (!empty($book_date) || !empty($store_id)) {
            $schedules = BookedSchedule::whereNotNull('id');

            if($book_date){
                $schedules = $schedules->whereDate('created_at', $book_date);
            }

            if($store_id){
                $schedules = $schedules->where('store_id', $store_id);
            }
            $schedules = $schedules->latest()->paginate($perPage);
        } else {
            $today = Carbon::today()->toDateString();
            $schedules = Schedule::whereDate('created_at', $today)->latest()->paginate($perPage);
        }
        $stores = Store::pluck('name', 'id');
        $bookedschedule_ids = BookedSchedule::pluck('schedule_id')->toArray();
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

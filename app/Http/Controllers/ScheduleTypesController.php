<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ScheduleType;
use Illuminate\Http\Request;

class ScheduleTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $scheduletypes = ScheduleType::where('name', 'LIKE', "%$keyword%")
                ->orWhere('name_arabic', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $scheduletypes = ScheduleType::latest()->paginate($perPage);
        }

        return view('schedule-types.index', compact('scheduletypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('schedule-types.create');
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
        
        ScheduleType::create($requestData);

        return redirect('schedule-types')->with('success', 'ScheduleType added!');
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
        $scheduletype = ScheduleType::findOrFail($id);

        return view('schedule-types.show', compact('scheduletype'));
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
        $scheduletype = ScheduleType::findOrFail($id);

        return view('schedule-types.edit', compact('scheduletype'));
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
        
        $scheduletype = ScheduleType::findOrFail($id);
        $scheduletype->update($requestData);

        return redirect('schedule-types')->with('success', 'ScheduleType updated!');
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
        ScheduleType::destroy($id);

        return redirect('schedule-types')->with('success', 'ScheduleType deleted!');
    }
}

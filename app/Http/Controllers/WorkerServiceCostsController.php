<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\WorkerServiceCost;
use Illuminate\Http\Request;

class WorkerServiceCostsController extends Controller
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
            $workerservicecosts = WorkerServiceCost::where('name', 'LIKE', "%$keyword%")
                ->orWhere('name_arabic', 'LIKE', "%$keyword%")
                ->orWhere('price', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $workerservicecosts = WorkerServiceCost::latest()->paginate($perPage);
        }

        return view('worker-service-costs.index', compact('workerservicecosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($product_id)
    {
        return view('worker-service-costs.create', compact('product_id'));
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
        
        WorkerServiceCost::create($requestData);

        return redirect('worker-service-costs')->with('success', 'WorkerServiceCost added!');
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
        $workerservicecost = WorkerServiceCost::findOrFail($id);

        return view('worker-service-costs.show', compact('workerservicecost'));
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
        $workerservicecost = WorkerServiceCost::findOrFail($id);

        return view('worker-service-costs.edit', compact('workerservicecost'));
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
        
        $workerservicecost = WorkerServiceCost::findOrFail($id);
        $workerservicecost->update($requestData);

        return redirect('worker-service-costs')->with('success', 'WorkerServiceCost updated!');
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
        WorkerServiceCost::destroy($id);

        return redirect('worker-service-costs')->with('success', 'WorkerServiceCost deleted!');
    }
}

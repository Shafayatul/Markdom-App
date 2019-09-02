<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkerController extends Controller
{
    public function index()
    {
      return view('front-end.workers.index');
    }

    public function subCategoryWorker()
    {
      return view('front-end.workers.sub-category-worker');
    }

    public function workerDetails()
    {
      return view('front-end.workers.worker-details');
    }

    public function subSubCategoryWorker()
    {
      return view('front-end.workers.sub-sub-category-worker');
    }

    public function workerServiceDelivery()
    {
      return view('front-end.workers.worker-service-delivery');
    }
}

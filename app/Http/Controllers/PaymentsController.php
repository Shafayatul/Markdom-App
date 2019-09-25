<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function payment_method_view()
    {
    	return view('front-end.payments.payment-method');
    }
}

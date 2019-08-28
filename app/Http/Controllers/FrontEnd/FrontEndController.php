<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontEndController extends Controller
{
    public function index()
    {
      return view('front-end.home');
    }

    public function userLogin()
    {
      return view('front-end.auth-user.user-login');
    }

    public function userSignup()
    {
      return view('front-end.auth-user.user-signup');
    }
}

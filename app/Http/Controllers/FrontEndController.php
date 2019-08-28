<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

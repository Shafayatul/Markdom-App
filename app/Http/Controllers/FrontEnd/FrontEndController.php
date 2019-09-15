<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontEndController extends Controller
{

    public function index()
    {
      $url        = env('MAIN_HOST_URL').'api/get-modules';
      $method     = 'GET';
      $models     = $this->callApi($method, $url);

      return view('front-end.home', compact('models'));
    }

    public function userLogin()
    {
      return view('front-end.auth-user.user-login');
    }

    public function userSignup()
    {
      return view('front-end.auth-user.user-signup');
    }

    public function chat()
    {
      return view('front-end.chat.chat');
    }
}

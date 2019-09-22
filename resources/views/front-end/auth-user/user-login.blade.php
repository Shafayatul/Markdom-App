@extends('layouts.front-end.master-layout')
@section('front-additional-css')

@endsection
@section('main-content')
  <div id="page-wrapper" class="sign-in-wrapper">
  <div class="graphs">
    <div class="sign-in-form">
      <div class="sign-in-form-top">
        <h1>Log in</h1>
      </div>
      <div class="signin">
        <div class="signin-rit">
          {{-- <span class="checkbox1">
             <label class="checkbox"><input type="checkbox" name="checkbox" checked="">Forgot Password ?</label>
          </span> --}}
          <p><a href="#">Forgot Password</a> </p>
          <div class="clearfix"> </div>
        </div>
        <form action="{{ url('/user-login') }}" method="post">
          @csrf
        <div class="log-input">
          <div class="log-input-left">
             <input type="text" class="user email" name="email" value="" placeholder="Your Email"/>
          </div>
          {{-- <span class="checkbox2">
             <label class="checkbox"><i class="fa fa-check email-i"></i></label>
          </span> --}}
          <div class="clearfix"> </div>
        </div>
        <div class="log-input">
          <div class="log-input-left">
             <input type="password" class="lock" name="password" value="" placeholder="********"/>
          </div>
          {{-- <span class="checkbox2">
             <label class="checkbox"><i class="fa fa-check password-i"></i></label>
          </span> --}}
          <div class="clearfix"> </div>
        </div>
        <input type="submit" value="Log in">
      </form>
      </div>
      <div class="new_people">
        <h2>For New People</h2>
        <p>Please click on Register Now button for new Sign Up</p>
        <a href="{{ route('user-signup') }}">Register Now!</a>
      </div>
    </div>
  </div>
</div>
@endsection

@section('front-additional-js')

@endsection

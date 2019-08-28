@extends('layouts.front-end.master-layout')
@section('front-additional-css')

@endsection
@section('main-content')
  <div id="page-wrapper" class="sign-in-wrapper">
    <div class="graphs">
      <div class="sign-up">
        <h1>Create an account</h1>
        <p class="creating">Having hands on experience in creating innovative designs,I do offer design
          solutions which harness.</p>
        <h2>Personal Information</h2>
        <div class="sign-u">
          <div class="sign-up1">
            <h4>Email Address* :</h4>
          </div>
          <div class="sign-up2">
            <form>
              <input type="text" placeholder=" " required=" "/>
            </form>
          </div>
          <div class="clearfix"> </div>
        </div>
        <div class="sign-u">
          <div class="sign-up1">
            <h4>Password* :</h4>
          </div>
          <div class="sign-up2">
            <form>
              <input type="password" placeholder=" " required=" "/>
            </form>
          </div>
          <div class="clearfix"> </div>
        </div>
        <div class="sign-u">
          <div class="sign-up1">
            <h4>Confirm Password* :</h4>
          </div>
          <div class="sign-up2">
            <form>
              <input type="password" placeholder=" " required=" "/>
            </form>
          </div>
          <div class="clearfix"> </div>
        </div>
        <div class="sub_home">
          <div class="sub_home_left">
            <form>
              <input type="submit" value="Create">
            </form>
          </div>
          <div class="sub_home_right">
            <p>Go Back to <a href="{{ url('/') }}">Home</a></p>
          </div>
          <div class="clearfix"> </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('front-additional-js')

@endsection

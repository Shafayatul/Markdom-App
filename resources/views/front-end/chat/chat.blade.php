@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/chat.css') }}">
@endsection

@section('main-content')
<div class="chat text-center">
  <div class="container">
    <div class="chat-div">
      <div class="chat-box">
        <div class="msg-user">
          <p>Hi Admin</p>
        </div>
        <div class="msg-admin">
          <p>Hi User</p>
        </div>
        <div class="msg-user">
          <p>Hi Admin</p>
        </div>
        <div class="msg-admin">
          <p>Hi User</p>
        </div>
        <div class="msg-user">
          <p>Hi Admin</p>
        </div>
        <div class="msg-admin">
          <p>Hi User</p>
        </div>
      </div>
      <div class="chat-input">
        <div class="add-icon"><i class="fa fa-plus-circle"></i></div>
        <div class="input-field"> <input type="text"> </div>
        <div class="send-button"> <button class="btn btn-success">Send</button> </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('front-additional-js')
<script type="text/javascript">

</script>
@endsection

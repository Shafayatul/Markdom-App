@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/chat.css') }}">
@endsection

@section('main-content')

<div class="header" id="Header">
  <h4>Live Chat window</h4>
  <i class="fa fa-chevron-left " aria-hidden="true"></i>
  <p><span class="wait">waiting for offer</span> |Unique Code#<span id="restaurant-costomer-order">--</span> </p>
</div>
<div class="messaging">
  
  <div class="container">
  <div class="inbox_msg">
    <div class="mesgs">
      <div class="msg_history">
        {{-- <div c4lass="incoming_msg">
          <div class="incoming_msg_img"> <img src="{{ asset('front-end-assets/images/user-profile.png') }}" alt="sunil"> </div>
          <div class="received_msg">
            <div class="received_withd_msg">
              <p>hello</p>
              <span class="time_date"> 11:01 AM    |    June 9</span></div>
          </div>
        </div>
        <div class="outgoing_msg">
          <div class="sent_msg">
            <p>hi</p>
            <span class="time_date"> 11:01 AM    |    June 9</span> </div>
        </div> --}}
      </div>
      <div class="type_msg">
        <div class="input_msg_write">
          <input type="text" class="write_msg" placeholder="Type a message" />
          <button class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
  </div>
  </div>
   {{-- <a class="trigger_popup_fricc">Click here to show the popup</a> --}}


  </div>
  
 <input type="hidden" id="live-chat-window" value="yes">
 <input type="hidden" id="message_uid" value="{{ $message_uid }}">

@endsection

@section('front-additional-js')
<script>

</script>
<script type="text/javascript">
  // jQuery Document
  $(document).ready(function(){
    //If user wants to end session
    $("#exit").click(function(){
      var exit = confirm("Are you sure you want to end the session?");
      if(exit==true){window.location = 'index.php?logout=true';}    
    });
  });
  $(window).load(function () {
      $(".trigger_popup_fricc").click(function(){
         $('.hover_bkgr_fricc').show();
      });
      $('.hover_bkgr_fricc').click(function(){
          $('.hover_bkgr_fricc').hide();
      });
      $('.button').click(function(){
          $('.hover_bkgr_fricc').hide();
      });
  });
</script>
@endsection

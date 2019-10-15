@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/chat.css') }}">
@endsection

@section('main-content')

<div class="header" id="Header">
  <h4>karamcafe</h4>
  <i class="fa fa-chevron-left " aria-hidden="true"></i>
  <p><span class="wait">waiting for offer</span> |#222222 </p>
</div>
<div class="messaging">
  
  <div class="container">
  <div class="inbox_msg">
    <div class="mesgs">
      <div class="msg_history">
        <div c4lass="incoming_msg">
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
        </div>
        <div class="incoming_msg">
          <div class="incoming_msg_img"> <img src="{{ asset('front-end-assets/images/user-profile.png') }}" alt="sunil"> </div>
          <div class="received_msg">
            <div class="received_withd_msg">
              <p>ho</p>
              <span class="time_date"> 11:01 AM    |    Yesterday</span></div>
          </div>
        </div>
        <div class="outgoing_msg">
          <div class="sent_msg">
            <p>hi</p>
            <span class="time_date"> 11:01 AM    |    Today</span> </div>
        </div>
        <div class="incoming_msg">
          <div class="incoming_msg_img"> <img src="{{ asset('front-end-assets/images/user-profile.png') }}" alt="sunil"> </div>
          <div class="received_msg">
            <div class="received_withd_msg">
              <p>We </p>
              <span class="time_date"> 11:01 AM    |    Today</span></div>
          </div>
        </div>
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
   <a class="trigger_popup_fricc">Click here to show the popup</a>

  <div class="hover_bkgr_fricc">
  <div class="container">       
    <span class="helper"></span>
    <div>  
      <div class="user-profile">
        <div class="offer-list">
          <div class="sent"> 
            <h4>Sent Offers</h4>
          </div>
          <span>11 Offers <strong class="one">1</strong></span>
        </div> 
        <div class="profile">           
          <img class="avatar" src="{{ asset('front-end-assets/images/user-profile.png') }}" alt="Ash" />               
          <div class="description">
            <h4 class="username">Name</h4> 
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
          </div>  
        </div> 

        <ul class="data">
          <li>
            <span> 2.7km</span>
          </li>
          <li>
            <span>11.01 SAR</span>
          </li>
          <li>
            <span>1 hour</span>
          </li>
          </ul> 
          <form class="button-gruop">
            <input class="button " type="button" value="Cancel Order" name="">
            <input class="button " type="button" value="Accept offer" name="">
          </form>
          
      </div>

   </div> 
          
           
          
    </div>
  </div>  
  </div>
  
 

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

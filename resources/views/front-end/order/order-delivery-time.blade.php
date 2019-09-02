@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/order-delivery-time.css') }}">
@endsection

@section('main-content')
<div class="order text-center">
  <div class="container">
    <div class="order-title">
      <h1>When you need the service</h1>
    </div>
    <div class="month-year" id="month-year">
      <span class="month-span" id="month-span">

      </span><span class="comma">,</span>
      <span class="year-span" id="year-span">

      </span>
    </div>
    <div class="sliding-category">
      <div class="slider-area slider" id="slider-area">
        @for($i=1; $i<35; $i++)
          <div class="sliding-div" id=sliding-div>
            <div class="day-name" id="day-name-{{$i}}"></div>
            <div class="day-number" id="day-number-{{$i}}"></div>
          </div>
        @endfor
      </div>
    </div>

    <div class="morning-div">
      <div class="morning-slider-area slider" id="morning-slider-area">
        vdfvdv
      </div>
      <div class="morning-slider-area slider" id="morning-slider-area">
        fvdfvdfvdfv
      </div>
      <div class="morning-slider-area slider" id="morning-slider-area">
        fvdfvdfvdfv
      </div>
      <div class="morning-slider-area slider" id="morning-slider-area">
        vdfvdv
      </div>
      <div class="morning-slider-area slider" id="morning-slider-area">
        fvdfvdfvdfv
      </div>
      <div class="morning-slider-area slider" id="morning-slider-area">
        fvdfvdfvdfv
      </div>
      <div class="morning-slider-area slider" id="morning-slider-area">
        vdfvdv
      </div>
      <div class="morning-slider-area slider" id="morning-slider-area">
        fvdfvdfvdfv
      </div>
      <div class="morning-slider-area slider" id="morning-slider-area">
        fvdfvdfvdfv
      </div>
    </div>
  </div>
</div>
@endsection

@section('front-additional-js')
<script type="text/javascript">

  $(".slider-area").slick({
      dots: false,
      infinite: true,
      slidesToShow: 7,
      slidesToScroll: 7
  });
  $(".morning-div").slick({
      dots: false,
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 1
  });

  var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  var days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
  var count = 1;
  for(var i=0; i< 35; i++){
    var myDate = new Date();

    myDate.setDate(myDate.getDate() + i);

    if (i == 0) {
      $("#year-span").html( myDate.getFullYear());
      $("#month-span").html( months[myDate.getMonth()]);
    }

    $("#day-name-"+count).html(days[myDate.getDay()]);
    $("#day-number-"+count).html(myDate.getDate());

    var curMonth = myDate.getMonth()+1;

    if (curMonth<10) {
      curMonth = '0'+curMonth;
    }

    var curMonth = myDate.getMonth()+1;
    if (curMonth<10) {
      curMonth = '0'+curMonth;
    }

    var currDate = myDate.getDate();
    if (currDate<10) {
      currDate = '0'+currDate;
    }

    $("#day-number-"+count).attr("current-date", myDate.getFullYear()+'-'+curMonth+'-'+currDate);
    $("#day-number-"+count).attr("month", months[myDate.getMonth()]);
    $("#day-number-"+count).attr("year", myDate.getFullYear());

    count++;

    // console.log('Year: '+myDate.getFullYear()+' Month: '+months[myDate.getMonth()]+' Date: '+myDate.getDate()+' Day: '+days[myDate.getDay()]);
  }

  $(document).on('click', '.day-number', function(){
    $('.day-number').css('background-color', '#ffffff');
    $('.day-number').css('color', '#000000');
    var curMonth = $(this).attr('month');
    var curYear = $(this).attr('year');
    $(this).css('background-color', '#2ecc71');
    $(this).css('color', '#ffffff');
    $("#year-span").html( curYear);
    $("#month-span").html( curMonth);

  });

</script>
@endsection

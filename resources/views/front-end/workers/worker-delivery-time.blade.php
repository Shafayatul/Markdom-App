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
        @php
          $date = Carbon\Carbon::now()->addDay($i-1)->format('Y-m-d');
        @endphp
        <a href="{{ url('/worker-service-time/'.$id.'/'.$date) }}">
          <div class="sliding-div" id=sliding-div>
            <div class="day-name" id="day-name-{{$i}}"></div>
            <div class="day-number @if($date == $current_date) selected_date @endif" id="day-number-{{$i}}"></div>
          </div>
        </a>
        @endfor
      </div>
    </div>

    @foreach($schedules as $key=>$value)
    <div class="morning-div">
      <div class="morning-timing-title-box text-left">
        <span class="icon"><i class="fa fa-check"></i></span>
        <span class="morning-title">
          <h2>
            {{ $value }}
          </h2>
        </span>
      </div>
      <div class="morning-time-schedule-box">
        @foreach($slot as $item)
          @if($item->schedule_type_id == $key)
          <div class="morning-slider-area slider" id="morning-slider-area">
            @if($item->is_booked == 1)
              <span class="@if($item->is_booked == 1) selected_date @endif">{{ $item->timespan }}</span>
            @else
              <a href="{{ route('worker-place-holder') }}"><span>{{ $item->timespan }}</span></a>
            @endif
          </div>
          @endif
        @endforeach
        {{-- <div class="morning-slider-area slider" id="morning-slider-area">
          <span>10:00 - 11:00</span>
        </div>
        <div class="morning-slider-area slider" id="morning-slider-area">
          <span>11:00 - 12:00</span>
        </div>
        <div class="morning-slider-area slider" id="morning-slider-area">
          <span>12:00 - 13:00</span>
        </div> --}}
      </div>
    </div>
    @endforeach
    {{-- <div class="afternoon-div">
      <div class="afternoon-timing-title-box text-left">
        <span class="icon"><i class="fa fa-check"></i></span>
        <span class="afternoon-title"><h2>Afternoon</h2></span>
      </div>
      <div class="afternoon-time-schedule-box">
        <div class="afternoon-slider-area slider" id="afternoon-slider-area">
          <span>13:00 - 14:00</span>
        </div>
        <div class="afternoon-slider-area slider" id="afternoon-slider-area">
          <span>14:00 - 15:00</span>
        </div>
        <div class="afternoon-slider-area slider" id="afternoon-slider-area">
          <span>15:00 - 16:00</span>
        </div>
        <div class="afternoon-slider-area slider" id="afternoon-slider-area">
          <span>16:00 - 17:00</span>
        </div>
      </div>
    </div>

    <div class="evening-div">
      <div class="evening-timing-title-box text-left">
        <span class="icon"><i class="fa fa-check"></i></span>
        <span class="evening-title"><h2>Evening</h2></span>
      </div>
      <div class="evening-time-schedule-box">
        <div class="evening-slider-area slider" id="evening-slider-area">
          <span>17:00 - 18:00</span>
        </div>
        <div class="evening-slider-area slider" id="evening-slider-area">
          <span>18:00 - 19:00</span>
        </div>
        <div class="evening-slider-area slider" id="evening-slider-area">
          <span>19:00 - 20:00</span>
        </div>
        <div class="evening-slider-area slider" id="evening-slider-area">
          <span>20:00 - 21:00</span>
        </div>
      </div>
    </div> --}}

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
  $(".morning-time-schedule-box").slick({
      dots: false,
      infinite: true,
      slidesToShow: 4,
      slidesToScroll: 1
  });
  $(".afternoon-time-schedule-box").slick({
      dots: false,
      infinite: true,
      slidesToShow: 4,
      slidesToScroll: 1
  });
  $(".evening-time-schedule-box").slick({
      dots: false,
      infinite: true,
      slidesToShow: 4,
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

  // $(document).on('click', '.day-number', function(){
  //   $('.day-number').css('background-color', '#ffffff');
  //   $('.day-number').css('color', '#000000');
  //   var curMonth = $(this).attr('month');
  //   var curYear = $(this).attr('year');
  //   $(this).css('background-color', '#2ecc71');
  //   $(this).css('color', '#ffffff');
  //   $("#year-span").html( curYear);
  //   $("#month-span").html( curMonth);

  // });

</script>
@endsection

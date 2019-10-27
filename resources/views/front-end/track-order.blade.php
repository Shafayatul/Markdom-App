@extends('layouts.front-end.master-layout')
@section('front-additional-css')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('front-end-assets/custom-css/track-order.css') }}">
@endsection

@section('main-content')
<div class="store text-center">
  <div class="container">
    <div class="wrapper">
      <div class="product-details-div shadow">
          <div class="row">
              <div class="col text-center">
                  <div class="section_title new_arrivals_title">
                      <h2>Track Your Order Here</h2>
                  </div>
              </div>
          </div>

          <div class="track-order-box">
            <div class="upper-content">
              <div class="gift-box">
                <img src="{{ asset('front-end-assets/images/gift-box.png') }}" alt="">
              </div>
              <div class="order-heading">
                <h3>Order Status</h3>
              </div>
              <div class="order-content">
                <p>Order No: {{ $order_details->order->id }}</p>
                <p>Order placed : {{ $order_details->order->created_at }}</p>
              </div>
            </div>
            <div class="middle-content">
              <div class="order-status">
                <ol class="progtrckr" data-progtrckr-steps="4">
                  @if ($order_details->order->order_status_id == 1)
                    <li class="progtrckr-done">Pending</li>
                    <li class="progtrckr-done">On Delivery</li>
                    <li class="progtrckr-done">With SMSA</li>
                    <li class="progtrckr-done">Complete</li>
                  @elseif ($order_details->order->order_status_id == 2)
                    <li class="progtrckr-done">Pending</li>
                    <li class="progtrckr-done">On Delivery</li>
                    <li class="progtrckr-done">With SMSA</li>
                    <li class="progtrckr-done">Complete</li>
                  @elseif ($order_details->order->order_status_id == 3)
                    <li class="progtrckr-done">Pending</li>
                    <li class="progtrckr-done">On Delivery</li>
                    <li class="progtrckr-done">With SMSA</li>
                    <li class="progtrckr-done">Complete</li>
                  @elseif ($order_details->order->order_status_id == 4)
                    <p class="text-danger">{{ 'Sorry The Order Has canceled' }}</p>
                  @elseif ($order_details->order->order_status_id == 5)
                    <li class="progtrckr-done">Pending</li>
                    <li class="progtrckr-done">On Delivery</li>
                    <li class="progtrckr-done">With SMSA</li>
                    <li class="progtrckr-done">Complete</li>
                  @else
                    <p class="text-danger">{{ 'No Data Found' }}</p>
                  @endif
                </ol>
              </div>
            </div>
            <div class="lower-content">
                <div class="activity text-center">
                  <div class="heading">
                    <p>Activity</p>
                    <hr>
                  </div>
                  <p>
                    @if ($order_details->order->order_status_id == 1)
                      {{ 'Completed' }}
                    @elseif ($order_details->order->order_status_id == 2)
                      {{ 'Pending' }}
                    @elseif ($order_details->order->order_status_id == 3)
                      {{ 'On Delivery' }}
                    @elseif ($order_details->order->order_status_id == 4)
                      {{ "Cancelled" }}
                    @elseif ($order_details->order->order_status_id == 5)
                      {{ "With SMSA" }}
                    @else
                      {{ "----" }}
                    @endif
                  </p>
                </div>
            </div>
          </div>

      </div>
    </div> 
  </div>
</div>
@endsection

@section('front-additional-js')
<script>
  $(document).ready(function () {

    var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-success').addClass('btn-default');
            $item.addClass('btn-success');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function () {
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url']"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for (var i = 0; i < curInputs.length; i++) {
            if (!curInputs[i].validity.valid) {
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-success').trigger('click');
});
  </script>
@endsection

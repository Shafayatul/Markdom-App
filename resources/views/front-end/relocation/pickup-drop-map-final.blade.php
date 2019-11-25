@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/relocation-store-list.css') }}">
@endsection
@section('main-content')
<div class="restaurant">
  <div class="container">
    <div class="col-md-12">
      <h4>Place Order Data</h4>
      <form action="{{ route('relocation-place-order') }}" method="POST">
        @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <select name="cart_type" id="cart_type" class="form-control car-type" required="">
                <option value="">---Select Car Types---</option>
                @foreach($cartypes as $cartype)
                  @if(app()->getLocale() == 'en')
                    <option value="{{ $cartype->id }}">{{ $cartype->name }}</option>
                  @else
                    <option value="{{ $cartype->id }}">{{ $cartype->name_arabic }}</option>
                  @endif
                @endforeach
              </select>
            </div>
          </div>

          <input type="hidden" name="store_id" id="store_id">
          <input type="hidden" name="lat1" id="lat1">
          <input type="hidden" name="lng1" id="lng1">
          <input type="hidden" name="lat2" id="lat2">
          <input type="hidden" name="lng2" id="lng2">

          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="price" id="price" class="form-control" readonly required>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="form-group">
            <button type="submit" class="btn btn-block btn-success">Place Order</button>
          </div>
        </div>
      </form>
      
    </div>
  </div>
</div>
@endsection

@section('front-additional-js')
<script type="text/javascript">
  var store_id = window.localStorage.getItem('store_id');
  var lat1 = window.localStorage.getItem('lat1');
  var lng1 = window.localStorage.getItem('lng1');
  var lat2 = window.localStorage.getItem('lat2');
  var lng2 = window.localStorage.getItem('lng2');

  $("#store_id").val(store_id);
  $("#lat1").val(lat1);
  $("#lng1").val(lng1);
  $("#lat2").val(lat2);
  $("#lng2").val(lng2);


  $(document).on('change','.car-type', function(){
    var type = this.value;
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type:'POST',
      url: '{{route('ajax-get-price')}}',
      data:{
        lat1 : lat1,
        lng1 : lng1,
        lat2 : lat2,
        lng2 : lng2,
        store_id : store_id,
        cartype : type
      },
      success:function(result){
          if(result.msg == 'Success'){
            var price = parseInt(result.price);
            $("#price").val(price);
          }
        }
    });
  });
</script>

@endsection

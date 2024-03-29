@extends('layouts.app')
@section('title')
Store Orders
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Store Orders</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Store Orders
                </div>
                <div class="panel-body">
                    
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Total Price</th>
                                    <th>Image</th>
                                    <th>Delivery Time</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($storeorders as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->final_price }}</td>
                                    <td>
                                        @if(isset($item->image))
                                            <img src="{{ asset($item->image) }}" alt="" style="width: 80px; height: 80px;">
                                        @endif
                                    </td>
                                    <td>{{ $item->estimated_time }}</td>
                                    <td>
                                        @if(isset($orderstatus[$item->order_status_id]))
                                            {{ $orderstatus[$item->order_status_id] }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/store-order/' . $item->id) }}" title="View Order"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>

                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#order_status_{{ $item->id }}"><i class="fa fa-edit"></i> Status</button>


                                        <div id="order_status_{{ $item->id }}" class="modal fade" role="dialog">
                                          <div class="modal-dialog">

                                            <!-- Modal content-->
                                             <div class="modal-content">
                                                <form action="{{route('store-order-status-change')}}" method="post" class="form-horizontal" name="order-status-form" id="order-form-{{$item->id}}">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Status</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="order-status" class="control-label col-md-3">Order Status</label>
                                                            <div class="col-md-9">
                                                                <select name="order_status_id" order_id="{{$item->id}}" id="current-order-status-{{$item->id}}" class="form-control" required >
                                                                    <option value="" >Select Order Status</option>
                                                                    @foreach($orderstatus as $key => $value)
                                                                        <option value="{{$key}}">{{$value}}</option>
                                                                    @endforeach
                                                                    <input type="hidden" name="order_id" value="{{$item->id}}">
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success save-status-change" order-id="{{$item->id}}" user-id="{{ $item->user_id}}">Save</button>
                                    
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>

                                            </div> 
                                        </div>
                                        <a class="btn btn-success btn-sm" href="{{url('/add-shipment-to-smsa/'.$item->id.'/'.$item->user_id.'/'.$item->address_id)}}">SMSA</a>
                                        @if(($item->smsa_awab_number != '') || ($item->smsa_awab_number != null))
                                          <a class="btn btn-success btn-sm" href="http://track.smsaexpress.com/getPDF2.aspx?awbNo={{$item->smsa_awab_number}}" target="_blank">SMSA PDF</a>
                                        @endif
                                        <a href="{{ url('/review/' . $item->user_id) }}" title="Add Review"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Add Review</button></a>
                                        {{-- {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/store-order-delete', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Delete Order',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            )) !!}
                                        {!! Form::close() !!} --}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $storeorders->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer-script')
  <script>
    $(document).ready(function(){        
      $('.save-status-change').click(function(){
        var user_id       = $(this).attr('user-id');
        var order_id      = $(this).attr('order-id');
        var notification  = 'Order status changed to ' + $('#current-order-status-'+order_id+' option:selected').text();
        $("#order-form-"+order_id).submit();
      });

      $('.smsa-add-to-ship').click(function(){
        var url =  $(this).attr('target-link');
        $.ajax({
          type: "GET",
          url: url,
          success:function(data){
            // alert(data.msg);
            // alert(data.awbNumber);
            location.reload();
          }
        });
      });

    });
  </script>
@endsection
@extends('layouts.app')
@section('title')
Create New Order
@endsection
@section('header-script')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <style type="text/css">
        .removeBtn{
            margin-top: 25px;
        }
    </style>
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Order</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Create New Order
                </div>
                <div class="panel-body">
                   <a href="{{ url('/orders') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br />
                    <br />

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::open(['url' => '/orders', 'files' => true]) !!}

                    @include ('orders.form', ['formMode' => 'create'])

                    {!! Form::close() !!} 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script type="text/javascript">
    $('.product').select2({});


    $(document).ready(function(){
        $("#store_id").change(function(){
            var store_id = $("#store_id").val();
            if(store_id){

                $.ajax({
                    type:"GET",
                    url:"{{url('get-products-list')}}?store_id="+store_id,
                    success:function(res){
                        if(res){
                            $(".product").empty();
                            $(".product").append('<option>Select Product</option>');
                            $.each(res,function(key,value){
                                $(".product").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                        $(".product").empty();
                        }
                    }
                });
            }else{
                $(".product").empty();
            }
        });
    });
</script>
@endsection
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
        <div class="col-md-12">

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
    var rowCount = 1;
    function addMore(frm){
        

        rowCount++;
        html = '<div id="product-section'+rowCount+'"><div class="row"><div class="col-md-3"><div class="form-group"><label class="control-label">Product</label><select id="product_'+rowCount+'" name="product_id[]" class="form-control product" serial="'+rowCount+'"></select></div></div><div class="col-md-2"><div class="form-group"><label class="control-label">Price</label><input type="text" name="price[]" class="form-control price" id="price_'+rowCount+'" serial="'+rowCount+'" readonly></div></div><div class="col-md-2"><div class="form-group"><label class="control-label">Qty</label><input type="number" name="qty[]" class="form-control qty" id="qty_'+rowCount+'" serial="'+rowCount+'"></div></div><div class="col-md-2"><div class="form-group"><label class="control-label">Total Price</label><input type="text" name="total_price[]" class="form-control total_price" id="total_price_'+rowCount+'" serial="'+rowCount+'" readonly></div></div><div class="col-md-3"><div class="form-group"><button class="btn btn-sm btn-danger removeBtn" serial="'+rowCount+'"><i class="fa fa-trash"></i></button></div></div></div></div>';
        $("#itemRows").append(html);

        var selectedStore = $('#store_id :selected').val();
        if(selectedStore){

            $.ajax({
                type:"GET",
                url:"{{url('get-products-list')}}?store_id="+selectedStore,
                success:function(res){
                    if(res){
                        $("#product_"+rowCount).empty();
                        $("#product_"+rowCount).append('<option>Select Product</option>');
                        $.each(res,function(key,value){
                            $("#product_"+rowCount).append('<option value="'+key+'">'+value+'</option>');
                        });

                    }else{
                    $("#product_"+rowCount).empty();
                    }
                }
            });
        }else{
            $("#product_"+rowCount).empty();
        }
    }

    $(document).ready(function(){
        $("#store_id").change(function(){
            var store_id = $("#store_id").val();
            if(store_id != ''){

                $.ajax({
                    type:"GET",
                    url:"{{url('get-products-list')}}?store_id="+store_id,
                    success:function(res){
                        if(res){
                            $(".product").empty();
                            $(".price").val('');
                            $(".qty").val('');
                            $(".total_price").val('');
                            $(".product").append('<option>Select Product</option>');
                            $.each(res,function(key,value){
                                $(".product").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                            $(".product").empty();
                            $(".price").val('');
                            $(".qty").val('');
                            $(".total_price").val('');
                        }
                    }
                });
            }else{
                $(".product").empty();
                $(".price").val('');
                $(".qty").val('');
                $(".total_price").val('');
            }
        });
    });
    $(document).on('change', ".product", function(){
        var product_id = $(this).val();
        var serial = $(this).attr('serial');
        if(product_id){

            $.ajax({
                type:"GET",
                url:"{{url('get-product-data')}}?product_id="+product_id,
                success:function(res){
                    console.log(res);
                    if(res){
                        $("#price_"+serial).val(res.price);
                    }else{
                        $("#price_"+serial).empty();
                    }
                }
            });
        }else{
            $("#price_"+serial).empty();
        }
    });

    $(document).on('keyup', ".qty", function(){
        var serial = $(this).attr('serial');
        total_price(serial);
        sub_total_price();
    });

    function total_price(serial){
        var qty = $("#qty_"+serial).val();
        var price = $("#price_"+serial).val();
        var total_price = parseInt(price)*parseInt(qty);
        $("#total_price_"+serial).val(total_price);
    }

    $(document).on('click', ".removeBtn", function(){
        var serial = $(this).attr('serial');
        $('#product-section'+serial).remove();
        sub_total_price();
        grand_total_price();
    });

    $(document).on('keyup', "#promo_code", function(){
        var code = $(this).val();
       check_promo_code(code);
    });

    function check_promo_code(code){
        if(code){

            $.ajax({
                type:"GET",
                url:"{{url('get-discount-data')}}?code="+code,
                success:function(res){
                    console.log(res);
                    if(res){
                        if(res.msg == 'Found'){
                            if(res.code.type == 'Percent'){
                                var sub_total_price = $("#sub_total_price").val();
                                var percent = res.code.percent;
                                var percent_result = parseInt(percent)/100;
                                var final_discount = sub_total_price*percent_result;
                                $("#discount").val(final_discount);
                                grand_total_price();
                            }else{
                                var sub_total_price = $("#sub_total_price").val();
                                var amount = res.code.amount;
                                $("#discount").val(amount);
                                grand_total_price();
                            }  
                        }else if(res.msg == 'Not Found'){
                            alert(res.msg);
                            $("#discount").val('');
                            sub_total_price();
                            grand_total_price();
                        }else{
                            alert(res.msg);
                            $("#discount").val('');
                            sub_total_price();
                            grand_total_price();
                        }
                        
                    }else{
                        $("#discount").val('');
                        sub_total_price();
                        grand_total_price();
                    }
                }
            });
        }else{
            $("#discount").val('');
            sub_total_price();
            grand_total_price();
        }
    }


    function grand_total_price(){
        var sub_total_price = $("#sub_total_price").val();
        var discount = $("#discount").val();
        var grand_total_price = sub_total_price-discount;
        $("#grand_total_price").val(grand_total_price);
    }

    function sub_total_price(){
        var price = 0;
        $(".total_price").each(function(){
            if(!isNaN($(this).val())){
               price += parseInt($(this).val()); 
            }
            
        });
        $("#sub_total_price").val(price);
        $("#grand_total_price").val(price);
    }
    
</script>
@endsection
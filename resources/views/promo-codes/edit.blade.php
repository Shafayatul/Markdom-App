@extends('layouts.app')
@section('title')
Edit Promo Codes #{{$promocode->id}}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Promo Codes</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-default">
                <div class="panel-heading">
                  Edit Promo Codes #{{$promocode->id}}
                </div>
                <div class="panel-body">
                    <a href="{{ url('/promo-codes') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br />
                    <br />

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::model($promocode, [
                        'method' => 'PATCH',
                        'url' => ['/promo-codes', $promocode->id],
                        'files' => true
                    ]) !!}

                    @include ('promo-codes.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer-script')
<script>
    $(document).ready(function(){
        var promo_code_select = document.getElementById("promo_code_select");
        var select_promo_code_value= promo_code_select.options[promo_code_select.selectedIndex].value;
                if(select_promo_code_value == "Percent"){
                    $("#percentage").show(500);
                    $("#amount").hide(500);
                }else if(select_promo_code_value == "Amount"){
                    $("#amount").show(500);
                    $("#percentage").hide(500);
                }

            $(promo_code_select).change(function(){
                var select_promo_code_value= promo_code_select.options[promo_code_select.selectedIndex].value;
                if(select_promo_code_value == "Percent"){
                    $("#percentage").show(500);
                    $("#amount").hide(500);
                }else if(select_promo_code_value == "Amount"){
                    $("#amount").show(500);
                    $("#percentage").hide(500);
                }
            })
    });



</script>
@endsection

@extends('layouts.app')
@section('title')
Create New Promo Codes
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
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Create New Promo Codes
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

                    {!! Form::open(['url' => '/promo-codes', 'files' => true]) !!}

                    @include ('promo-codes.form', ['formMode' => 'create'])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer-script')
<script type="text/javascript">
    document.getElementById("amount").style.display="none";
    var promo_code_select = document.getElementById("promo_code_select");
    $(promo_code_select).change(function(){
        var select_promo_code_value= promo_code_select.options[promo_code_select.selectedIndex].value;
        if(select_promo_code_value == "Percent"){
            $("#percentage").show(500);
            $("#amount").hide(500);
        }else if(select_promo_code_value == "Amount"){
            $("#amount").show(500);
            $("#percentage").hide(500);
        }
    });
</script>
@endsection

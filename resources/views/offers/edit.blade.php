@extends('layouts.app')
@section('title')
Edit Offer #{{ $offer->id }}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Offer</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Edit Offer #{{ $offer->id }}
                </div>
                <div class="panel-body">
                    <a href="{{ url('/offers') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br />
                    <br />

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::model($offer, [
                        'method' => 'PATCH',
                        'url' => ['/offers', $offer->id],
                        'files' => true
                    ]) !!}

                    @include ('offers.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer-script')
<script type="text/javascript">
    $().ready(function(){
        $("#amount-div").hide();
        $("#percentage-div").hide();
        $('#type').change(function(){
            var type = $("#type").find(":selected").val();
            if(type == ''){
                $("#amount-div").hide(500);
                $("#percentage-div").hide(500);
                
            }else if(type == 1){
                $("#amount-div").show(500);
                $("#percentage-div").hide(500);
            }else{
                $("#amount-div").hide(500);
                $("#percentage-div").show(500);
            }
        });

        var type = $("#type").find(":selected").val();
            if(type == ''){
                $("#amount-div").hide(500);
                $("#percentage-div").hide(500);
            }else if(type == 1){
                $("#amount-div").show(500);
                $("#percentage-div").hide(500);
            }else{
                $("#amount-div").hide(500);
                $("#percentage-div").show(500);
            }
    });
</script>
@endsection
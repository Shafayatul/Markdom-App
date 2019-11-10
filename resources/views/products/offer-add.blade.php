@extends('layouts.app')
@section('title')
Create New Offer
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
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Create New Offer
                </div>
                <div class="panel-body">
                    <a href="{{ url('/products') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br />
                    <br />

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::open(['url' => '/offer-save', 'files' => true]) !!}

                    <input type="hidden" name="product_id" value="{{ $id }}">

                    <div class="form-group {{ $errors->has('offer_type') ? 'has-error' : ''}}">
                        {!! Form::label('offer_type', 'Type', ['class' => 'control-label']) !!}
                        {!! Form::select('offer_type', (['' => '---Select Type---', 'Amount' => 'Amount', 'Percentage' => 'Percentage']), null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'id' => 'type'] : ['class' => 'form-control', 'id' => 'type']) !!}
                        {!! $errors->first('offer_type', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div id="amount-div">
                        <div class="form-group {{ $errors->has('offer_amount') ? 'has-error' : ''}}">
                            {!! Form::label('offer_amount', 'Amount', ['class' => 'control-label']) !!}
                            {!! Form::number('offer_amount', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'id' => 'amount'] : ['class' => 'form-control', 'id' => 'amount']) !!}
                            {!! $errors->first('offer_amount', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div id="percentage-div">
                        <div class="form-group {{ $errors->has('offer_percent') ? 'has-error' : ''}}">
                            {!! Form::label('offer_percent', 'Percentage', ['class' => 'control-label']) !!}
                            {!! Form::number('offer_percent', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'id' => 'percentage'] : ['class' => 'form-control', 'id' => 'percentage']) !!}
                            {!! $errors->first('offer_percent', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>


                    <div class="form-group">
                        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer-script')
<script type="text/javascript">
    $(document).ready(function(){
        $("#amount-div").hide();
        $("#percentage-div").hide();
        $('#type').change(function(){
            var type = $("#type").find(":selected").val();
            if(type == ''){
                $("#amount-div").hide(500);
                $("#percentage-div").hide(500);
            }else if(type == 'Amount'){
                $("#amount-div").show(500);
                $("#percentage-div").hide(500);
            }else{
                $("#amount-div").hide(500);
                $("#percentage-div").show(500);
            }
        });
    });

    
</script>
@endsection
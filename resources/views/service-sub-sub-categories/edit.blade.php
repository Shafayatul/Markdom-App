@extends('layouts.app')
@section('title')
Edit ServiceSubSubCategory #{{ $servicesubsubcategory->id }}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">ServiceSubSubCategory</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Edit ServiceSubSubCategory #{{ $servicesubsubcategory->id }}
                </div>
                <div class="panel-body">
                    <a href="{{ url('/service-sub-sub-categories') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br />
                    <br />

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::model($servicesubsubcategory, [
                        'method' => 'PATCH',
                        'url' => ['/service-sub-sub-categories', $servicesubsubcategory->id],
                        'files' => true
                    ]) !!}

                    @include ('service-sub-sub-categories.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

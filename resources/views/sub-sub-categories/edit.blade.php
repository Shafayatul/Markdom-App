@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit SubSubCategory #{{ $subsubcategory->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/sub-sub-categories') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($subsubcategory, [
                            'method' => 'PATCH',
                            'url' => ['/sub-sub-categories', $subsubcategory->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('sub-sub-categories.form', ['formMode' => 'edit'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

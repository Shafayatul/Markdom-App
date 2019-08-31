@extends('layouts.app')
@section('title')
Cities
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">City</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Cities
                </div>
                <div class="panel-body">
                    <a href="{{ url('/cities/create') }}" class="btn btn-success btn-sm" title="Add New City">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </a>

                    <br />
                    <br />
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Name Arabic</th>
                                    <th>State</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($cities as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->name_arabic }}</td>
                                    <td>{{ $states[$item->state_id] }}</td>
                                    <td>
                                        <a href="{{ url('/cities/' . $item->id) }}" title="View City"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                        <a href="{{ url('/cities/' . $item->id . '/edit') }}" title="Edit City"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/cities', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Delete City',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $cities->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

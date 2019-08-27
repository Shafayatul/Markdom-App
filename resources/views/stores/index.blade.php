@extends('layouts.app')
@section('title')
Stores
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Stores</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Stores
                </div>
                <div class="panel-body">
                    <a href="{{ url('/stores/create') }}" class="btn btn-success btn-sm" title="Add New Store">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </a>
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Sub Category</th>
                                    <th>Name</th>
                                    <th>Name Arabic</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($stores as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset($item->preview_image) }}" alt="" style="width: 100px; height: 100px;">
                                    </td>
                                    <td>{{ $subcategories[$item->sub_category_id] }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->name_arabic }}</td>
                                    <td>
                                        <a href="{{ url('/schedule/' . $item->id) }}" title="View Store"><button class="btn btn-success btn-sm"><i class="fa fa-clock-o" aria-hidden="true"></i> Slot</button></a>
                                        <a href="{{ url('/stores/' . $item->id) }}" title="View Store"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                        <a href="{{ url('/stores/' . $item->id . '/edit') }}" title="Edit Store"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/stores', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Delete Store',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $stores->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('title')
Servicesubcategories
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">ServiceSubCategory</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Servicesubcategories
                </div>
                <div class="panel-body">
                    <a href="{{ url('/service-sub-categories/create') }}" class="btn btn-success btn-sm" title="Add New ServiceSubCategory">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </a>

                    <br />
                    <br />
                    
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Module</th>
                                    <th>Store</th>
                                    <th>Service Category</th>
                                    <th>Name</th>
                                    <th>Name Arabic</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($servicesubcategories as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @isset($modules[$item->module_id])
                                            {{ $modules[$item->module_id] }}
                                        @endisset
                                    </td>
                                    <td>
                                        @isset($stores[$item->store_id])
                                            {{ $stores[$item->store_id] }}
                                        @endisset
                                    </td>
                                    <td>
                                        @isset($service_categories[$item->service_category_id])
                                            {{ $service_categories[$item->service_category_id] }}
                                        @endisset
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->name_arabic }}</td>
                                    <td>
                                        <a href="{{ url('/service-sub-categories/' . $item->id) }}" title="View ServiceSubCategory"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                        <a href="{{ url('/service-sub-categories/' . $item->id . '/edit') }}" title="Edit ServiceSubCategory"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/service-sub-categories', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Delete ServiceSubCategory',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $servicesubcategories->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

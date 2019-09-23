@extends('layouts.app')
@section('title')
Subcategories
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">SubCategory</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Subcategories
                </div>
                <div class="panel-body">
                    <a href="{{ url('/sub-categories/create') }}" class="btn btn-success btn-sm" title="Add New SubCategory">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </a>

                    {{-- {!! Form::open(['method' => 'GET', 'url' => '/sub-categories', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                        <span class="input-group-append">
                            <button class="btn btn-secondary" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                    {!! Form::close() !!} --}}

                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Module</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Name Arabic</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($subcategories as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td> 
                                        @isset($modules[$item->module_id])
                                          {{ $modules[$item->module_id] }}
                                        @endisset
                                    </td>
                                    <td> 
                                        @isset($category[$item->category_id])
                                          {{ $category[$item->category_id] }}
                                        @endisset
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->name_arabic }}</td>
                                    <td><img src="{{ $item->image }}" alt="" style="width: 80px; height: 80px;"></td>
                                    <td>
                                        <a href="{{ url('/sub-categories/' . $item->id) }}" title="View SubCategory"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                        <a href="{{ url('/sub-categories/' . $item->id . '/edit') }}" title="Edit SubCategory"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/sub-categories', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Delete SubCategory',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $subcategories->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

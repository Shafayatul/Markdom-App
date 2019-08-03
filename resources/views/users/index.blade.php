@extends('layouts.app')
@section('title')
Users
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">User</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Users
                </div>
                <div class="panel-body">
                    <a href="{{ url('/users/create') }}" class="btn btn-success btn-sm" title="Add New User">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </a>

                    {{-- {!! Form::open(['method' => 'GET', 'url' => '/users', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->getRoleNames() }}</td>
                                    <td>
                                        @if($item->status == 1)
                                            <span style="color: green;">Active</span>
                                        @else
                                            <span style="color: red;">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->status == 1)
                                            <a href="{{ url('/user-inactive/' . $item->id) }}" title="Inactive User"><button class="btn btn-warning btn-sm"><i class="fa fa-thumbs-down" aria-hidden="true"></i></button></a>
                                        @else
                                            <a href="{{ url('/user-active/' . $item->id) }}" title="Inactive User"><button class="btn btn-primary btn-sm"><i class="fa fa-thumbs-up" aria-hidden="true"></i></button></a>
                                        @endif

                                        <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#user-{{ $item->id }}">
                                            Assign User
                                        </button>
                                        <div id="user-{{ $item->id }}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                            <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Assign User Panel</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form-horizontal" method="POST" action="{{ route('assign-user') }}">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="role" class="control-label col-md-1">Role</label>
                                                                <div class="col-md-10">
                                                                    <select id="role" class="form-control" name="role" required>
                                                                        <option value="">---Select Role---</option>
                                                                        @foreach($roles as $key=>$value)
                                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="user_id" value="{{ $item->id }}" />
                                                            <div class="form-group">
                                                                <label></label>
                                                                <div class="col-md-10  col-md-offset-1">
                                                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>





                                        <a href="{{ url('/users/' . $item->id) }}" title="View User"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                        <a href="{{ url('/users/' . $item->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/users', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Delete User',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $users->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

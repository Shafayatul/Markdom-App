@extends('layouts.app')
@section('title')
Offers
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
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Offers
                </div>
                <div class="panel-body">
                    <a href="{{ url('/offers/create') }}" class="btn btn-success btn-sm" title="Add New Offer">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </a>

                    <br />
                    <br />
                    
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Title Arabic</th>
                                    <th>Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($offers as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->title_arabic }}</td>
                                    <td>
                                        @if($item->is_amount == '1')
                                            {{ 'Amount' }}
                                        @else
                                            {{ 'Percentage' }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/offers/' . $item->id) }}" title="View Offer"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                        <a href="{{ url('/offers/' . $item->id . '/edit') }}" title="Edit Offer"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/offers', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Delete Offer',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $offers->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

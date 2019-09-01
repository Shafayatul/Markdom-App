@extends('layouts.app')
@section('title')
Address {{ $address->id }}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Address</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Address {{ $address->id }}
                </div>
                <div class="panel-body">

                    <a href="{{ url('/addresses') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <a href="{{ url('/addresses/' . $address->id . '/edit') }}" title="Edit Address"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                    {!! Form::open([
                        'method'=>'DELETE',
                        'url' => ['addresses', $address->id],
                        'style' => 'display:inline'
                    ]) !!}
                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-sm',
                                'title' => 'Delete Address',
                                'onclick'=>'return confirm("Confirm delete?")'
                        ))!!}
                    {!! Form::close() !!}
                    <br/>
                    <br/>

                    
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $address->id }}</td>
                                </tr>
                                <tr>
                                    <th> User </th>
                                    <td>
                                        @if(isset($users[$address->user_id])) 
                                            {{ $users[$address->user_id] }}
                                        @endif 
                                    </td>
                                </tr>
                                <tr>
                                    <th> Flat No </th>
                                    <td> {{ $address->flat_no }} </td>
                                </tr>
                                <tr>
                                    <th> Location </th>
                                    <td> {{ $address->location }} </td>
                                </tr>
                                <tr>
                                    <th> Pin Code </th>
                                    <td> {{ $address->pin_code }} </td>
                                </tr>
                                <tr>
                                    <th> Phone No </th>
                                    <td> {{ $address->phone_no }} </td>
                                </tr>
                                <tr>
                                    <th> City </th>
                                    <td>
                                        @if(isset($cities[$address->city_id])) 
                                            {{ $cities[$address->city_id] }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th> State </th>
                                    <td>
                                        @if(isset($states[$address->state_id])) 
                                            {{ $states[$address->state_id] }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th> Country </th>
                                    <td>
                                        @if(isset($countries[$address->country_id])) 
                                            {{ $countries[$address->country_id] }}
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

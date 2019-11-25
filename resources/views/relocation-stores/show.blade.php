@extends('layouts.app')
@section('title')
RelocationStore {{ $relocationstore->id }}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">RelocationStore</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                  RelocationStore {{ $relocationstore->id }}
                </div>
                <div class="panel-body">
                    <a href="{{ url('/relocation-stores') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    {!! Form::open([
                        'method'=>'DELETE',
                        'url' => ['relocation-stores', $relocationstore->id],
                        'style' => 'display:inline'
                    ]) !!}
                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-sm',
                                'title' => 'Delete RelocationStore',
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
                                    <td>{{ $relocationstore->id }}</td>
                                </tr>
                                <tr>
                                    <th> Name </th>
                                    <td> {{ $relocationstore->name }} </td>
                                </tr>
                                <tr>
                                    <th> Name Arabic </th>
                                    <td> {{ $relocationstore->name_arabic }} </td>
                                </tr>
                                <tr>
                                    <th> Description </th>
                                    <td> {{ $relocationstore->description }} </td>
                                </tr>
                                <tr>
                                    <th> Arabic Description </th>
                                    <td> {{ $relocationstore->arabic_description }} </td>
                                </tr>
                                <tr>
                                    <th> Location </th>
                                    <td> {{ $relocationstore->location }} </td>
                                </tr>
                                <tr>
                                    <th> Arabic Location </th>
                                    <td> {{ $relocationstore->arabic_location }} </td>
                                </tr>
                                <tr>
                                    <th> Latitude </th>
                                    <td> {{ $relocationstore->lat }} </td>
                                </tr>
                                <tr>
                                    <th> Longitude </th>
                                    <td> {{ $relocationstore->lng }} </td>
                                </tr>
                                <tr>
                                    <th> Status </th>
                                    <td> 
                                        @if($relocationstore->status == 1)
                                            <span style="color: green">Activate</span>
                                        @else
                                            <span style="color: red">Deactivate</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Preview Image</th>
                                    <td>
                                        <img src="{{ asset($relocationstore->preview_image) }}" alt="" style="width: 100px; height: 100px;">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Multiple Images</th>
                                    <td>
                                        @if(isset($relocationstore->multiple_images))
                                            @php
                                                $images = explode(',', $relocationstore->multiple_images);
                                            @endphp
                                            @foreach($images as $image)
                                                <img src="{{ asset($image) }}" alt="" style="width: 100px; height: 100px;">
                                            @endforeach
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

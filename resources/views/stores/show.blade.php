@extends('layouts.app')
@section('title')
Store {{ $store->id }}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Store</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Store {{ $store->id }}
                </div>
                <div class="panel-body">
                    
                    <a href="{{ url('/stores') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/stores/' . $store->id . '/edit') }}" title="Edit Store"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['stores', $store->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Store',
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
                                        <td>{{ $store->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Category </th>
                                        <td>
                                            @isset($categories[$store->category_id]) 
                                                {{ $categories[$store->category_id] }}
                                            @endisset 
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Sub Category </th>
                                        <td>
                                            @isset($subcategories[$store->sub_category_id]) 
                                                {{ $subcategories[$store->sub_category_id] }} 
                                            @endisset
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Name </th>
                                        <td> {{ $store->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Name Arabic </th>
                                        <td> {{ $store->name_arabic }} </td>
                                    </tr>
                                    <tr>
                                        <th> Description </th>
                                        <td> {{ $store->description }} </td>
                                    </tr>
                                    <tr>
                                        <th> Arabic Description </th>
                                        <td> {{ $store->arabic_description }} </td>
                                    </tr>
                                    <tr>
                                        <th>Location</th>
                                        <td>{{ $store->location }}</td>
                                    </tr>
                                    <tr>
                                        <th>Arabic Location</th>
                                        <td>{{ $store->arabic_location }}</td>
                                    </tr>
                                    <tr>
                                        <th> Latitude </th>
                                        <td> {{ $store->lat }} </td>
                                    </tr>
                                    <tr>
                                        <th> Longitude </th>
                                        <td> {{ $store->lan }} </td>
                                    </tr>
                                    <tr>
                                        <th> Status </th>
                                        <td> 
                                            @if($store->status == 1)
                                                <span style="color: green">Activate</span>
                                            @else
                                                <span style="color: red">Deactivate</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Preview Image</th>
                                        <td>
                                            <img src="{{ asset($store->preview_image) }}" alt="" style="width: 100px; height: 100px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Multiple Images</th>
                                        <td>
                                            @if(isset($store->multiple_images))
                                                @php
                                                    $images = explode(',', $store->multiple_images);
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

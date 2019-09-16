@extends('layouts.app')
@section('title')
ServiceSubCategory {{ $servicesubcategory->id }}
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
                   ServiceSubCategory {{ $servicesubcategory->id }}
                </div>
                <div class="panel-body">
                    <a href="{{ url('/service-sub-categories') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <a href="{{ url('/service-sub-categories/' . $servicesubcategory->id . '/edit') }}" title="Edit ServiceSubCategory"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                    {!! Form::open([
                        'method'=>'DELETE',
                        'url' => ['servicesubcategories', $servicesubcategory->id],
                        'style' => 'display:inline'
                    ]) !!}
                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-sm',
                                'title' => 'Delete ServiceSubCategory',
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
                                        <td>{{ $servicesubcategory->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Service Category </th>
                                        <td>
                                            @isset($service_categories[$servicesubcategory->service_category_id]) 
                                                {{ $service_categories[$servicesubcategory->service_category_id] }}
                                            @endisset 
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Name </th>
                                        <td> {{ $servicesubcategory->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Name Arabic </th>
                                        <td> {{ $servicesubcategory->name_arabic }} </td>
                                    </tr>
                                    <tr>
                                        <th> Image </th>
                                        <td> 
                                            <img src="{{ asset($servicesubcategory->preview_image) }}" alt="" style="width: 200px; height: 200px;">
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

@extends('layouts.app')
@section('title')
SubCategory {{ $subcategory->id }}
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
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                   SubCategory {{ $subcategory->id }}
                </div>
                <div class="panel-body">
                    <a href="{{ url('/sub-categories') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <a href="{{ url('/sub-categories/' . $subcategory->id . '/edit') }}" title="Edit SubCategory"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                    {!! Form::open([
                        'method'=>'DELETE',
                        'url' => ['sub-categories', $subcategory->id],
                        'style' => 'display:inline'
                    ]) !!}
                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-sm',
                                'title' => 'Delete SubCategory',
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
                                    <td>{{ $subcategory->id }}</td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td>{{ $category[$subcategory->category_id] }}</td>
                                </tr>
                                <tr>
                                    <th> Name </th>
                                    <td> {{ $subcategory->name }} </td>
                                </tr>
                                <tr>
                                    <th> Name Arabic </th>
                                    <td> {{ $subcategory->name_arabic }} </td>
                                </tr>
                                <tr>
                                    <th> Image </th>
                                    <td> 
                                        <img src="{{ asset($subcategory->image) }}" alt="{{ $subcategory->name }}" style="width: 100%; height: auto;" /> 
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

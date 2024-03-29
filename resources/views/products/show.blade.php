@extends('layouts.app')
@section('title')
Product {{ $product->id }}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Product</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Product {{ $product->id }}
                </div>
                <div class="panel-body">
                    <a href="{{ url('/products') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <a href="{{ url('/products/' . $product->id . '/edit') }}" title="Edit Product"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                    {!! Form::open([
                        'method'=>'DELETE',
                        'url' => ['products', $product->id],
                        'style' => 'display:inline'
                    ]) !!}
                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-sm',
                                'title' => 'Delete Product',
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
                                    <td>{{ $product->id }}</td>
                                </tr>
                                <tr>
                                    <th> Module </th>
                                    <td>
                                        @if(isset($modules[$product->module_id])) 
                                            {{ $modules[$product->module_id] }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th> Store </th>
                                    <td>
                                        @if(isset($stores[$product->store_id])) 
                                            {{ $stores[$product->store_id] }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th> Service Category</th>
                                    <td>
                                        @if(isset($service_categories[$product->service_category_id])) 
                                            {{ $service_categories[$product->service_category_id] }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th> Service Sub Category</th>
                                    <td>
                                        @if(isset($service_sub_categories[$product->service_sub_category_id])) 
                                            {{ $service_sub_categories[$product->service_sub_category_id] }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th> Service Sub Sub Category </th>
                                    <td>
                                        @if(isset($service_sub_sub_categories[$product->service_sub_sub_category_id])) 
                                            {{ $service_sub_sub_categories[$product->service_sub_sub_category_id] }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th> Category </th>
                                    <td>
                                        @if(isset($categories[$product->category_id])) 
                                            {{ $categories[$product->category_id] }}
                                        @endif
                                    </td>
                                </tr><tr>
                                    <th> Sub Category </th>
                                    <td>
                                        @if(isset($subcategories[$product->sub_category_id])) 
                                            {{ $subcategories[$product->sub_category_id] }}
                                        @endif
                                    </td>
                                </tr><tr>
                                    <th> Sub Sub Category </th>
                                    <td>
                                        @if(isset($subsubcategories[$product->sub_sub_category_id])) 
                                            {{ $subsubcategories[$product->sub_sub_category_id] }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th> Name </th>
                                    <td> {{ $product->name }} </td>
                                </tr>
                                <tr>
                                    <th> Name Arabic </th>
                                    <td> {{ $product->name_arabic }} </td>
                                </tr>
                                <tr>
                                    <th> Description </th>
                                    <td> {!! $product->description !!} </td>
                                </tr>
                                <tr>
                                    <th> Description Arabic </th>
                                    <td> {!! $product->description_arabic !!} </td>
                                </tr>
                                <tr>
                                    <th> Image </th>
                                    <td> 
                                        <img src="{{ asset($product->preview_image) }}" alt="{{ $product->name }}" style="width: 200px; height: 200px;" />
                                    </td>
                                </tr>

                                <tr>
                                    <th>Multiple Images</th>
                                    <td>
                                        @if(isset($product->multiple_images))
                                            @php
                                                $images = explode(',', $product->multiple_images);
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

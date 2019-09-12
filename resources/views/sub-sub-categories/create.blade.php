@extends('layouts.app')
@section('title')
Create Sub Sub Category
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">SubSubCategory</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Create New SubSubCategory
                </div>
                <div class="panel-body">
                    <a href="{{ url('/sub-sub-categories') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br />
                    <br />

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::open(['url' => '/sub-sub-categories', 'files' => true]) !!}

                    @include ('sub-sub-categories.form', ['formMode' => 'create'])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer-script')
<script type="text/javascript">
    $(document).ready(function(){
        $("#module_id").change(function(){
            var module_id = $("#module_id").val();
            if(module_id){

                $.ajax({
                    type:"GET",
                    url:"{{url('get-categories-list')}}?module_id="+module_id,
                    success:function(res){
                        if(res){
                            $("#category_id").empty();
                            $("#category_id").append('<option>Select Category</option>');
                            $.each(res,function(key,value){
                                $("#category_id").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                        $("#category_id").empty();
                        $("#sub_category_id").empty();
                        }
                    }
                });
            }else{
                $("#category_id").empty();
                $("#sub_category_id").empty();
            }
        });

        $("#category_id").change(function(){
            var category_id = $(this).val();
            if(category_id){

                $.ajax({
                    type:"GET",
                    url:"{{url('get-subcategories-list')}}?category_id="+category_id,
                    success:function(res){
                        if(res){
                            $("#sub_category_id").empty();
                            $("#sub_category_id").append('<option>Select Sub Category</option>');
                            $.each(res,function(key,value){
                                $("#sub_category_id").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                        $("#category_id").empty();
                        $("#sub_category_id").empty();
                        }
                    }
                });
            }else{
                $("#category_id").empty();
                $("#sub_category_id").empty();
            }
        });
    });
</script>
@endsection
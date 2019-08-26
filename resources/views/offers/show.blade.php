@extends('layouts.app')
@section('title')
Offer {{ $offer->id }}
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
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Offer {{ $offer->id }}
                </div>
                <div class="panel-body">
                    <a href="{{ url('/offers') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <a href="{{ url('/offers/' . $offer->id . '/edit') }}" title="Edit Offer"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                    {!! Form::open([
                        'method'=>'DELETE',
                        'url' => ['offers', $offer->id],
                        'style' => 'display:inline'
                    ]) !!}
                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-sm',
                                'title' => 'Delete Offer',
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
                                    <td>{{ $offer->id }}</td>
                                </tr>
                                <tr>
                                    <th> Title </th>
                                    <td> {{ $offer->title }} </td>
                                </tr>
                                <tr>
                                    <th> Title Arabic </th>
                                    <td> {{ $offer->title_arabic }} </td>
                                </tr>
                                <tr>
                                    <th> Type </th>
                                    <td> 
                                        @if($offer->is_amount == '1')
                                            {{ 'Amount' }}
                                        @else
                                            {{ 'Percentage' }}
                                        @endif 
                                    </td>
                                </tr>
                                <tr>
                                    @if($offer->is_amount == '1')
                                        <th>Amount</th>
                                        <td>{{ $offer->amount }}</td>
                                    @else
                                        <th>Percentage</th>
                                        <td>{{ $offer->percentage }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>Image</th>
                                    <td>
                                        <img src="{{ asset($offer->image) }}" alt="{{ $offer->title }}" style="width: 200px; height: 200px;">
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

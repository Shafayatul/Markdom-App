@extends('layouts.app')
@section('title')
Promo Codes #{{$promocode->id}}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Promo Codes</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                  Promo Codes #{{$promocode->id}}
                </div>
                <div class="panel-body">
                    <a href="{{ url('/promo-codes') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    {{-- <a href="{{ url('/promo-codes/' . $promocode->id . '/edit') }}" title="Edit Promo Code"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> --}}
                    {!! Form::open([
                        'method'=>'DELETE',
                        'url' => ['promo-codes', $promocode->id],
                        'style' => 'display:inline'
                    ]) !!}
                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-sm',
                                'title' => 'Delete Promo Code',
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
                                  <td>{{ $promocode->id }}</td>
                              </tr>
                              <tr>
                                  <th> Code </th>
                                  <td> {{ $promocode->code }} </td>
                              </tr>
                              <tr>
                                  <th> Type </th>
                                  <td> {{ $promocode->type }} </td>
                              </tr>
                              <tr>
                                  <th> Percent </th>
                                  <td> {{ $promocode->percent }} </td>
                              </tr>
                              <tr>
                                  <th> Amount </th>
                                  <td> {{ $promocode->amount }} </td>
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

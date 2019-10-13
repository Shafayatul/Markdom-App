@extends('layouts.app')
@section('title')
Promo Codes
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
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Promo Codes
                </div>
                <div class="panel-body">
                    <a href="{{ url('/promo-codes/create') }}" class="btn btn-success btn-sm" title="Add New Promo Codes">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </a>

                    <br />
                    <br />
                    
                    <div class="table-responsive">
                      <table class="table table-bordered">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Code</th>
                                  <th>Type</th>
                                  <th>Percent</th>
                                  <th>Amount</th>
                                  <th>Actions</th>
                              </tr>
                          </thead>
                          <tbody>
                          @foreach($promocodes as $item)
                              <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $item->code }}</td>
                                  <td>{{ $item->type }}</td>
                                  <td>{{ $item->percent }}</td>
                                  <td>{{ $item->amount }}</td>
                                  <td>
                                      <a href="{{ url('/promo-codes/' . $item->id) }}" title="View PromoCode"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                      {{-- <a href="{{ url('/promo-codes/' . $item->id . '/edit') }}" title="Edit PromoCode"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> --}}
                                      {!! Form::open([
                                          'method'=>'DELETE',
                                          'url' => ['/promo-codes', $item->id],
                                          'style' => 'display:inline'
                                      ]) !!}
                                          {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Delete', array(
                                                  'type' => 'submit',
                                                  'class' => 'btn btn-danger btn-sm',
                                                  'title' => 'Delete PromoCode',
                                                  'onclick'=>'return confirm("Confirm delete?")'
                                          )) !!}
                                      {!! Form::close() !!}
                                  </td>
                              </tr>
                          @endforeach
                          </tbody>
                      </table>
                      <div class="pagination-wrapper"> {!! $promocodes->appends(['search' => Request::get('search')])->render() !!} </div>
                  </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('title')
Bookedschedules
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Bookedschedule</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Bookedschedules
                </div>
                <div class="panel-body">
                    {!! Form::open(['method' => 'GET', 'url' => '/booked-schedules', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                    <div class="input-group">
                        <input type="date" class="form-control" name="book_date" placeholder="Search..." value="{{ request('book_date') }}">
                    </div>
                    <div class="input-group">
                        <select class="form-control" name="store_id">
                            <option value="">--Select Store--</option>
                            @foreach($stores as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <span class="input-group-append">
                        <button class="btn btn-secondary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                    {!! Form::close() !!}
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Schedule</th>
                                    <th>Store</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($schedules as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $item->timespan }}
                                    </td>
                                    <td>
                                        @isset($stores[$item->store_id])
                                            {{ $stores[$item->store_id] }}
                                        @endisset
                                    </td>
                                    <td>{{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                                    <td>
                                        @if(in_array($item->id, $bookedschedule_ids))
                                            <span style="color: red;">Booked</span>
                                        @else 
                                            <span style="color: green;">Availabel</span>
                                        @endif
                                    </td>
                                    <td>
                                        
                                        @if(in_array($item->id, $bookedschedule_ids))
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/booked-schedules', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Unbooked', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Unbooked BookedSchedule',
                                                        'onclick'=>'return confirm("Confirm Unbooked?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        @else 
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#booked-{{ $item->id }}">Booked</button>

                                            <!-- Modal -->
                                            <div id="booked-{{ $item->id }}" class="modal fade" role="dialog">
                                              <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Booked Panel</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                    {!! Form::open(['url' => '/booked-schedules', 'files' => true]) !!}

                                                    <div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
                                                        {!! Form::label('date', 'Date', ['class' => 'control-label']) !!}
                                                        {!! Form::date('date', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                        {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
                                                    </div>

                                                    <input type="hidden" name="schedule_id" value="{{ $item->id }}">
                                                    <input type="hidden" name="store_id" value="{{ $item->store_id }}">

                                                    <div class="form-group">
                                                        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
                                                    </div>

                                                    {!! Form::close() !!}
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  </div>
                                                </div>

                                              </div>
                                            </div>
                                        @endif
                                        


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $schedules->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

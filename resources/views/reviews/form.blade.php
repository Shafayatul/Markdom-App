<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    {!! Form::label('user_id', 'User Id', ['class' => 'control-label']) !!}
    {!! Form::select('user_id', $users, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('star') ? 'has-error' : ''}}">
    {!! Form::label('star', 'Star', ['class' => 'control-label']) !!}
    {!! Form::select('star', (['1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5']), null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('star', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('review') ? 'has-error' : ''}}">
    {!! Form::label('review', 'Review', ['class' => 'control-label']) !!}
    {!! Form::textarea('review', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('review', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>

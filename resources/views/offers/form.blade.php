<div class="form-group {{ $errors->has('module_id') ? 'has-error' : ''}}">
    {!! Form::label('module_id', 'Module', ['class' => 'control-label']) !!}
    {!! Form::select('module_id', $modules, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('module_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('store_id') ? 'has-error' : ''}}">
    {!! Form::label('store_id', 'Store', ['class' => 'control-label']) !!}
    {!! Form::select('store_id', $stores, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('store_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
    {!! Form::text('title', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('title_arabic') ? 'has-error' : ''}}">
    {!! Form::label('title_arabic', 'Title Arabic', ['class' => 'control-label']) !!}
    {!! Form::text('title_arabic', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('title_arabic', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('is_amount') ? 'has-error' : ''}}">
    {!! Form::label('is_amount', 'Type', ['class' => 'control-label']) !!}
    {!! Form::select('is_amount', (['' => '---Select Type---', '1' => 'Amount', '0' => 'Percentage']), null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'id' => 'type'] : ['class' => 'form-control', 'id' => 'type']) !!}
    {!! $errors->first('is_amount', '<p class="help-block">:message</p>') !!}
</div>

<div id="amount-div">
    <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
        {!! Form::label('amount', 'Amount', ['class' => 'control-label']) !!}
        {!! Form::text('amount', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'id' => 'amount'] : ['class' => 'form-control', 'id' => 'amount']) !!}
        {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div id="percentage-div">
    <div class="form-group {{ $errors->has('percentage') ? 'has-error' : ''}}">
        {!! Form::label('percentage', 'Percentage', ['class' => 'control-label']) !!}
        {!! Form::text('percentage', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'id' => 'percentage'] : ['class' => 'form-control', 'id' => 'percentage']) !!}
        {!! $errors->first('percentage', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    {!! Form::label('image', 'Image', ['class' => 'control-label']) !!}
    {!! Form::file('image', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>

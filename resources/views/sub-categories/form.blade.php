@if($formMode == 'create')
    <div class="form-group {{ $errors->has('module_id') ? 'has-error' : ''}}">
        {!! Form::label('module_id', 'Module', ['class' => 'control-label']) !!}
        {!! Form::select('module_id', $modules, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'id' => 'module_id', 'placeholder' => '--Select Module--'] : ['class' => 'form-control', 'id' => 'module_id', 'placeholder' => '--Select Module--']) !!}
        {!! $errors->first('module_id', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
        {!! Form::label('category_id', 'Category', ['class' => 'control-label']) !!}
        {!! Form::select('category_id',[], null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'id' => 'category_id'] : ['class' => 'form-control', 'id' => 'category_id']) !!}
        {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
    </div>
@endif
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('name_arabic') ? 'has-error' : ''}}">
    {!! Form::label('name_arabic', 'Name Arabic', ['class' => 'control-label']) !!}
    {!! Form::text('name_arabic', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('name_arabic', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    {!! Form::label('image', 'Image', ['class' => 'control-label']) !!}
    {!! Form::file('image', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>

@if($formMode == 'edit')
    <div class="form-group">
        <img src="{{ asset($subcategory->image) }}" alt="" style="width: 200px; height: 200px;">
    </div>
@endif

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>

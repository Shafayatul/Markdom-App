<div class="form-group {{ $errors->has('service_category_id') ? 'has-error' : ''}}">
    {!! Form::label('service_category_id', 'Service Category Id', ['class' => 'control-label']) !!}
    {!! Form::select('service_category_id', $service_categories, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'placeholder' => '--Select Service category--'] : ['class' => 'form-control', 'placeholder' => '--Select Service category--']) !!}
    {!! $errors->first('service_category_id', '<p class="help-block">:message</p>') !!}
</div>
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

<div class="form-group {{ $errors->has('preview_image') ? 'has-error' : ''}}">
    {!! Form::label('preview_image', 'Image', ['class' => 'control-label']) !!}
    {!! Form::file('preview_image', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('preview_image', '<p class="help-block">:message</p>') !!}
</div>

@if($formMode == 'edit')
    <div class="form-group">
        <img src="{{ asset($servicesubcategory->preview_image) }}" alt="" style="width: 100px; height: 100px;">
    </div>
@endif


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>

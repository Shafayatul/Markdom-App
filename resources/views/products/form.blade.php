@if($formMode == 'create')
<div class="form-group {{ $errors->has('module_id') ? 'has-error' : ''}}">
    {!! Form::label('module_id', 'Module', ['class' => 'control-label']) !!}
    {!! Form::select('module_id', $modules, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'placeholder' => '--Select Module--'] : ['class' => 'form-control', 'placeholder' => '--Select Module--']) !!}
    {!! $errors->first('module_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
    {!! Form::label('category_id', 'Category', ['class' => 'control-label']) !!}
    {!! Form::select('category_id', $categories, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'placeholder' => '--Select Category--'] : ['class' => 'form-control', 'placeholder' => '--Select Category--']) !!}
    {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('sub_category_id') ? 'has-error' : ''}}">
    {!! Form::label('sub_category_id', 'Sub Category', ['class' => 'control-label']) !!}
    {!! Form::select('sub_category_id', $subcategories, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'placeholder' => '--Select Sub Category--'] : ['class' => 'form-control', 'placeholder' => '--Select Sub Category--']) !!}
    {!! $errors->first('sub_sub_category_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('sub_sub_category_id') ? 'has-error' : ''}}">
    {!! Form::label('sub_sub_category_id', 'Sub Sub Category', ['class' => 'control-label']) !!}
    {!! Form::select('sub_sub_category_id', $subsubcategories, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'placeholder' => '--Select Sub Sub Category--'] : ['class' => 'form-control', 'placeholder' => '--Select Sub Sub Category--']) !!}
    {!! $errors->first('sub_sub_category_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('store_id') ? 'has-error' : ''}}">
    {!! Form::label('store_id', 'Store', ['class' => 'control-label']) !!}
    {!! Form::select('store_id', $stores, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'placeholder' => '--Select Store--'] : ['class' => 'form-control', 'placeholder' => '--Select Store--']) !!}
    {!! $errors->first('store_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('service_category_id') ? 'has-error' : ''}}">
    {!! Form::label('service_category_id', 'Service Category', ['class' => 'control-label']) !!}
    {!! Form::select('service_category_id', $service_categories, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'placeholder' => '--Select Service Category--'] : ['class' => 'form-control', 'placeholder' => '--Select Service Category--']) !!}
    {!! $errors->first('service_category_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('service_sub_category_id') ? 'has-error' : ''}}">
    {!! Form::label('service_sub_category_id', 'Service Sub Category', ['class' => 'control-label']) !!}
    {!! Form::select('service_sub_category_id', $service_sub_categories, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'placeholder' => '--Select Service Sub Category--'] : ['class' => 'form-control', 'placeholder' => '--Select Service Sub Category--']) !!}
    {!! $errors->first('service_sub_category_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('service_sub_sub_category_id') ? 'has-error' : ''}}">
    {!! Form::label('service_sub_sub_category_id', 'Service Sub Category', ['class' => 'control-label']) !!}
    {!! Form::select('service_sub_sub_category_id', $service_sub_sub_categories, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'placeholder' => '--Select Service Sub Sub Category--'] : ['class' => 'form-control', 'placeholder' => '--Select Service Sub Sub Category--']) !!}
    {!! $errors->first('service_sub_sub_category_id', '<p class="help-block">:message</p>') !!}
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
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
    {!! Form::textarea('description', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'rows' => '3', 'cols' => '5'] : ['class' => 'form-control', 'rows' => '3', 'cols' => '5']) !!}
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('description_arabic') ? 'has-error' : ''}}">
    {!! Form::label('description_arabic', 'Description Arabic', ['class' => 'control-label']) !!}
    {!! Form::textarea('description_arabic', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'rows' => '3', 'cols' => '5'] : ['class' => 'form-control', 'rows' => '3', 'cols' => '5']) !!}
    {!! $errors->first('description_arabic', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    {!! Form::label('price', 'Price', ['class' => 'control-label']) !!}
    {!! Form::number('price', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('preview_image') ? 'has-error' : ''}}">
    {!! Form::label('preview_image', 'Preview Image', ['class' => 'control-label']) !!}
    {!! Form::file('preview_image', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('preview_image', '<p class="help-block">:message</p>') !!}
</div>

@if($formMode == 'edit')
    <div class="form-group">
        <img src="{{ asset($product->preview_image) }}" alt="" style="width: 200px; height: 200px;">
    </div>
@endif

<div class="form-group {{ $errors->has('multiple_images[]') ? 'has-error' : ''}}">
    {!! Form::label('multiple_images[]', 'Multiple Images', ['class' => 'control-label']) !!}
    {{-- {!! Form::file('multiple_images[]', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'multiple' => 'multiple'] : ['class' => 'form-control', 'multiple' => 'multiple']) !!} --}}
    <input type="file" class="form-control" name="multiple_images[]" multiple="multiple">
    {!! $errors->first('multiple_images[]', '<p class="help-block">:message</p>') !!}
</div>

@if($formMode == 'edit')
    @if(isset($product->multiple_images))
        @php
            $images = explode(',', $product->multiple_images);
        @endphp
        @foreach($images as $image)
            <img src="{{ asset($image) }}" alt="" style="width: 100px; height: 100px;">
        @endforeach
    @endif
@endif


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>

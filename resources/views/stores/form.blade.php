@if($formMode == 'create')
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('module_id') ? 'has-error' : ''}}">
                {!! Form::label('module_id', 'Module', ['class' => 'control-label']) !!}
                {!! Form::select('module_id', $modules, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'id' => 'module_id', 'placeholder' => '--Select Module--'] : ['class' => 'form-control', 'id' => 'module_id', 'placeholder' => '--Select Module--']) !!}
                {!! $errors->first('module_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
            {!! Form::label('category_id', 'Category', ['class' => 'control-label']) !!}
            {!! Form::select('category_id', [], null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'id' => 'category_id'] : ['class' => 'form-control', 'id' => 'category_id']) !!}
            {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('sub_category_id') ? 'has-error' : ''}}">
            {!! Form::label('sub_category_id', 'Sub Category', ['class' => 'control-label']) !!}
            {!! Form::select('sub_category_id', [], null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'id' => 'sub_category_id'] : ['class' => 'form-control', 'id' => 'sub_category_id']) !!}
            {!! $errors->first('sub_category_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
@endif

<div class="row">
    <div class="col-md-6">   
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
            {!! Form::text('name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('name_arabic') ? 'has-error' : ''}}">
            {!! Form::label('name_arabic', 'Name Arabic', ['class' => 'control-label']) !!}
            {!! Form::text('name_arabic', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('name_arabic', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
       <div class="form-group {{ $errors->has('lat') ? 'has-error' : ''}}">
            {!! Form::label('lat', 'Lat', ['class' => 'control-label']) !!}
            {!! Form::text('lat', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('lat', '<p class="help-block">:message</p>') !!}
        </div> 
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('lan') ? 'has-error' : ''}}">
            {!! Form::label('lan', 'Lan', ['class' => 'control-label']) !!}
            {!! Form::text('lan', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('lan', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
            {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
            {!! Form::textarea('description', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'rows' => '4', 'cols' => '5'] : ['class' => 'form-control', 'rows' => '4', 'cols' => '5']) !!}
            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('arabic_description') ? 'has-error' : ''}}">
            {!! Form::label('arabic_description', 'Arabic Description', ['class' => 'control-label']) !!}
            {!! Form::textarea('arabic_description', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'rows' => '4', 'cols' => '5'] : ['class' => 'form-control', 'rows' => '4', 'cols' => '5']) !!}
            {!! $errors->first('arabic_description', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('location') ? 'has-error' : ''}}">
            {!! Form::label('location', 'Location', ['class' => 'control-label']) !!}
            {!! Form::text('location', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('location', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('arabic_location') ? 'has-error' : ''}}">
            {!! Form::label('arabic_location', 'Arabic Location', ['class' => 'control-label']) !!}
            {!! Form::text('arabic_location', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('arabic_location', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
            {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}
            {!! Form::select('status', (['1'=>'Active', '0'=>'Deactive']), null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('preview_image') ? 'has-error' : ''}}">
            {!! Form::label('preview_image', 'Preview Image', ['class' => 'control-label']) !!}
            {!! Form::file('preview_image', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('preview_image', '<p class="help-block">:message</p>') !!}
        </div>
        @if($formMode == 'edit')
            <div class="form-group">
                <img src="{{ asset($store->preview_image) }}" alt="" style="width: 100px; height: 100px;">
            </div>
        @endif
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('multiple_images[]') ? 'has-error' : ''}}">
            {!! Form::label('multiple_images[]', 'Multiple Images', ['class' => 'control-label']) !!}
            {{-- {!! Form::file('multiple_images[]', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'multiple' => 'multiple'] : ['class' => 'form-control', 'multiple' => 'multiple']) !!} --}}
            <input type="file" class="form-control" name="multiple_images[]" multiple="multiple">
            {!! $errors->first('multiple_images[]', '<p class="help-block">:message</p>') !!}
        </div>

        @if($formMode == 'edit')
            @if(isset($store->multiple_images))
                @php
                    $images = explode(',', $store->multiple_images);
                @endphp
                @foreach($images as $image)
                    <img src="{{ asset($image) }}" alt="" style="width: 100px; height: 100px;">
                @endforeach
            @endif
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
</div>

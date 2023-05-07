<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $brand->id }}</p>
</div>

<!-- Cat Id Field -->
<div class="form-group">
    {!! Form::label('cat_id', 'Cat Id:') !!}
    <p>{{ $brand->cat_id }}</p>
</div>

<!-- Sub Id Field -->
<div class="form-group">
    {!! Form::label('sub_id', 'Sub Id:') !!}
    <p>{{ $brand->sub_id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $brand->name }}</p>
</div>

<!-- Brand Icon Field -->
<div class="form-group">
    {!! Form::label('brand_icon', 'Brand Icon:') !!}
    <p>{{ $brand->brand_icon }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $brand->status }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $brand->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $brand->updated_at }}</p>
</div>


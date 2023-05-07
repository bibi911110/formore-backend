<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $orderProducts->id }}</p>
</div>

<!-- Cat Id Field -->
<div class="form-group">
    {!! Form::label('cat_id', 'Cat Id:') !!}
    <p>{{ $orderProducts->cat_id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $orderProducts->name }}</p>
</div>

<!-- Product Img Field -->
<div class="form-group">
    {!! Form::label('product_img', 'Product Img:') !!}
    <p>{{ $orderProducts->product_img }}</p>
</div>

<!-- Ingredients Name Field -->
<div class="form-group">
    {!! Form::label('ingredients_name', 'Ingredients Name:') !!}
    <p>{{ $orderProducts->ingredients_name }}</p>
</div>

<!-- Available Quantities Field -->
<div class="form-group">
    {!! Form::label('available_quantities', 'Available Quantities:') !!}
    <p>{{ $orderProducts->available_quantities }}</p>
</div>

<!-- Price Per Quantity Field -->
<div class="form-group">
    {!! Form::label('price_per_quantity', 'Price Per Quantity:') !!}
    <p>{{ $orderProducts->price_per_quantity }}</p>
</div>

<!-- Points Per Quantity Field -->
<div class="form-group">
    {!! Form::label('points_per_quantity', 'Points Per Quantity:') !!}
    <p>{{ $orderProducts->points_per_quantity }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $orderProducts->status }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $orderProducts->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $orderProducts->updated_at }}</p>
</div>


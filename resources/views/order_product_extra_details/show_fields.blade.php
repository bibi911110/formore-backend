<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $orderProductExtraDetails->id }}</p>
</div>

<!-- Product Id Field -->
<div class="form-group">
    {!! Form::label('product_id', 'Product Id:') !!}
    <p>{{ $orderProductExtraDetails->product_id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $orderProductExtraDetails->name }}</p>
</div>

<!-- Available Quantities Field -->
<div class="form-group">
    {!! Form::label('available_quantities', 'Available Quantities:') !!}
    <p>{{ $orderProductExtraDetails->available_quantities }}</p>
</div>

<!-- Points Per Quantity Field -->
<div class="form-group">
    {!! Form::label('points_per_quantity', 'Points Per Quantity:') !!}
    <p>{{ $orderProductExtraDetails->points_per_quantity }}</p>
</div>

<!-- Price Per Quantity Field -->
<div class="form-group">
    {!! Form::label('price_per_quantity', 'Price Per Quantity:') !!}
    <p>{{ $orderProductExtraDetails->price_per_quantity }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $orderProductExtraDetails->status }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $orderProductExtraDetails->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $orderProductExtraDetails->updated_at }}</p>
</div>


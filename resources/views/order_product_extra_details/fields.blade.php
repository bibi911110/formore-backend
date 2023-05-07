<!-- Product Id Field -->
<div class="form-group">
<label for="mobile_no">Product</label>
@if(isset($orderProductExtraDetails->product_id))
{!! Form::select('product_id', [''=>'Select product'] + $product->toArray(), $orderProductExtraDetails->product_id, ['class' => 'form-control', 'id' =>'stateId']) !!}
@else
{!! Form::select('product_id', [''=>'Select product'] + $product->toArray(), null, ['class' => 'form-control', 'id' =>'stateId']) !!}
@endif
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Available Quantities Field -->
<div class="form-group">
    {!! Form::label('available_quantities', 'Available Quantities:') !!}
    {!! Form::text('available_quantities', null, ['class' => 'form-control']) !!}
</div>

<!-- Points Per Quantity Field -->
<div class="form-group">
    {!! Form::label('points_per_quantity', 'Points Per Quantity:') !!}
    {!! Form::text('points_per_quantity', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Per Quantity Field -->
<div class="form-group">
    {!! Form::label('price_per_quantity', 'Price Per Quantity:') !!}
    {!! Form::text('price_per_quantity', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<!-- <div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('orderProductExtraDetails.index') }}" class="btn btn-default">Cancel</a>
</div>

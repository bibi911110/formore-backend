<!-- Cat Id Field -->
<div class="form-group">
<label for="mobile_no">Category</label>
@if(isset($orderProducts->cat_id))
{!! Form::select('cat_id', [''=>'Select Category'] + $category->toArray(), $orderProducts->cat_id, ['class' => 'form-control', 'id' =>'stateId']) !!}
@else
{!! Form::select('cat_id', [''=>'Select Category'] + $category->toArray(), null, ['class' => 'form-control', 'id' =>'stateId']) !!}
@endif
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Product Img Field -->
<div class="form-group">
    {!! Form::label('product_img', 'Product Img:') !!}
    {!! Form::file('product_img') !!}
</div>
<?php if (isset($orderProducts->product_img)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$orderProducts->product_img; ?>" style="width: 9%"  >
     <input type="hidden" name="product_img" value="{{$orderProducts->product_img}}">
</div> 
<?php }?>

<!-- Ingredients Name Field -->
<div class="form-group">
    {!! Form::label('ingredients_name', 'Ingredients Name:') !!}
    {!! Form::text('ingredients_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Available Quantities Field -->
<div class="form-group">
    {!! Form::label('available_quantities', 'Available Quantities:') !!}
    {!! Form::text('available_quantities', null, ['class' => 'form-control','onkeypress'=>"return isNumberKey(event)"]) !!}
</div>

<!-- Price Per Quantity Field -->
<div class="form-group">
    {!! Form::label('price_per_quantity', 'Price Per Quantity:') !!}
    {!! Form::text('price_per_quantity', null, ['class' => 'form-control']) !!}
</div>

<!-- Points Per Quantity Field -->
<div class="form-group">
    {!! Form::label('points_per_quantity', 'Points Per Quantity:') !!}
    {!! Form::text('points_per_quantity', null, ['class' => 'form-control','onkeypress'=>"return isNumberKey(event)"]) !!}
</div>

<!-- Status Field -->


<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('orderProducts.index') }}" class="btn btn-default">Cancel</a>
</div>

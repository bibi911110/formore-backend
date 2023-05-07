<div class="form-group">
<label for="mobile_no">Category</label>
@if(isset($servicesProduct->cat_id))
{!! Form::select('cat_id', [''=>'Select Category'] + $category->toArray(), $servicesProduct->cat_id, ['class' => 'form-control', 'id' =>'stateId']) !!}
@else
{!! Form::select('cat_id', [''=>'Select Category'] + $category->toArray(), null, ['class' => 'form-control', 'id' =>'stateId']) !!}
@endif
</div>
<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Service/Product:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Service/ProductImg Field -->
<div class="form-group">
    {!! Form::label('product_img', 'Service/Product Img:') !!}
    {!! Form::file('product_img') !!}
</div>
<?php if (isset($servicesProduct->product_img)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$servicesProduct->product_img; ?>" style="width: 9%"  >
     <input type="hidden" name="product_img" value="{{$servicesProduct->product_img}}">
</div> 
<?php }?>

<!-- Price Per Slot Field -->
<div class="form-group">
    {!! Form::label('price_per_slot', 'Price Per Slot:') !!}
    {!! Form::text('price_per_slot', null, ['class' => 'form-control']) !!}
</div>

<!-- Point Per Slot Field -->
<div class="form-group">
    {!! Form::label('point_per_slot', 'Point Per Slot:') !!}
    {!! Form::text('point_per_slot', null, ['class' => 'form-control']) !!}
</div>

<!-- Created By Field -->
<!-- <div class="form-group">
    {!! Form::label('created_by', 'Created By:') !!}
    {!! Form::text('created_by', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Status Field -->
<!-- <div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('servicesProducts.index') }}" class="btn btn-default">Cancel</a>
</div>

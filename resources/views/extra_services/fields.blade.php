<div class="form-group">
<label for="mobile_no">Product</label>
@if(isset($extraServices->product_id))
{!! Form::select('product_id', [''=>'Select product'] + $product->toArray(), $extraServices->product_id, ['class' => 'form-control', 'id' =>'stateId']) !!}
@else
{!! Form::select('product_id', [''=>'Select product'] + $product->toArray(), null, ['class' => 'form-control', 'id' =>'stateId']) !!}
@endif
</div>
<!-- Services Name Field -->
<div class="form-group">
    {!! Form::label('services_name', 'Service/Product Name:') !!}
    {!! Form::text('services_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Services Per Price Field -->
<div class="form-group">
    {!! Form::label('services_per_price', 'Price per slot:') !!}
    {!! Form::text('services_per_price', null, ['class' => 'form-control']) !!}
</div>

<!-- Services Per Point Field -->
<div class="form-group">
    {!! Form::label('services_per_point', 'Point per slot:') !!}
    {!! Form::text('services_per_point', null, ['class' => 'form-control','onkeypress'=>"return isNumberKey(event)"]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('extraServices.index') }}" class="btn btn-default">Cancel</a>
</div>

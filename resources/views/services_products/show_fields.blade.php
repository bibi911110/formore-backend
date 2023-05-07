<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $servicesProduct->id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $servicesProduct->name }}</p>
</div>

<!-- Product Img Field -->
<div class="form-group">
    {!! Form::label('product_img', 'Product Img:') !!}
    <p>{{ $servicesProduct->product_img }}</p>
</div>

<!-- Price Per Slot Field -->
<div class="form-group">
    {!! Form::label('price_per_slot', 'Price Per Slot:') !!}
    <p>{{ $servicesProduct->price_per_slot }}</p>
</div>

<!-- Point Per Slot Field -->
<div class="form-group">
    {!! Form::label('point_per_slot', 'Point Per Slot:') !!}
    <p>{{ $servicesProduct->point_per_slot }}</p>
</div>

<!-- Created By Field -->
<div class="form-group">
    {!! Form::label('created_by', 'Created By:') !!}
    <p>{{ $servicesProduct->created_by }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $servicesProduct->status }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $servicesProduct->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $servicesProduct->updated_at }}</p>
</div>


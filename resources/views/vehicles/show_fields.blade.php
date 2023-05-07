<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $vehicle->id }}</p>
</div>

<!-- Vehicle Type Field -->
<div class="form-group">
    {!! Form::label('vehicle_type', 'Vehicle Type:') !!}
    <p>{{ $vehicle->vehicle_type }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $vehicle->status }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $vehicle->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $vehicle->updated_at }}</p>
</div>


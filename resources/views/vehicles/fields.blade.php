<!-- Vehicle Type Field -->
<div class="form-group">
    {!! Form::label('vehicle_type', 'Vehicle Type:') !!}
    {!! Form::text('vehicle_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<!-- <div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>
 -->
<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('vehicles.index') }}" class="btn btn-default">Cancel</a>
</div>

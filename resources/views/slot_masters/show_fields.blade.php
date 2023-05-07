<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $slotMaster->id }}</p>
</div>

<!-- Start Time Field -->
<div class="form-group">
    {!! Form::label('start_time', 'Start Time:') !!}
    <p>{{ $slotMaster->start_time }}</p>
</div>

<!-- End Time Field -->
<div class="form-group">
    {!! Form::label('end_time', 'End Time:') !!}
    <p>{{ $slotMaster->end_time }}</p>
</div>

<!-- Pepole Per Slot Field -->
<div class="form-group">
    {!! Form::label('pepole_per_slot', 'Pepole Per Slot:') !!}
    <p>{{ $slotMaster->pepole_per_slot }}</p>
</div>

<!-- Price Per Slot Field -->
<div class="form-group">
    {!! Form::label('price_per_slot', 'Price Per Slot:') !!}
    <p>{{ $slotMaster->price_per_slot }}</p>
</div>

<!-- Created By Field -->
<div class="form-group">
    {!! Form::label('created_by', 'Created By:') !!}
    <p>{{ $slotMaster->created_by }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $slotMaster->status }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $slotMaster->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $slotMaster->updated_at }}</p>
</div>


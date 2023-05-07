<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $bookedServices->id }}</p>
</div>

<!-- Member Name Field -->
<div class="form-group">
    {!! Form::label('member_name', 'Member Name:') !!}
    <p>{{ $bookedServices->member_name }}</p>
</div>

<!-- Member Id Field -->
<div class="form-group">
    {!! Form::label('member_id', 'Member Id:') !!}
    <p>{{ $bookedServices->member_id }}</p>
</div>

<!-- Service Name Field -->
<div class="form-group">
    {!! Form::label('service_name', 'Service Name:') !!}
    <p>{{ $bookedServices->service_name }}</p>
</div>

<!-- Booking Service Date Time Field -->
<div class="form-group">
    {!! Form::label('booking_service_date_time', 'Booking Service Date Time:') !!}
    <p>{{ $bookedServices->booking_service_date_time }}</p>
</div>

<!-- Comments Field -->
<div class="form-group">
    {!! Form::label('comments', 'Comments:') !!}
    <p>{{ $bookedServices->comments }}</p>
</div>

<!-- Advance Payment Field -->
<div class="form-group">
    {!! Form::label('advance_payment', 'Advance Payment:') !!}
    <p>{{ $bookedServices->advance_payment }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $bookedServices->status }}</p>
</div>

<!-- Created By Field -->
<div class="form-group">
    {!! Form::label('created_by', 'Created By:') !!}
    <p>{{ $bookedServices->created_by }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $bookedServices->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $bookedServices->updated_at }}</p>
</div>


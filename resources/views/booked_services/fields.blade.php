@if(isset($bookedServices->id))
<div class="form-group" id="campaign_cat" >
    {!! Form::label('status', 'Select Status:') !!}
    {!! Form::select('status', [''=>'Select Status','Open' => 'Open',"Confirm" => 'Confirm',"Reschedule" => 'Reschedule',"Cancel" =>'Cancel'], null, ['class' => 'form-control','id' => 'campaign_type']) !!}
</div>

@else

<!-- Member Name Field -->
<div class="form-group">
    {!! Form::label('member_name', 'Member Name:') !!}
    {!! Form::text('member_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Member Id Field -->
<div class="form-group">
    {!! Form::label('member_id', 'Member Id:') !!}
    {!! Form::text('member_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Service Name Field -->
<div class="form-group">
    {!! Form::label('service_name', 'Service Name:') !!}
    {!! Form::text('service_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Booking Service Date Time Field -->
<div class="form-group">
    {!! Form::label('booking_service_date_time', 'Booking Service Date Time:') !!}
    {!! Form::text('booking_service_date_time', null, ['class' => 'form-control']) !!}
</div>

<!-- Comments Field -->
<div class="form-group">
    {!! Form::label('comments', 'Comments:') !!}
    {!! Form::text('comments', null, ['class' => 'form-control']) !!}
</div>

<!-- Advance Payment Field -->
<div class="form-group">
    {!! Form::label('advance_payment', 'Advance Payment:') !!}
    {!! Form::text('advance_payment', null, ['class' => 'form-control']) !!}
</div>


@endif

<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('bookedServices.index') }}" class="btn btn-default">Cancel</a>
</div>
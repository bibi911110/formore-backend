@if(isset($memberOrders->id))
<div class="form-group" id="campaign_cat" >
    {!! Form::label('status', 'Select Status:') !!}
    {!! Form::select('status', [''=>'Select Status','Open' => 'Open',"Preparing order" => 'Preparing order',"For delivery" => 'For delivery',"Delivered" => 'Delivered',"Cancel" =>'Cancel'], null, ['class' => 'form-control','id' => 'campaign_type']) !!}
</div>

@else

<!-- Member Name Field -->
<div class="form-group  Member Orders">
    {!! Form::label('member_name', 'Member Name:') !!}
    {!! Form::text('member_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Member Id Field -->
<div class="form-group  Member Orders">
    {!! Form::label('member_id', 'Member Id:') !!}
    {!! Form::text('member_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Order Details Field -->
<div class="form-group  Member Orders">
    {!! Form::label('order_details', 'Order Details:') !!}
    {!! Form::text('order_details', null, ['class' => 'form-control']) !!}
</div>

<!-- Delivery Address Field -->
<div class="form-group  Member Orders">
    {!! Form::label('delivery_address', 'Delivery Address:') !!}
    {!! Form::text('delivery_address', null, ['class' => 'form-control']) !!}
</div>

<!-- Member Comments Field -->
<div class="form-group  Member Orders">
    {!! Form::label('member_comments', 'Member Comments:') !!}
    {!! Form::text('member_comments', null, ['class' => 'form-control']) !!}
</div>

<!-- Advance Payment Field -->
<div class="form-group  Member Orders">
    {!! Form::label('advance_payment', 'Advance Payment:') !!}
    {!! Form::text('advance_payment', null, ['class' => 'form-control']) !!}
</div>

<!-- Points Field -->
<div class="form-group  Member Orders">
    {!! Form::label('points', 'Points:') !!}
    {!! Form::text('points', null, ['class' => 'form-control']) !!}
</div>

<!-- Cash Field -->
<div class="form-group  Member Orders">
    {!! Form::label('cash', 'Cash:') !!}
    {!! Form::text('cash', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group  Member Orders">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>
@endif

<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('memberOrders.index') }}" class="btn btn-default">Cancel</a>
</div>

<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $couponMasterOrder->id }}</p>
</div>

<!-- Coupon Code Field -->
<div class="form-group">
    {!! Form::label('coupon_code', 'Coupon Code:') !!}
    <p>{{ $couponMasterOrder->coupon_code }}</p>
</div>

<!-- Start Date Field -->
<div class="form-group">
    {!! Form::label('start_date', 'Start Date:') !!}
    <p>{{ $couponMasterOrder->start_date }}</p>
</div>

<!-- End Date Field -->
<div class="form-group">
    {!! Form::label('end_date', 'End Date:') !!}
    <p>{{ $couponMasterOrder->end_date }}</p>
</div>

<!-- Amount Type Field -->
<div class="form-group">
    {!! Form::label('amount_type', 'Amount Type:') !!}
    <p>{{ $couponMasterOrder->amount_type }}</p>
</div>

<!-- Amount Field -->
<div class="form-group">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{{ $couponMasterOrder->amount }}</p>
</div>

<!-- Amount Discount Field -->
<div class="form-group">
    {!! Form::label('amount_discount', 'Amount Discount:') !!}
    <p>{{ $couponMasterOrder->amount_discount }}</p>
</div>

<!-- Points Discount Field -->
<div class="form-group">
    {!! Form::label('points_discount', 'Points Discount:') !!}
    <p>{{ $couponMasterOrder->points_discount }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $couponMasterOrder->status }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $couponMasterOrder->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $couponMasterOrder->updated_at }}</p>
</div>


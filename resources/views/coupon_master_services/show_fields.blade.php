<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $couponMasterServices->id }}</p>
</div>

<!-- Coupon Code Field -->
<div class="form-group">
    {!! Form::label('coupon_code', 'Coupon Code:') !!}
    <p>{{ $couponMasterServices->coupon_code }}</p>
</div>

<!-- Start Date Field -->
<div class="form-group">
    {!! Form::label('start_date', 'Start Date:') !!}
    <p>{{ $couponMasterServices->start_date }}</p>
</div>

<!-- End Date Field -->
<div class="form-group">
    {!! Form::label('end_date', 'End Date:') !!}
    <p>{{ $couponMasterServices->end_date }}</p>
</div>

<!-- Amount Type Field -->
<div class="form-group">
    {!! Form::label('amount_type', 'Amount Type:') !!}
    <p>{{ $couponMasterServices->amount_type }}</p>
</div>

<!-- Amount Field -->
<div class="form-group">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{{ $couponMasterServices->amount }}</p>
</div>

<!-- Amount Discount Field -->
<div class="form-group">
    {!! Form::label('amount_discount', 'Amount Discount:') !!}
    <p>{{ $couponMasterServices->amount_discount }}</p>
</div>

<!-- Points Discount Field -->
<div class="form-group">
    {!! Form::label('points_discount', 'Points Discount:') !!}
    <p>{{ $couponMasterServices->points_discount }}</p>
</div>

<!-- Coupon Info Field -->
<div class="form-group">
    {!! Form::label('coupon_info', 'Coupon Info:') !!}
    <p>{{ $couponMasterServices->coupon_info }}</p>
</div>

<!-- Created By Field -->
<div class="form-group">
    {!! Form::label('created_by', 'Created By:') !!}
    <p>{{ $couponMasterServices->created_by }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $couponMasterServices->status }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $couponMasterServices->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $couponMasterServices->updated_at }}</p>
</div>


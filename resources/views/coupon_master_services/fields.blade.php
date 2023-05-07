<!-- Coupon Code Field -->
<div class="form-group">
    {!! Form::label('coupon_code', 'Coupon Code:') !!}
    {!! Form::text('coupon_code', null, ['class' => 'form-control']) !!}
</div>

 <!-- Start Date Field -->
    <div class="form-group">
        {!! Form::label('start_date', 'Start Date:') !!}
        @if(isset($couponMasterServices->start_date))
        {!! Form::text('start_date', date('Y-m-d',strtotime($couponMasterServices->start_date)), ['class' => 'form-control input-datepicker','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
        @else
            {!! Form::text('start_date', null, ['class' => 'form-control input-datepicker22','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
        @endif
    </div>
    

    <!-- End Date Field -->
    <div class="form-group">
        {!! Form::label('end_date', 'End Date:') !!}
        @if(isset($couponMasterServices->end_date))
        {!! Form::text('end_date', date('Y-m-d',strtotime($couponMasterServices->end_date)), ['class' => 'form-control input-datepickerStart','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
        @else
            {!! Form::text('end_date', null, ['class' => 'form-control input-datepickerStart','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
        @endif
    </div>
<!-- Amount Type Field -->
<div class="form-group" id="optionId">
    {!! Form::label('amount_type', 'Type:') !!}
    
    @if(isset($couponMasterServices->amount_type))
    {!! Form::select('amount_type', [''=>'Select Type','Percentage' => 'Percentage',"Amount" => 'Amount',"Points" => 'Points'], $couponMasterServices->amount_type, ['class' => 'form-control','id' => 'entry_option']) !!}
     @else
       {!! Form::select('amount_type', [''=>'Select Type','Percentage' => 'Percentage',"Amount" => 'Amount',"Points" => 'Points'], null, ['class' => 'form-control','id' => 'entry_option']) !!}
        @endif
</div>

<!-- Amount Field -->
<div class="form-group">
    {!! Form::label('amount', 'Value:') !!}
    {!! Form::text('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Discount Field -->
<div class="form-group">
    {!! Form::label('amount_discount', 'Maximum Discount(Amount):') !!}
    {!! Form::text('amount_discount', null, ['class' => 'form-control']) !!}
</div>

<!-- Points Discount Field -->
<div class="form-group">
    {!! Form::label('points_discount', 'Maximum Discount(Points):') !!}
    {!! Form::text('points_discount', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('coupon_info', 'Coupon Info:') !!}
    {!! Form::textarea('coupon_info', null, ['class' => 'form-control','rows'=>'3']) !!}
</div>
<!-- Status Field -->
<!-- <div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('couponMasterServices.index') }}" class="btn btn-default">Cancel</a>
</div>

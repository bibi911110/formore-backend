<?php  // echo $purchaseOptions->v_code; exit; ?>
@if(isset($purchaseOptions))
<div class="form-group">
{!! Form::label('v_code', 'Voucher Code:') !!}<span style="color:red">*</span>
<select class="form-control sub-category" name="v_code[]" multiple="" id="" >
    <?php foreach ($voucher as $voucherval) {
         $v_code = explode(',', $purchaseOptions->v_code);
         
         if(in_array($voucherval['code'],$v_code)){
         ?>
            <option value="<?php echo $voucherval['code']; ?>" selected="selected"><?php echo $voucherval['code']; ?></option>
        <?php } else { ?>
            <option value="<?php echo $voucherval['code']; ?>"><?php echo $voucherval['code']; ?></option>
        <?php } } ?>
</select>
</div>
@else
<div class="form-group"><span style="color:red">*</span>
    {!! Form::label('v_code', 'Voucher Code:') !!}
    {!! Form::select('v_code[]', [''=>'Select Voucher Code'] + $voucher->toArray(), null, ['class' => 'form-control','multiple']) !!}
</div>
@endif

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}<span style="color:red">*</span>
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Available Field -->
<div class="form-group">
    {!! Form::label('available', 'Text info:') !!}
    {!! Form::text('available', null, ['class' => 'form-control']) !!}
</div>

<!-- Points Field -->
<div class="form-group">
    {!! Form::label('points', 'Points:') !!}<span style="color:red">*</span>
    {!! Form::text('points', null, ['class' => 'form-control']) !!}
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
    <a href="{{ route('purchaseOptions.index') }}" class="btn btn-default">Cancel</a>
</div>


<!-- Business Id Field -->
<div class="form-group">
    {!! Form::label('business_id', 'Business Name:') !!}
    {!! Form::select('business_id', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
</div>

@if(isset($stampMaster->id))
<?php $sg_data = \App\Models\Nfc_code::where('stamp_id',$stampMaster->id)->get();
        //echo "<pre>"; print_r($stampMaster->id); exit;
     
    
    foreach ($sg_data as $key =>  $sgp_data) { ?>
    <div class="row itemClass" id="item_<?php echo $key + 1; ?>">
        <div class="col-md-4">
             <div class="form-group">
                {!! Form::label('nfc_code', 'NFC Code:') !!}
                {!! Form::text('nfc_code[]',  $sgp_data->nfc_code, ['class' => 'form-control']) !!}
            </div>
        </div>
        
        <div class="col-md-2" style="margin-top: 20px;">
        <div class="input-group-btn">
         <button class="btn btn-danger remove_item" data-item-id="item_<?php echo $key + 1; ?>" type="button"><i class="fa fa-minus"></i> </button>
        <button class="btn btn-success add_item" data-item-id="item_<?php echo $key + 1; ?>" type="button"><i class="fa fa-plus"></i></button>
      </div>
  </div>
    </div>
<?php } ?>
@else
<div class="row itemClass" id="item_1">
    <div class="col-md-4">
         <div class="form-group">
            {!! Form::label('nfc_code', 'NFC Code:') !!}
            {!! Form::text('nfc_code[]', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    
    <div class="col-md-2" style="margin-top: 20px;">
        <div class="input-group-btn">
         <button class="btn btn-danger remove_item" data-item-id="item_1" type="button"><i class="fa fa-minus"></i> </button>
        <button class="btn btn-success add_item" data-item-id="item_1" type="button"><i class="fa fa-plus"></i></button>
      </div>
  </div>
</div>
@endif
<!-- Country Id Field -->
<?php  $Gift_vocher_types  = \App\Models\Gift_vocher_types::where('status','1')->pluck('name','id'); ?>
<div class="form-group">
    {!! Form::label('transaction_type', 'Transaction type:') !!}
    {!! Form::select('transaction_type', [''=>'Select Transaction type'] + $Gift_vocher_types->toArray(), null, ['class' => 'form-control']) !!}
</div>
@if(isset($stampMaster->country_id))
<div class="form-group">
    {!! Form::label('country_id', 'Country:') !!}
    {!! Form::select('country_id', [''=>'Select Country'] + $country_data->toArray(), $stampMaster->country_id, ['class' => 'form-control']) !!}
</div>
@else
<div class="form-group">
    {!! Form::label('country_id', 'Country:') !!}
    {!! Form::select('country_id', [''=>'Select Country'] + $country_data->toArray(), null, ['class' => 'form-control']) !!}
</div>
@endif
<!-- Currency Field -->
<!-- <div class="form-group">
    {!! Form::label('currency', 'Currency:') !!}
    {!! Form::select('currency', [''=>'Select Currency'] + $currency_data->toArray(), null, ['class' => 'form-control']) !!}
</div> -->


<!-- Stapm Point Field -->
<!-- <div class="form-group">
    {!! Form::label('stapm_point', 'Select Type:') !!}
    {!! Form::select('stapm_point', [''=>'Select Type','1' => 'Stapm',"2" => 'Points'], null, ['class' => 'form-control','id' => 'stapm_point']) !!}
</div> -->

<!-- stamp fileds start -->
<!-- <div id="stamp_filed" style="display: none;"> -->
<!-- Image Of Loyalty Card Field -->
<div class="form-group">
    {!! Form::label('image_of_loyalty_card', 'Upload the image of the loyalty card:') !!}
    {!! Form::file('image_of_loyalty_card') !!}
</div>
<?php if (isset($stampMaster->image_of_loyalty_card)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$stampMaster->image_of_loyalty_card; ?>" style="width: 9%"  >
     <input type="hidden" name="image_of_loyalty_card" value="{{$stampMaster->image_of_loyalty_card}}">
</div> 
<?php }?>

<div class="form-group">
    {!! Form::label('color', 'Color:') !!}
    {!! Form::color('color', null, ['class' => 'form-control']) !!} 
</div>
<div class="form-group">
    {!! Form::label('font_size', 'Font Size:') !!}
    {!! Form::text('font_size', null, ['class' => 'form-control']) !!} 
</div>


<!-- Setup Level Field -->
<div class="form-group">
    {!! Form::label('setup_level', 'Set up level :') !!}
    {!! Form::text('setup_level', null, ['class' => 'form-control','onkeypress'=>"return isNumberKey(event)"]) !!}
</div>

<!-- Daily Limit Field -->
<div class="form-group">
    {!! Form::label('welcome_stamp', 'Daily limit for each member:') !!}
    {!! Form::text('daily_limit', null, ['class' => 'form-control','onkeypress'=>"return isNumberKey(event)"]) !!} 
</div>

<!-- Welcome Stamp Field -->
<div class="form-group">
    {!! Form::label('welcome_stamp', 'Welcome Stamp:') !!}
    @if(isset($stampMaster->welcome_stamp))
    <label class="radio-inline" for="welcome_stamp_yes"><input id="welcome_stamp_yes" type="radio" name="welcome_stamp" value="1" <?php echo ($stampMaster->welcome_stamp == '1') ?  "checked" : "" ;  ?>> Yes</label>
    <label class="radio-inline" for="welcome_stamp_no"><input id="welcome_stamp_no" type="radio" name="welcome_stamp" value="0" <?php echo ($stampMaster->welcome_stamp == '0') ?  "checked" : "" ;  ?>> No</label>
    @else
    <label class="radio-inline" for="welcome_stamp_yes"><input id="welcome_stamp_yes" type="radio" name="welcome_stamp" value="1" > Yes</label>
    <label class="radio-inline" for="welcome_stamp_no"><input id="welcome_stamp_no" type="radio" name="welcome_stamp" value="0" checked> No</label>
    @endif
    <!-- {!! Form::text('welcome_stamp', null, ['class' => 'form-control']) !!} -->
</div>

<!-- Birthday Step Field -->
<div class="form-group">
    {!! Form::label('birthday_step', 'Birthday Stamp:') !!}
   @if(isset($stampMaster->birthday_step))
    <label class="radio-inline" for="birthday_step_yes"><input id="birthday_step_yes" type="radio" name="birthday_step" value="1" <?php echo ($stampMaster->birthday_step == '1') ?  "checked" : "" ;  ?>> Yes</label>
    <label class="radio-inline" for="birthday_step_no"><input id="birthday_step_no" type="radio" name="birthday_step" value="0" <?php echo ($stampMaster->birthday_step == '0') ?  "checked" : "" ;  ?>> No</label>
    @else
    <label class="radio-inline" for="birthday_step_yes"><input id="birthday_step_yes" type="radio" name="birthday_step" value="1" > Yes</label>
    <label class="radio-inline" for="birthday_step_no"><input id="birthday_step_no" type="radio" name="birthday_step" value="0" checked> No</label>
    @endif
</div>

<!-- Bonus Stamp Field -->
<div class="form-group">
    {!! Form::label('bonus_stamp', 'Bonus Stamp:') !!}
     @if(isset($stampMaster->bonus_stamp))
    <label class="radio-inline" for="bonus_stamp_yes"><input id="bonus_stamp_yes" type="radio" name="bonus_stamp" value="1" <?php echo ($stampMaster->bonus_stamp == '1') ?  "checked" : "" ;  ?>> Yes</label>
    <label class="radio-inline" for="bonus_stamp_no"><input id="bonus_stamp_no" type="radio" name="bonus_stamp" value="0" <?php echo ($stampMaster->bonus_stamp == '0') ?  "checked" : "" ;  ?>> No</label>
    @else
    <label class="radio-inline" for="bonus_stamp_yes"><input id="bonus_stamp_yes" type="radio" name="bonus_stamp" value="1" > Yes</label>
    <label class="radio-inline" for="bonus_stamp_no"><input id="bonus_stamp_no" type="radio" name="bonus_stamp" value="0" checked> No</label>
    @endif
</div>

<!-- Stapm Expired Field -->
<div class="form-group">
    {!! Form::label('stapm_expired', 'Expiration Date of stamps:') !!}
    @if(isset($stampMaster->stapm_expired))
    {!! Form::text('stapm_expired', date('Y-m-d',strtotime($stampMaster->stapm_expired)), ['class' => 'form-control expiration_date','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
    @else
        {!! Form::text('stapm_expired', null, ['class' => 'form-control expiration_date','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
    @endif
</div>


<!-- Point Per Stamp Field -->
<div class="form-group">
    {!! Form::label('point_per_stamp', 'Points collection per stamp:') !!}
    {!! Form::text('point_per_stamp', null, ['class' => 'form-control','onkeypress'=>"return isNumberKey(event)"]) !!}
</div>



<!-- Ration Of Cash Out Field -->
<div class="form-group">
    {!! Form::label('ration_of_cash_out', 'Ratio for cash out (points):') !!}
    {!! Form::text('ration_of_cash_out', null, ['class' => 'form-control','onkeypress'=>"return isNumberKey(event)"]) !!}
</div>

<!-- Message Eng Field -->
<div class="form-group">
    {!! Form::label('message_eng', 'Message Eng:') !!}
    {!! Form::text('message_eng', null, ['class' => 'form-control']) !!}
</div>

<!-- Message Italian Field -->
<div class="form-group">
    {!! Form::label('message_italian', 'Message Italian:') !!}
    {!! Form::text('message_italian', null, ['class' => 'form-control']) !!}
</div>

<!-- Message Greek Field -->
<div class="form-group">
    {!! Form::label('message_greek', 'Message Greek:') !!}
    {!! Form::text('message_greek', null, ['class' => 'form-control']) !!}
</div>

<!-- Message Albanian Field -->
<div class="form-group">
    {!! Form::label('message_albanian', 'Message Albanian:') !!}
    {!! Form::text('message_albanian', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('stampMasters.index') }}" class="btn btn-default">Cancel</a>
</div>


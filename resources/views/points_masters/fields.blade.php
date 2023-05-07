<!-- Business Id Field -->
<div class="form-group">
    {!! Form::label('business_id', 'Business Name:') !!}
    {!! Form::select('business_id', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
</div>

<!-- Country Id Field -->
<div class="form-group">
    {!! Form::label('country_id', 'Country:') !!}
    {!! Form::select('country_id', [''=>'Select Country'] + $country_data->toArray(), null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('image_of_loyalty_card', 'Upload the image of the loyalty card:') !!}
    {!! Form::file('image_of_loyalty_card') !!}
</div>
<?php if (isset($pointsMaster->image_of_loyalty_card)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$pointsMaster->image_of_loyalty_card; ?>" style="width: 9%"  >
     <input type="hidden" name="image_of_loyalty_card" value="{{$pointsMaster->image_of_loyalty_card}}">
</div> 
<?php }?>

<div class="form-group">
    {!! Form::label('color', 'Select Color:') !!}
    {!! Form::color('color', null, ['class' => 'form-control']) !!} 
</div>
<div class="form-group">
    {!! Form::label('font_size', 'Font Size:') !!}
    {!! Form::text('font_size', null, ['class' => 'form-control']) !!} 
</div>
  <!-- Schema Field -->
<div class="form-group">
    {!! Form::label('schema', 'Select Schema:') !!}
    {!! Form::select('schema', [''=>'Select Schema','1' => 'Have to win direct',"2" => 'Win and continue for next level',"3" => 'Option if you want to take the voucher (and restart the counter) or continue for next level'], null, ['class' => 'form-control','id' => 'schema']) !!}
</div>

<div class="form-group col-md-12" id="win_direct_point" style="display:none;">
        {!! Form::label('win_direct_point', 'Win Direct Point:') !!}
        {!! Form::text('win_direct_point', null, ['class' => 'form-control','onkeypress'=>"return isNumberKey(event)"]) !!}
</div>

<div id="Scenarios" style="display:none;">
<!-- Levels Based On Scenarios Field -->
<div class="form-group" id=''>
    {!! Form::label('levels_based_on_scenarios', 'Levels Based On Scenarios:') !!}
    <!-- {!! Form::text('levels_based_on_scenarios', null, ['class' => 'form-control']) !!} -->
      {!! Form::select('levels_based_on_scenarios', [''=>'Select Schema',"0" => '0','1' => '1',"2" => '2',"3" => '3',"4" => '4'], null, ['class' => 'form-control','id' => 'levels_based']) !!}
</div>

<div class="row">
    <div class="form-group col-md-2" id="levels_0" style="display:none;">
        {!! Form::label('levels_based_amount_0', 'Levels 0 Based Amount:') !!}
        {!! Form::text('levels_based_amount_0', null, ['class' => 'form-control','onkeypress'=>"return isNumberKey(event)"]) !!}
    </div>
    <div class="form-group col-md-2" id="levels_1" style="display:none;">
        {!! Form::label('levels_based_amount_1', 'Levels 1 Based Amount:') !!}
        {!! Form::text('levels_based_amount_1', null, ['class' => 'form-control','onkeypress'=>"return isNumberKey(event)"]) !!}
    </div>
    <div class="form-group col-md-2" id="levels_2" style="display:none;">
        {!! Form::label('levels_based_amount_2', 'Levels 2 Based Amount:') !!}
        {!! Form::text('levels_based_amount_2', null, ['class' => 'form-control','onkeypress'=>"return isNumberKey(event)"]) !!}
    </div>
    <div class="form-group col-md-2" id="levels_3" style="display:none;">
        {!! Form::label('levels_based_amount_3', 'Levels 3 Based Amount:') !!}
        {!! Form::text('levels_based_amount_3', null, ['class' => 'form-control','onkeypress'=>"return isNumberKey(event)"]) !!}
    </div>
    <div class="form-group col-md-2" id="levels_4" style="display:none;">
        {!! Form::label('levels_based_amount_4', 'Levels 4 Based Amount:') !!}
        {!! Form::text('levels_based_amount_4', null, ['class' => 'form-control','onkeypress'=>"return isNumberKey(event)"]) !!}
    </div>
</div>
</div>

<!--  <div class="form-group">
    {!! Form::label('currency_id', 'Currency:') !!}
    {!! Form::select('currency_id', [''=>'Select Currency'] + $currency_data->toArray(), null, ['class' => 'form-control']) !!}
</div> -->
<!-- Ratio Of Collecting Points Field -->
<div class="form-group">
    {!! Form::label('ratio_of_collecting_points', 'Ratio Of Collecting Points:') !!}
    {!! Form::text('ratio_of_collecting_points', null, ['class' => 'form-control','onkeypress'=>"return isNumberKey(event)"]) !!}
</div>

<!-- Ratio For Cash Out Field -->
<div class="form-group">
    {!! Form::label('ratio_for_cash_out', 'Ratio For Cash Out:') !!}
    {!! Form::text('ratio_for_cash_out', null, ['class' => 'form-control','onkeypress'=>"return isNumberKey(event)"]) !!}
</div>

@if(isset($pointsMaster->id))
<?php $sg_data = \App\Models\Points_segment::where('point_id',  $pointsMaster->id)->get();
         foreach ($sg_data as $key =>  $sgp_data) { ?>

<div class="row itemClass" id="item_<?php echo $key + 1; ?>">
    <div class="col-md-3">
         <div class="form-group">
            {!! Form::label('segments_id', 'Segment Name:') !!}
            {!! Form::select('segments_id[]', [''=>'Select Segment'] + $segment_data->toArray(), $sgp_data->segments_id, ['class' => 'form-control']) !!}
        </div>
    </div>
<!-- <div class="col-md-3">
    <div class="form-group" id=''>
        {!! Form::label('segments_based_on_scenarios', 'Segment Based On Scenarios:') !!}
        {!! Form::select('segments_based_on_scenarios[]', [''=>'Select Schema',"0" => '0','1' => '1',"2" => '2',"3" => '3',"4" => '4'], null, ['class' => 'form-control','id' => 'segments_based_on_scenarios']) !!}
    </div>
</div> -->
<div class="col-md-3">
    <div class="form-group" id=''>
        {!! Form::label('segments_based_on_scenarios', 'Segment Based On Scenarios:') !!}
        <select class="form-control" name="segments_based_on_scenarios[]" >
            <option value=""> Select Segment Based On Scenarios</option>
            <option value="0" <?php if($sgp_data->segments_based_on_scenarios == 0){ echo "selected" ;} ?>>0</option>
            <option value="1" <?php if($sgp_data->segments_based_on_scenarios == 1){ echo "selected" ;} ?>>1</option>
            <option value="2" <?php if($sgp_data->segments_based_on_scenarios == 2){ echo "selected" ;} ?>>2</option>
            <option value="3" <?php if($sgp_data->segments_based_on_scenarios == 3){ echo "selected" ;} ?>>3</option>
            <option value="4" <?php if($sgp_data->segments_based_on_scenarios == 4){ echo "selected" ;} ?>>4</option>
        </select>
    </div>
</div>
   
  <div class="col-md-3">
          <div class="form-group">
            <label for="amount">Amount</label>
            {!! Form::text('amount[]', $sgp_data->amount, ['class' => 'form-control','onkeypress'=>"return isNumberKey(event)"]) !!}
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
    <div class="col-md-3">
         <div class="form-group">
            {!! Form::label('segments_id', 'Segment Name:') !!}
            {!! Form::select('segments_id[]', [''=>'Select Segment'] + $segment_data->toArray(), null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('segments_based_on_scenarios', 'Segment Based On Scenarios:') !!}
            {!! Form::select('segments_based_on_scenarios[]', [''=>'Select Schema',"0" => '0','1' => '1',"2" => '2',"3" => '3',"4" => '4'], null, ['class' => 'form-control']) !!}
        </div>
    </div>
<div class="col-md-3">
          <div class="form-group">
            <label for="amount">Amount</label>
            {!! Form::text('amount[]', null, ['class' => 'form-control','onkeypress'=>"return isNumberKey(event)"]) !!}
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





<!-- Birthday Field -->
<div class="form-group">
    {!! Form::label('birthday', 'Birthday:') !!}
    @if(isset($pointsMaster->birthday))
    <label class="radio-inline" for="birthday_yes"><input id="birthday_yes" class="bir" type="radio" name="birthday" value="1" <?php echo ($pointsMaster->birthday == '1') ?  "checked" : "" ;  ?>> Yes</label>
    <label class="radio-inline" for="birthday_yes"><input id="birthday_yes" class="bir_no" type="radio" name="birthday" value="0" <?php echo ($pointsMaster->birthday == '0') ?  "checked" : "" ;  ?>> No</label>
    @else
    <label class="radio-inline" for="birthday_yes"><input id="birthday_yes" type="radio" name="birthday" value="1" > Yes</label>
    <label class="radio-inline" for="birthday_yes"><input id="birthday_no" type="radio" name="birthday" value="0" checked> No</label>
    @endif

</div>

<div id='birthday_data' style="display: none;">
    <div class="form-group">
    {!! Form::label('birth_point', 'Enter Points:') !!}
    {!! Form::text('birth_point', null, ['class' => 'form-control','onkeypress'=>"return isNumberKey(event)"]) !!}
</div>

@if(isset($pointsMaster->birth_segments_id))
 @php
    $birth_segments_id = [];
@endphp
@if(isset($pointsMaster) && !empty($pointsMaster->birth_segments_id))
    @php
        $birth_segments_id = explode(',', $pointsMaster->birth_segments_id);
    @endphp
    @endif
     <div class="form-group">
    {!! Form::label('birth_segments_id', 'Segment Name:') !!}<button type="button" id="select_all" class="btn btn-primary" value="Select All">Select All</button>
    <select name="birth_segments_id[]" id="example-chosen-multiple" class="form-control" multiple >
      <option value="" hidden>Select Days</option>
    <?php  $c_segment_data = \App\Models\Segment::where('status','1')->select('segment_name','id')->get(); 
        foreach ($c_segment_data as $key => $value) {
            
    ?>
        <option value="<?php echo $value->id; ?>" <?php if(in_array($value->id, $birth_segments_id)) { echo 'selected';} ?>><?php echo $value->segment_name; ?></option>
    <?php } ?>
    </select>
   
</div>
@else
 <div class="form-group">
    {!! Form::label('birth_segments_id', 'Segment Name:') !!}<button type="button" id="select_all" class="btn btn-primary" value="Select All">Select All</button>
    {!! Form::select('birth_segments_id[]',$segment_data->toArray(), null,  ['class' => 'form-control ','id' =>'example-chosen-multiple','multiple','data-placeholder'=>'Select Segment']) !!}
</div>
@endif

</div>

<!-- Welcome Field -->
<div class="form-group">
    {!! Form::label('welcome', 'Welcome:') !!}
    @if(isset($pointsMaster->welcome))
    <label class="radio-inline" for="welcome_yes"><input id="welcome_yes" class="welcome_y" type="radio" name="welcome" value="1" <?php echo ($pointsMaster->welcome == '1') ?  "checked" : "" ;  ?>> Yes</label>
    <label class="radio-inline" for="welcome_no"><input id="welcome_yes" type="radio" name="welcome" value="0" <?php echo ($pointsMaster->welcome == '0') ?  "checked" : "" ;  ?>> No</label>
    @else
    <label class="radio-inline" for="welcome_yes"><input id="welcome_yes" type="radio" name="welcome" value="1" > Yes</label>
    <label class="radio-inline" for="welcome_no"><input id="welcome_yes" type="radio" name="welcome" value="0" checked> No</label>
    @endif

</div>

<div id='welcome_data' style="display: none;">
    <div class="form-group">
    {!! Form::label('welcome_point', 'Enter Points:') !!}
    {!! Form::text('welcome_point', null, ['class' => 'form-control','onkeypress'=>"return isNumberKey(event)"]) !!}
</div>

@if(isset($pointsMaster->welcome_segments_id))
 @php
    $welcome_segments_id = [];
@endphp
@if(isset($pointsMaster) && !empty($pointsMaster->welcome_segments_id))
    @php
        $welcome_segments_id = explode(',', $pointsMaster->welcome_segments_id);
    @endphp
    @endif
     <div class="form-group">
    {!! Form::label('welcome_segments_id', 'Segment Name:') !!}<button type="button" id="select_all_welcome" class="btn btn-primary" value="Select All">Select All</button>
    <select name="welcome_segments_id[]" id="example-chosen-multiple-w" class="form-control" multiple >
      <option value="" hidden>Select Days</option>
    <?php  $c_segment_data = \App\Models\Segment::where('status','1')->select('segment_name','id')->get(); 
        foreach ($c_segment_data as $key => $value) {
            
    ?>
        <option value="<?php echo $value->id; ?>" <?php if(in_array($value->id, $welcome_segments_id)) { echo 'selected';} ?>><?php echo $value->segment_name; ?></option>
    <?php } ?>
    </select>
   
</div>
@else
 <div class="form-group">
    {!! Form::label('welcome_segments_id', 'Segment Name:') !!}<button type="button" id="select_all_welcome" class="btn btn-primary" value="Select All">Select All</button>
    {!! Form::select('welcome_segments_id[]',$segment_data->toArray(), null,  ['class' => 'form-control ','id' =>'example-chosen-multiple-w','multiple','data-placeholder'=>'Select Segment']) !!}
</div>
@endif

</div>



<!-- Fraud Of Points Field -->
<div class="form-group">
    {!! Form::label('transactions_means', 'Transactions(maximum transactions per member):') !!}
    {!! Form::text('transactions_means', null, ['class' => 'form-control','onkeypress'=>"return isNumberKey(event)"]) !!}
</div>

<div class="form-group">
    {!! Form::label('duration', 'Duration(1 transaction in a day):') !!}
    {!! Form::text('duration', null, ['class' => 'form-control','onkeypress'=>"return isNumberKey(event)"]) !!}
</div>

<div class="form-group">
    {!! Form::label('points_limits', 'Points limits(per day per member):') !!}
    {!! Form::text('points_limits', null, ['class' => 'form-control','onkeypress'=>"return isNumberKey(event)"]) !!}
</div>


<!-- Campaign Field -->
<div class="form-group">
    {!! Form::label('campaign', 'Campaign:') !!}
    @if(isset($pointsMaster->campaign))
    <label class="radio-inline" for="campaign_yes"><input id="campaign_yes" type="radio" class="campaign_y" name="campaign" value="1" <?php echo ($pointsMaster->campaign == '1') ?  "checked" : "" ;  ?>> Yes</label>
    <label class="radio-inline" for="campaign_no"><input id="campaign_no" type="radio" name="campaign" value="0" <?php echo ($pointsMaster->campaign == '0') ?  "checked" : "" ;  ?>> No</label>
    @else
    <label class="radio-inline" for="campaign_yes"><input id="campaign_yes" type="radio" name="campaign" value="1" > Yes</label>
    <label class="radio-inline" for="campaign_no"><input id="campaign_no" type="radio" name="campaign" value="0" checked> No</label>
    @endif
</div>

<div id='show_cap' style="display: none;">
<div class="form-group">
    {!! Form::label('start_date', 'Start Date:') !!}
    @if(isset($pointsMaster->start_date))
    {!! Form::text('start_date', date('Y-m-d',strtotime($pointsMaster->start_date)), ['class' => 'form-control point_start_date','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
    @else
        {!! Form::text('start_date', null, ['class' => 'form-control point_start_date','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
    @endif
</div>
<div class="form-group">
    {!! Form::label('end_date', 'End Date:') !!}
    @if(isset($pointsMaster->end_date))
    {!! Form::text('end_date', date('Y-m-d',strtotime($pointsMaster->end_date)), ['class' => 'form-control point_end_date','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
    @else
        {!! Form::text('end_date', null, ['class' => 'form-control point_end_date','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
    @endif
</div>

<div class="form-group">
    {!! Form::label('amount_type', 'Select Amount Type:') !!}
    {!! Form::select('amount_type', [''=>'Select Amount Type','1' => 'Percentage',"2" => 'Amount'], null, ['class' => 'form-control','id' => 'amount_type']) !!}
</div>
<div class="form-group" id='show_pr' style="display:none;">
    {!! Form::label('c_percentage', 'Percentage') !!}
    {!! Form::text('c_percentage', null, ['class' => 'form-control','onkeypress'=>"return isNumberKey(event)"]) !!}
</div>
<div class="form-group" id='show_amount' style="display:none;">
    {!! Form::label('c_amount', 'Amount') !!}
    {!! Form::text('c_amount', null, ['class' => 'form-control','onkeypress'=>"return isNumberKey(event)"]) !!}
</div>

@if(isset($pointsMaster->c_segments_id))
 @php
    $c_segments_id = [];
@endphp
@if(isset($pointsMaster) && !empty($pointsMaster->c_segments_id))
    @php
        $c_segments_id = explode(',', $pointsMaster->c_segments_id);
    @endphp
    @endif
     <div class="form-group">
    {!! Form::label('c_segments_id', 'Segment Name:') !!}<button type="button" id="select_all_c" class="btn btn-primary" value="Select All">Select All</button>
    <select name="c_segments_id[]" id="example-chosen-multiple-c" class="form-control" multiple >
      <option value="" hidden>Select Days</option>
    <?php  $c_segment_data = \App\Models\Segment::where('status','1')->select('segment_name','id')->get(); 
        foreach ($c_segment_data as $key => $value) {
            
    ?>
        <option value="<?php echo $value->id; ?>" <?php if(in_array($value->id, $c_segments_id)) { echo 'selected';} ?>><?php echo $value->segment_name; ?></option>
    <?php } ?>
    </select>
   
</div>
@else
 <div class="form-group">
    {!! Form::label('c_segments_id', 'Segment Name:') !!}<button type="button" id="select_all_c" class="btn btn-primary" value="Select All">Select All</button>
    {!! Form::select('c_segments_id[]',$segment_data->toArray(), null,  ['class' => 'form-control','id' =>'example-chosen-multiple-c','multiple','data-placeholder'=>'Select Segment']) !!}
</div>
@endif

</div>




<!-- Expiration Date Field -->
<div class="form-group">
   {!! Form::label('expiration_date', 'Expiration Date:') !!}
    @if(isset($pointsMaster->expiration_date))
    {!! Form::text('expiration_date', date('Y-m-d',strtotime($pointsMaster->expiration_date)), ['class' => 'form-control expiration_date','id'=>'example-datepicker-e','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
    @else
        {!! Form::text('expiration_date', null, ['class' => 'form-control expiration_date','id'=>'example-datepicker-e','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
    @endif
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

<!-- Submit Field -->
<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('pointsMasters.index') }}" class="btn btn-default">Cancel</a>
</div>


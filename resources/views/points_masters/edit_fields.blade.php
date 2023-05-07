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

  <!-- Schema Field -->
<div class="form-group">
    {!! Form::label('schema', 'Select Schema:') !!}
    {!! Form::select('schema', [''=>'Select Schema','1' => 'Have to win direct',"2" => 'Win and continue for next level',"3" => 'Option if you want to take the voucher (and restart the counter) or continue for next level'], null, ['class' => 'form-control','id' => 'schema']) !!}
</div>

 <div class="form-group">
    {!! Form::label('currency_id', 'Currency:') !!}
    {!! Form::select('currency_id', [''=>'Select Currency'] + $currency_data->toArray(), null, ['class' => 'form-control']) !!}
</div>
<!-- Ratio Of Collecting Points Field -->
<div class="form-group">
    {!! Form::label('ratio_of_collecting_points', 'Ratio Of Collecting Points:') !!}
    {!! Form::text('ratio_of_collecting_points', null, ['class' => 'form-control']) !!}
</div>

<!-- Ratio For Cash Out Field -->
<div class="form-group">
    {!! Form::label('ratio_for_cash_out', 'Ratio For Cash Out:') !!}
    {!! Form::text('ratio_for_cash_out', null, ['class' => 'form-control']) !!}
</div>

@if(isset($pointsMaster->id))
<?php $sg_data = \App\Models\Points_segment::where('point_id',  $pointsMaster->id)->get();
         foreach ($sg_data as $key =>  $sgp_data) { ?>

<div class="row itemClass" id="item_<?php echo $key + 1; ?>">
    <div class="col-md-3">
         <div class="form-group">
            {!! Form::label('segments_id', 'Segments Name:') !!}
            {!! Form::select('segments_id[]', [''=>'Select Segments'] + $segment_data->toArray(), $sgp_data->segments_id, ['class' => 'form-control']) !!}
        </div>
    </div>
   
    <div class="col-md-3">
          <div class="form-group">
            <label for="per_points">Per Points</label>
            {!! Form::text('per_points[]', $sgp_data->per_points, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
          <div class="form-group">
            <label for="amount">Amount</label>
            {!! Form::text('amount[]', $sgp_data->amount, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-2" style="margin-top: 30px;">
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
            {!! Form::label('segments_id', 'Segments Name:') !!}
            {!! Form::select('segments_id[]', [''=>'Select Segments'] + $segment_data->toArray(), null, ['class' => 'form-control']) !!}
        </div>
    </div>
   
    <div class="col-md-3">
          <div class="form-group">
            <label for="per_points">Per Points</label>
            {!! Form::text('per_points[]', null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
          <div class="form-group">
            <label for="amount">Amount</label>
            {!! Form::text('amount[]', null, ['class' => 'form-control']) !!}
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



<!-- Levels Based On Scenarios Field -->
<div class="form-group">
    {!! Form::label('levels_based_on_scenarios', 'Levels Based On Scenarios:') !!}
    <!-- {!! Form::text('levels_based_on_scenarios', null, ['class' => 'form-control']) !!} -->
      {!! Form::select('levels_based_on_scenarios', [''=>'Select Schema',"0" => '0','1' => '1',"2" => '2',"3" => '3'], null, ['class' => 'form-control','id' => 'levels_based_on_scenarios']) !!}
</div>

<!-- Birthday Field -->
<div class="form-group">
    {!! Form::label('birthday', 'Birthday:') !!}
    @if(isset($pointsMaster->birthday))
    <label class="radio-inline" for="birthday_yes"><input id="birthday_yes" type="radio" name="birthday" value="1" <?php echo ($pointsMaster->birthday == '1') ?  "checked" : "" ;  ?>> Yes</label>
    <label class="radio-inline" for="birthday_no"><input id="birthday_no" type="radio" name="birthday" value="0" <?php echo ($pointsMaster->birthday == '0') ?  "checked" : "" ;  ?>> No</label>
    @else
    <label class="radio-inline" for="birthday_yes"><input id="birthday_yes" type="radio" name="birthday" value="1" > Yes</label>
    <label class="radio-inline" for="birthday_no"><input id="birthday_no" type="radio" name="birthday" value="0" checked> No</label>
    @endif

</div>

<!-- Welcome Field -->
<div class="form-group">
    {!! Form::label('welcome', 'Welcome:') !!}
    @if(isset($pointsMaster->welcome))
    <label class="radio-inline" for="welcome_yes"><input id="welcome_yes" type="radio" name="welcome" value="1" <?php echo ($pointsMaster->welcome == '1') ?  "checked" : "" ;  ?>> Yes</label>
    <label class="radio-inline" for="welcome_no"><input id="welcome_no" type="radio" name="welcome" value="0" <?php echo ($pointsMaster->welcome == '0') ?  "checked" : "" ;  ?>> No</label>
    @else
    <label class="radio-inline" for="welcome_yes"><input id="welcome_yes" type="radio" name="welcome" value="1" > Yes</label>
    <label class="radio-inline" for="welcome_no"><input id="welcome_no" type="radio" name="welcome" value="0" checked> No</label>
    @endif

</div>

<!-- Fraud Of Points Field -->
<div class="form-group">
    {!! Form::label('transactions_means', 'Transactions means:') !!}
    {!! Form::text('transactions_means', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('duration', 'Duration:') !!}
    {!! Form::text('duration', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('points_limits', 'Points limits:') !!}
    {!! Form::text('points_limits', null, ['class' => 'form-control']) !!}
</div>


<!-- Campaign Field -->
<div class="form-group">
    {!! Form::label('campaign', 'Campaign:') !!}
    @if(isset($pointsMaster->campaign))
    <label class="radio-inline" for="campaign_yes"><input id="campaign_yes" type="radio" name="campaign" value="1" <?php echo ($pointsMaster->campaign == '1') ?  "checked" : "" ;  ?>> Yes</label>
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
    {!! Form::text('start_date', date('Y-m-d',strtotime($pointsMaster->start_date)), ['class' => 'form-control input-datepicker','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
    @else
        {!! Form::text('start_date', null, ['class' => 'form-control input-datepicker','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
    @endif
</div>
<!-- End Date Field -->
<!-- <div class="form-group">
    {!! Form::label('end_date', 'End Date:') !!}
    {!! Form::text('end_date', null, ['class' => 'form-control','id'=>'end_date']) !!}
</div> -->

<div class="form-group">
    {!! Form::label('end_date', 'End Date:') !!}
    @if(isset($pointsMaster->end_date))
    {!! Form::text('end_date', date('Y-m-d',strtotime($pointsMaster->end_date)), ['class' => 'form-control input-datepicker','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
    @else
        {!! Form::text('end_date', null, ['class' => 'form-control input-datepicker','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
    @endif
</div>



<!-- Expiration Date Field -->
<div class="form-group">
   {!! Form::label('expiration_date', 'Expiration Date:') !!}
    @if(isset($pointsMaster->expiration_date))
    {!! Form::text('expiration_date', date('Y-m-d',strtotime($pointsMaster->expiration_date)), ['class' => 'form-control input-datepicker','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
    @else
        {!! Form::text('expiration_date', null, ['class' => 'form-control input-datepicker','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
    @endif
</div>
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


<!-- Business Id Field -->
@if(isset($voucher->country_id))
<div class="form-group">
    {!! Form::label('business_id', 'Business Name:') !!}
    {!! Form::select('business_id', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control buss_id_country','id' => 'buss_id','disabled']) !!}
</div>
@else
<div class="form-group">
    {!! Form::label('business_id', 'Business Name:') !!}
    {!! Form::select('business_id', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control buss_id_country','id' => 'buss_id']) !!}
</div>
@endif

<div class="form-group">
        {!! Form::label('days', 'Expiry days of gift voucher:') !!}
        {!! Form::text('days', null, ['class' => 'form-control','id'=>'days']) !!} 
</div>
<!-- Code Field -->
@if(isset($voucher->country_id))
<div class="form-group">
    {!! Form::label('country_id', 'Country:') !!}
    {!! Form::select('country_id', [''=>'Select Country'] + $country_data->toArray(), $voucher->country_id, ['class' => 'form-control','disabled']) !!}
    <input type="hidden" name="country_id" id="" value="{{$voucher->country_id}}">
</div>
@else
<div class="form-group">
    {!! Form::label('country_id', 'Country:') !!}
    {!! Form::select('country_id', [''=>'Select Country'],null,['class' => 'form-control','id'=>'country_data','disabled']) !!}
    <input type="hidden" name="country_id" id="country_data_id">
</div>
@endif

<div class="form-group">
    {!! Form::label('category_id', 'Voucher Category:') !!}
    {!! Form::select('category_id', [''=>'Select Category'] + $voucher_category->toArray(), null, ['class' => 'form-control cat_id','id' => 'category_id']) !!}
</div>

<div class="form-group" id="campaign_cat" style="display: none;">
    {!! Form::label('campaign_type', 'Super Code Category:') !!}
    {!! Form::select('campaign_type', [''=>'Super Code Category','1' => 'Random Winners',"2" => 'Instant Win (all)',"3" => 'Loyalty',"4" => 'Lottery'], null, ['class' => 'form-control','id' => 'campaign_type']) !!}
</div>

@if(isset($voucher->levels_based_on_scenarios))
<input type="hidden" id="e_levels_based_on_scenarios" name="levels_based_on_scenarios" value="{{$voucher->levels_based_on_scenarios}}" disabled>
<div class="form-group" id='Scenarios' style="display:none;">
    {!! Form::label('levels_based_on_scenarios', 'Levels Based On Scenarios:') !!}
    <!-- {!! Form::text('levels_based_on_scenarios', null, ['class' => 'form-control']) !!} -->
      {!! Form::select('levels_based_on_scenarios', [''=>'Select Schema'], $voucher->levels_based_on_scenarios, ['class' => 'form-control','id' => 'levels_based_on_scenarios']) !!}
</div>
@else
<div class="form-group" id='Scenarios' style="display:none;">
    {!! Form::label('levels_based_on_scenarios', 'Levels Based On Scenarios:') !!}
    <!-- {!! Form::text('levels_based_on_scenarios', null, ['class' => 'form-control']) !!} -->
      {!! Form::select('levels_based_on_scenarios', [''=>'Select Schema'], null, ['class' => 'form-control','id' => 'levels_based_on_scenarios']) !!}
</div>
@endif
<div class="form-group" id="scenario_type" style="display: none;">
    {!! Form::label('scenario', 'Scenario:') !!}<span style="color:red">Excel is mandatory only for scenario 2</span>
    {!! Form::select('scenario_type', [''=>'Select Scenario','1' => 'Scenario 1','2' => 'Scenario 2'],null, ['class' => 'form-control','id' => 'scenario_type_id']) !!}
</div>

@if(!isset($voucher->id))
<div class="form-group" id="optionId">
    {!! Form::label('option', 'Select Option:') !!}
    {!! Form::select('upload_option', [''=>'Select Option','1' => 'Upload Excel',"2" => 'Manual'], null, ['class' => 'form-control','id' => 'entry_option']) !!}
</div>
<input type="hidden" name = "upload_option" id="optionIdVal" value="" disabled="true">
@endif
<div id="manual" style=" <?php if(!isset($voucher->id)) {echo "display: none;";} ?>">
    <!-- Icon Field -->
    @if(isset($voucher->code))
    <div class="form-group">
        {!! Form::label('code', 'Code:') !!}
        {!! Form::text('code', $voucher->code, ['class' => 'form-control','readonly']) !!}
    </div>
    @else
    <div class="form-group">
        {!! Form::label('code', 'Code:') !!}
        {!! Form::text('code', $code_string, ['class' => 'form-control','readonly']) !!}
    </div>
    @endif

    <div class="form-group">
        {!! Form::label('icon', 'Icon:') !!}
        {!! Form::file('icon', null, ['class' => 'form-control']) !!}
    </div>
    <?php if (isset($voucher->icon)) {?>
        <div class="form-group">
         <img src="<?php echo  url('/').'/'.$voucher->icon; ?>" style="width: 9%"  >
         <input type="hidden" name="icon" value="{{$voucher->icon}}">
    </div> 
    <?php }?>
    <!-- Image Field -->
    <div class="form-group">
        {!! Form::label('image', 'Image:') !!}
        {!! Form::file('image', null, ['class' => 'form-control']) !!}
    </div>
    <?php if (isset($voucher->image)) {?>
        <div class="form-group">
         <img src="<?php echo  url('/').'/'.$voucher->image; ?>" style="width: 9%"  >
         <input type="hidden" name="image" value="{{$voucher->image}}">
    </div> 
    <?php }?>

    <!-- Banner Image Field -->
    <div class="form-group">
        {!! Form::label('banner_image', 'Banner Image:') !!}
        {!! Form::file('banner_image', null, ['class' => 'form-control']) !!}
    </div>
    <?php if (isset($voucher->banner_image)) {?>
        <div class="form-group">
         <img src="<?php echo  url('/').'/'.$voucher->banner_image; ?>" style="width: 9%"  >
         <input type="hidden" name="banner_image" value="{{$voucher->banner_image}}">
    </div> 
    <?php }?>
    <!-- Category Id Field -->


    <!-- Start Date Field -->
    <div class="form-group">
        {!! Form::label('start_date', 'Start Date:') !!}
        @if(isset($voucher->start_date))
        {!! Form::text('start_date', date('Y-m-d',strtotime($voucher->start_date)), ['class' => 'form-control input-datepicker','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
        @else
            {!! Form::text('start_date', null, ['class' => 'form-control input-datepicker22','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
        @endif
    </div>
    

    <!-- End Date Field -->
    <div class="form-group">
        {!! Form::label('end_date', 'End Date:') !!}
        @if(isset($voucher->end_date))
        {!! Form::text('end_date', date('Y-m-d',strtotime($voucher->end_date)), ['class' => 'form-control input-datepickerStart','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
        @else
            {!! Form::text('end_date', null, ['class' => 'form-control input-datepickerStart','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
        @endif
    </div>
    <div class="form-group" id="campaign_code" style="display: none;">
        {!! Form::label('campaign_code', 'Campaign Code:') !!}
        {!! Form::text('campaign_code', null, ['class' => 'form-control','id'=>'']) !!}
    </div>
    
    <div class="form-group" id="random_win_status" style="display:none;">
        {!! Form::label('random_win_status', 'Random Win Status:') !!}
        {!! Form::select('random_win_status', [''=>'Select Option','0' => 'Not Win',"" => 'Win'], null, ['class' => 'form-control']) !!}
    </div>

    
    <div class="form-group" id="campaign_start_date" style="display: none;">
        {!! Form::label('campaign_start_date', 'Campaign Start Date:') !!}
        @if(isset($voucher->campaign_start_date))
            {!! Form::text('campaign_start_date', date('Y-m-d',strtotime($voucher->campaign_start_date)), ['class' => 'form-control input-datepickerCampStart','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
        @else
            {!! Form::text('campaign_start_date', null, ['class' => 'form-control input-datepickerCampStart','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
        @endif
    </div>

    <div class="form-group" id="campaign_end_date" style="display: none;">
        {!! Form::label('campaign_end_date', 'Campaign End Date:') !!}
        @if(isset($voucher->campaign_end_date))
        {!! Form::text('campaign_end_date', date('Y-m-d',strtotime($voucher->campaign_end_date)), ['class' => 'form-control input-datepickerCampEnd','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}            
        @else
            {!! Form::text('campaign_end_date', null, ['class' => 'form-control input-datepickerCampEnd','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
        @endif
    </div>

    <div class="form-group" id="date_of_campaign" style="display: none;">
        {!! Form::label('date_of_campaign', 'Date Of Campaign:') !!}
        @if(isset($voucher->date_of_campaign))
            {!! Form::text('date_of_campaign', date('Y-m-d',strtotime($voucher->date_of_campaign)), ['class' => 'form-control input-datepicker','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}            
        @else
            {!! Form::text('date_of_campaign', null, ['class' => 'form-control input-datepicker','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
        @endif
            
    </div>

    <!-- <div class="form-group" id="max_member" style="display: none;">
    {!! Form::label('max_member', 'Max Member:') !!}
    {!! Form::text('max_member',null, ['class' => 'form-control']) !!}
</div> -->

    <!-- Terms Eng Field -->
    <div class="form-group">
        {!! Form::label('title_eng', 'Title Eng:') !!}
        {!! Form::text('title_eng', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('title_italian', 'Title Italian:') !!}
        {!! Form::text('title_italian', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('title_greek', 'Title Greek:') !!}
        {!! Form::text('title_greek', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('title_albanian', 'Title Albanian:') !!}
        {!! Form::text('title_albanian', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('terms_eng', 'Terms Eng:') !!}
        {!! Form::textarea('terms_eng', null, ['class' => 'form-control','rows' => 3]) !!}
    </div>
    <div class="form-group">
        {!! Form::label('terms_italian', 'Terms Italian:') !!}
        {!! Form::textarea('terms_italian', null, ['class' => 'form-control','rows' => 3]) !!}
    </div>
    <div class="form-group">
        {!! Form::label('terms_greek', 'Terms Greek:') !!}
        {!! Form::textarea('terms_greek', null, ['class' => 'form-control','rows' => 3]) !!}
    </div>
    <div class="form-group">
        {!! Form::label('terms_albanian', 'Terms Albanian:') !!}
        {!! Form::textarea('terms_albanian', null, ['class' => 'form-control','rows' => 3]) !!}
    </div>

    <!-- Description Eng Field -->
    <div class="form-group">
        {!! Form::label('description_eng', 'Description Eng:') !!}
        {!! Form::textarea('description_eng', null, ['class' => 'form-control','rows' => 3]) !!}
    </div>

    <div class="form-group">
        {!! Form::label('description_italian', 'Description Italian:') !!}
        {!! Form::textarea('description_italian', null, ['class' => 'form-control','rows' => 3]) !!}
    </div>

    <div class="form-group">
        {!! Form::label('description_greek', 'Description Greek:') !!}
        {!! Form::textarea('description_greek', null, ['class' => 'form-control','rows' => 3]) !!}
    </div>

    <div class="form-group">
        {!! Form::label('description_albanian', 'Description Albanian:') !!}
        {!! Form::textarea('description_albanian', null, ['class' => 'form-control','rows' => 3]) !!}
    </div>

    <div class="form-group">
        {!! Form::label('text_for_win_code_eng', 'Text For Win Code English:') !!}
        {!! Form::textarea('text_for_win_code_eng', null, ['class' => 'form-control','rows' => 3]) !!}
    </div>

    <div class="form-group">
        {!! Form::label('text_for_win_code_italian', 'Text For Win Code Italian:') !!}
        {!! Form::textarea('text_for_win_code_italian', null, ['class' => 'form-control','rows' => 3]) !!}
    </div>

    <div class="form-group">
        {!! Form::label('text_for_win_code_greek', 'Text For Win Code Greek:') !!}
        {!! Form::textarea('text_for_win_code_greek', null, ['class' => 'form-control','rows' => 3]) !!}
    </div>

    <div class="form-group">
        {!! Form::label('text_for_win_code_albanian', 'Text For Win Code Albanian:') !!}
        {!! Form::textarea('text_for_win_code_albanian', null, ['class' => 'form-control','rows' => 3]) !!}
    </div>


    <div class="form-group">
        {!! Form::label('text_for_not_win_code_eng', 'Text For Not Win Code English:') !!}
        {!! Form::textarea('text_for_not_win_code_eng', null, ['class' => 'form-control','rows' => 3]) !!}
    </div>

    <div class="form-group">
        {!! Form::label('text_for_not_win_code_italian', 'Text For Not Win Code Italian:') !!}
        {!! Form::textarea('text_for_not_win_code_italian', null, ['class' => 'form-control','rows' => 3]) !!}
    </div>

    <div class="form-group">
        {!! Form::label('text_for_not_win_code_greek', 'Text For Not Win Code Greek:') !!}
        {!! Form::textarea('text_for_not_win_code_greek', null, ['class' => 'form-control','rows' => 3]) !!}
    </div>

    <div class="form-group">
        {!! Form::label('text_for_not_win_code_albanian', 'Text For Not Win Code Albanian:') !!}
        {!! Form::textarea('text_for_not_win_code_albanian', null, ['class' => 'form-control','rows' => 3]) !!}
    </div>
</div>
<div id="excel" style="display: none;">
    <div class="form-group">
        {!! Form::label('upload_excel', 'Upload Excel:') !!}
        {!! Form::file('voucher_file', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group" id="free_voucher">
        {!! Form::label('question_data', 'Download Free Voucher Sample Excel:') !!}
        <a download ="voucher.xlsx" href="<?php echo  url('/public/excel/sample_file/voucher.xlsx') ?>">Download</a>
    </div>

    <div class="form-group" id="free_supercode">
	    {!! Form::label('question_data', 'Download Super Code Sample Excel:') !!}
	    <a download ="supercode.xlsx" href="<?php echo  url('/public/excel/sample_file/supercode.xlsx') ?>">Download</a>
    </div>

    <div class="form-group" id="random_win">
	    {!! Form::label('question_data', 'Download Super Code Ramdom Winner Sample Excel:') !!}    
	    <a download ="supercode.xlsx" href="<?php echo  url('/public/excel/sample_file/randomWinExcel.xlsx') ?>">Download</a>
    </div>    
    <div class="form-group" id="point_excel">
	    {!! Form::label('question_data', 'Download Super Code Point Sample Excel:') !!}    
	    <a download ="pointCode.xlsx" href="<?php echo  url('/public/excel/sample_file/pointCode.xlsx') ?>">Download</a>
    </div>    
</div>

<input type="hidden" name="lotery_point" id="lotery_point" value="">
<div id="scenario_2_excel" style="display: none;">
<div class="form-group">
        {!! Form::label('upload_excel', 'Upload Excel:') !!}
        {!! Form::file('scenario_2_file', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group" id="">
	    {!! Form::label('question_data', 'Download Scenario 2 Sample Excel:') !!}    
	    <a download ="lotery_scenario_2.xlsx" href="<?php echo  url('/public/excel/sample_file/lotery_scenario_2.xlsx') ?>">Download</a>
    </div>
</div>
<div class="form-group" id="point_value" style="display:none;">
        {!! Form::label('point_value', 'Point Value:') !!}
        {!! Form::text('point_value', null, ['class' => 'form-control','id'=>'point_value']) !!} 
</div>
<!-- Status Field -->

<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('vouchers.index') }}" class="btn btn-default">Cancel</a>
</div>

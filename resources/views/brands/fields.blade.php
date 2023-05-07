<!-- Cat Id Field -->

<div class="form-group">
    <label for="type">Select Type</label>
    {!! Form::select('type', $type= array("" => "Select Type","1"=>"Business","2" => "Brand"), null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="stamp_point">Select Loyalty</label>
    {!! Form::select('stamp_point', $stamp_point= array("" => "Select Loyalty","1"=>"Stamp","2" => "Points","3" => "None"), null, ['class' => 'form-control']) !!}
</div>
<!-- <div class="form-group">
    <label for="grade">Position number</label>
    {!! Form::select('position', $position= array(""=>"Select Position number","1"=>"1","2" => "2","3"=>"3","4" => "4","5" => "5","6" => "6","7" => "7","8" => "8","9" => "9","10" => "10","11" => "11","12" => "12","13" => "13","14" => "14","15" => "15","16" => "16","17" => "17","18" => "18","19" => "19","20" => "20"), null, ['class' => 'form-control ','id' =>'example-chosen-multiple' ,'data-placeholder'=>'Select Position number']) !!}
</div> -->
<div class="form-group">

<label for="mobile_no">Category</label>

@if(!empty($selectCat))


<select class="form-control select-chosen category" name="cat_id[]" multiple="" id="example-chosen-multiple" >
    <?php foreach ($category as $catVal) {
        //echo $catVal['id'];
        if(in_array($catVal['id'],$selectCat))
        { ?>
            <option value="<?php echo $catVal['id']; ?>" selected="selected"><?php echo $catVal['name']; ?></option>
       <?php } else { ?>
            <option value="<?php echo $catVal['id']; ?>"><?php echo $catVal['name']; ?></option>
        <?php } } ?>
</select>
@else
{!! Form::select('cat_id[]', $category->toArray(), null, ['class' => 'form-control select-chosen category', 'id' =>'example-chosen-multiple','multiple','data-placeholder'=>'Select Category']) !!}

<!-- {!! Form::select('cat_id', [''=>'Select Category'] + $category->toArray(), null, ['class' => 'form-control', 'id' =>'cat_id']) !!} -->
@endif
</div>

<div class="form-group">
    
<label for="mobile_no">Sub Category</label>
@if(isset($selectSubCat))
<select class="form-control sub-category" name="sub_id[]" multiple="" id="" >
    <?php foreach ($sub_category as $subcatVal) {
        //echo $catVal['id'];
        if(in_array($subcatVal['id'],$selectSubCat))
        { ?>
            <option value="<?php echo $subcatVal['id']; ?>" selected="selected"><?php echo $subcatVal['cat_subcatName']; ?></option>
       <?php } else { ?>
            <option value="<?php echo $subcatVal['id']; ?>"><?php echo $subcatVal['cat_subcatName']; ?></option>
        <?php } } ?>
</select>

@else
<!-- {!! Form::select('sub_id', [''=>'Select Sub Category'] , null, ['class' => 'form-control', 'id' =>'sub_id']) !!} -->
{!! Form::select('sub_id[]', [], null, ['class' => 'form-control sub-category', 'id' =>'example-chosen-multiple','multiple','data-placeholder'=>'Select Sub Category']) !!}
@endif
</div>

@if(isset($brand->country_id))
<div class="form-group">
    {!! Form::label('country_id', 'Country:') !!}
    {!! Form::select('country_id', [''=>'Select Country'] + $country_data->toArray(), $brand->country_id, ['class' => 'form-control']) !!}
</div>
@else
<div class="form-group">
    {!! Form::label('country_id', 'Country:') !!}
    {!! Form::select('country_id', [''=>'Select Country'] + $country_data->toArray(), null, ['class' => 'form-control']) !!}
</div>
@endif
<!-- Name Field -->
<div class="form-group">
    {!! Form::label('city_name', 'City:') !!}
    {!! Form::text('city_name', null, ['class' => 'form-control']) !!}
</div>
<!-- Currency Field -->
<div class="form-group">
    {!! Form::label('currency', 'Currency:') !!}
    {!! Form::select('currency', [''=>'Select Currency'] + $currency_data->toArray(), null, ['class' => 'form-control']) !!}
</div>
@if(isset($brand->services))
<div class="form-group">
    @php
        $services = [];
    @endphp
    @if(isset($brand) && !empty($brand->services))
        @php
            $services = explode(',', $brand->services);
        @endphp
    @endif
    {!! Form::label('services', 'Services:') !!}
    <select name="services[]" id="services" class="form-control" multiple required="required">
        <option value="" hidden>Select Days</option>
        <option value="1" @if(in_array('1', $services)) selected @endif>LOYALTY</option>
        <option value="2" @if(in_array('2', $services)) selected @endif>FREE OFFERS</option>
        <option value="3" @if(in_array('3', $services)) selected @endif>SUPER DEALS</option>
        <option value="4" @if(in_array('4', $services)) selected @endif>NLINE STORE</option>
        <option value="5" @if(in_array('5', $services)) selected @endif>BOOKING</option>
    </select>
</div>
@else
<div class="form-group">
    <label for="grade">Services</label>
    {!! Form::select('services[]', $services= array("1"=>"LOYALTY","2" => "FREE OFFERS","3"=>"SUPER DEALS","4" => "ONLINE STORE","5" => "BOOKING"), null, ['class' => 'form-control select-chosen','id' =>'example-chosen-multiple','multiple' ,'data-placeholder'=>'Select Services']) !!}
</div>
@endif
<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('latitude', 'Latitude :') !!}
    {!! Form::text('latitude', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('longitude', 'Longitude:') !!}
    {!! Form::text('longitude', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('agreement_date_of_expiry', 'Expiration Date of agreement:') !!}
    @if(isset($stampMaster->stapm_expired))
    {!! Form::text('agreement_date_of_expiry', date('Y-m-d',strtotime($stampMaster->stapm_expired)), ['class' => 'form-control expiration_date','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
    @else
        {!! Form::text('agreement_date_of_expiry', null, ['class' => 'form-control expiration_date','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
    @endif
</div>

<div class="form-group">
    {!! Form::label('package_details', 'Package Details :') !!}
    {!! Form::text('package_details', null, ['class' => 'form-control']) !!}
</div>

@if(isset($brand->id))
<!-- Emial Field -->
<?php  $user = \App\User::where('role_id',3)->where('userDetailsId',$brand->id)->first(); 
    

?>
<div class="form-group">
    {!! Form::label('email', 'Business Admin Email:') !!}
    <!-- {!! Form::text('email', null, ['class' => 'form-control']) !!} -->
    <input type="text" class="form-control" name="" value="<?php echo $user['email']; ?>" readonly>
</div>

<!-- Emial Field -->
<div class="form-group">
    {!! Form::label('password', 'Business Admin Password:') !!}
    <input type="text" name="password" class="form-control" value="<?php echo $user['show_password'];  ?>" readonly>
    <!-- {!! Form::password('password', null, ['class' => 'form-control']) !!} -->
</div>
@else
<!-- Emial Field -->
<div class="form-group">
    {!! Form::label('email', 'Business Admin Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Emial Field -->
<div class="form-group">
    {!! Form::label('password', 'Business Admin Password:') !!}
    <input type="password" name="password" class="form-control">
    <!-- {!! Form::password('password', null, ['class' => 'form-control']) !!} -->
</div>

@endif




<!-- Brand Icon Field -->
<div class="form-group">
    {!! Form::label('brand_icon', 'Business logo:') !!}
    {!! Form::file('brand_icon', null) !!}
</div>
<?php if (isset($brand->brand_icon)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$brand->brand_icon; ?>" style="width: 9%"  >
     <input type="hidden" name="brand_icon" value="{{$brand->brand_icon}}">
</div> 
<?php }?>

<div class="form-group">
    {!! Form::label('other_program', 'Other Program:') !!}
    @if(isset($brand->other_program))
    <label class="radio-inline" for="other_program_yes"><input id="other_program_yes" class="bir" type="radio" name="other_program" value="1" <?php echo ($brand->other_program == '1') ?  "checked" : "" ;  ?>> Yes</label>
    <label class="radio-inline" for="other_program_yes"><input id="other_program_yes" class="bir_no" type="radio" name="other_program" value="0" <?php echo ($brand->other_program == '0') ?  "checked" : "" ;  ?>> No</label>
    @else
    <label class="radio-inline" for="other_program_yes"><input id="other_program_yes" type="radio" name="other_program" value="1" > Yes</label>
    <label class="radio-inline" for="other_program_yes"><input id="other_program_no" type="radio" name="other_program" value="0" checked> No</label>
    @endif
    
<!-- Brand Icon Field -->
<div class="form-group">
    {!! Form::label('other_program_icon', 'Other Program icon:') !!}
    {!! Form::file('other_program_icon', null) !!}
</div>
<?php if (isset($brand->other_program_icon)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$brand->other_program_icon; ?>" style="width: 9%"  >
     <input type="hidden" name="other_program_icon" value="{{$brand->other_program_icon}}">
</div> 
<?php }?>

<!-- Status Field -->
<!-- <div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('brands.index') }}" class="btn btn-default">Cancel</a>
</div>


<!-- Name Field -->
<!-- <div class="form-group ">
    {!! Form::label('name', 'Category:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div> -->
<div class="form-group">
        {!! Form::label('name', 'Category name in English:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('cat_italian', 'Category name in Italian:') !!}
        {!! Form::text('cat_italian', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('cat_greek', 'Category name in Greek:') !!}
        {!! Form::text('cat_greek', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('cat_albanian', 'Category name in Albanian:') !!}
        {!! Form::text('cat_albanian', null, ['class' => 'form-control']) !!}
    </div>
<!-- Position Field -->
<div class="form-group">
    <label for="grade">Position number</label>
    {!! Form::select('position', $position= array(""=>"Select Position number","1"=>"1","2" => "2","3"=>"3","4" => "4","5" => "5","6" => "6","7" => "7","8" => "8","9" => "9","10" => "10","11" => "11","12" => "12","13" => "13","14" => "14","15" => "15","16" => "16","17" => "17","18" => "18","19" => "19","20" => "20","21" => "21","22" => "22","23" => "23","24" => "24","25" => "25"), null, ['class' => 'form-control ','id' =>'example-chosen-multiple' ,'data-placeholder'=>'Select Position number']) !!}
</div>
<!-- <?php if (isset($category->id)) {?>
<div class="row">
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        {!! Form::select('business_id_1', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position_1', 1, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        {!! Form::select('business_id_2', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position_2', 2, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        {!! Form::select('business_id_3', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position_3', 3, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        {!! Form::select('business_id_4', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position_4', 4, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        {!! Form::select('business_id_5', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position_5', 5, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        {!! Form::select('business_id_6', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position_6', 6, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        {!! Form::select('business_id_7', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position_7', 7, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        {!! Form::select('business_id_8', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position_8', 8, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        {!! Form::select('business_id_9', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position_9', 9, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        {!! Form::select('business_id_10', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position_10', 10, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<?php } ?> -->
<!-- Icon Field -->
<div class="form-group ">
    {!! Form::label('icon', 'Icon:') !!}
    {!! Form::file('icon') !!}
</div>
 <?php if (isset($category->icon)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$category->icon; ?>" style="width: 9%"  >
     <input type="hidden" name="icon" value="{{$category->icon}}">
</div> 
<?php }?>

<div class="clearfix"></div>


<!-- Status Field -->
<!-- <div class="form-group ">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Submit Field -->
<div class="form-group ">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('categories.index') }}" class="btn btn-default">Cancel</a>
</div>

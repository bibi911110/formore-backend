<!-- Cat Id Field -->
<!-- <div class="form-group">
    {!! Form::label('cat_id', 'Cat Id:') !!}
    {!! Form::text('cat_id', null, ['class' => 'form-control']) !!}
</div> -->
<div class="form-group">
<label for="mobile_no">Category</label>
@if(isset($subCategory->cat_id))
{!! Form::select('cat_id', [''=>'Select Category'] + $category->toArray(), $subCategory->cat_id, ['class' => 'form-control', 'id' =>'stateId']) !!}
@else
{!! Form::select('cat_id', [''=>'Select Category'] + $category->toArray(), null, ['class' => 'form-control', 'id' =>'stateId']) !!}
@endif
</div>

<!-- Name Field -->
<!-- <div class="form-group">
    {!! Form::label('name', 'Subcategory:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div> -->

<div class="form-group">
        {!! Form::label('name', 'Subcategory name in English:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('subcat_italian', 'Subcategory name in Italian:') !!}
        {!! Form::text('subcat_italian', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('subcat_greek', 'Subcategory name in Greek:') !!}
        {!! Form::text('subcat_greek', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('subcat_albanian', 'Subcategory name in Albanian:') !!}
        {!! Form::text('subcat_albanian', null, ['class' => 'form-control']) !!}
    </div>
<!-- Business Id Field -->
<?php if (isset($subCategory->id)) {?>
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
<?php } ?>
<!-- Icon Field -->
<div class="form-group">
    {!! Form::label('icon', 'Icon:') !!}
    {!! Form::file('icon', null, ['class' => 'form-control']) !!}
</div>
<?php if (isset($subCategory->icon)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$subCategory->icon; ?>" style="width: 9%"  >
     <input type="hidden" name="icon" value="{{$subCategory->icon}}">
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
    <a href="{{ route('subCategories.index') }}" class="btn btn-default">Cancel</a>
</div>

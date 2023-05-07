<!-- Country Name Field -->
<div class="form-group">
    {!! Form::label('country_name', 'Country Name:') !!}
    {!! Form::text('country_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Code Field -->
<div class="form-group">
    {!! Form::label('country_code', 'Country Code:') !!}
    {!! Form::text('country_code', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('country_icon', 'Icon:') !!}
    {!! Form::file('country_icon', null, ['class' => 'form-control']) !!}
</div>
 <?php if (isset($country->country_icon)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$country->country_icon; ?>" style="width: 9%"  >
     <input type="hidden" name="country_icon" value="{{$country->country_icon}}">
</div> 
<?php }?>
@if(isset($country->id))
<div class="row">
   <?php $country_position = \App\Models\Country_business_position::where('country_id', $country->id)->where('position',1)->first();?>
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        @if(isset($country_position->business_id))
        <?php echo $country_position->business_id; ?>
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), $country_position->business_id, ['class' => 'form-control']) !!}
        @else
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position[]', 1, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

<div class="row">
    <?php $country_position = \App\Models\Country_business_position::where('country_id', $country->id)->where('position',2)->first();?>
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        @if(isset($country_position->business_id))
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), $country_position->business_id, ['class' => 'form-control']) !!}
        @else
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position[]', 2, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<div class="row">
    <?php $country_position = \App\Models\Country_business_position::where('country_id', $country->id)->where('position',3)->first();?>
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        @if(isset($country_position->business_id))
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), $country_position->business_id, ['class' => 'form-control']) !!}
        @else
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position[]', 3, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<div class="row">

    <?php $country_position = \App\Models\Country_business_position::where('country_id', $country->id)->where('position',4)->first();?>
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        @if(isset($country_position->business_id))
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), $country_position->business_id, ['class' => 'form-control']) !!}
        @else
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position[]', 4, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<div class="row">
    <?php $country_position = \App\Models\Country_business_position::where('country_id', $country->id)->where('position',5)->first();?>
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        @if(isset($country_position->business_id))
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), $country_position->business_id, ['class' => 'form-control']) !!}
        @else
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position[]', 5, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<div class="row">
    <?php $country_position = \App\Models\Country_business_position::where('country_id', $country->id)->where('position',6)->first();?>
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        @if(isset($country_position->business_id))
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), $country_position->business_id, ['class' => 'form-control']) !!}
        @else
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position[]', 6, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<div class="row">
    <?php $country_position = \App\Models\Country_business_position::where('country_id', $country->id)->where('position',7)->first();?>
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        @if(isset($country_position->business_id))
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), $country_position->business_id, ['class' => 'form-control']) !!}
        @else
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position[]', 7, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<div class="row">
    <?php $country_position = \App\Models\Country_business_position::where('country_id', $country->id)->where('position',8)->first();?>
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        @if(isset($country_position->business_id))
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), $country_position->business_id, ['class' => 'form-control']) !!}
        @else
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position[]', 8, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<div class="row">
    <?php $country_position = \App\Models\Country_business_position::where('country_id', $country->id)->where('position',9)->first();?>
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        @if(isset($country_position->business_id))
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), $country_position->business_id, ['class' => 'form-control']) !!}
        @else
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position[]', 9, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<div class="row">
    <?php $country_position = \App\Models\Country_business_position::where('country_id', $country->id)->where('position',10)->first();?>
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        @if(isset($country_position->business_id))
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), $country_position->business_id, ['class' => 'form-control']) !!}
        @else
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position[]', 10, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<div class="row">
    <?php $country_position = \App\Models\Country_business_position::where('country_id', $country->id)->where('position',11)->first();?>
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        @if(isset($country_position->business_id))
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), $country_position->business_id, ['class' => 'form-control']) !!}
        @else
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position[]', 11, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<div class="row">
    <?php $country_position = \App\Models\Country_business_position::where('country_id', $country->id)->where('position',12)->first();?>
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        @if(isset($country_position->business_id))
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), $country_position->business_id, ['class' => 'form-control']) !!}
        @else
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position[]', 12, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<div class="row">
    <?php $country_position = \App\Models\Country_business_position::where('country_id', $country->id)->where('position',13)->first();?>
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        @if(isset($country_position->business_id))
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), $country_position->business_id, ['class' => 'form-control']) !!}
        @else
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position[]', 13, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<div class="row">
   <?php $country_position = \App\Models\Country_business_position::where('country_id', $country->id)->where('position',14)->first();?>
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        @if(isset($country_position->business_id))
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), $country_position->business_id, ['class' => 'form-control']) !!}
        @else
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position[]', 14, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<div class="row">
   <?php $country_position = \App\Models\Country_business_position::where('country_id', $country->id)->where('position',15)->first();?>
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        @if(isset($country_position->business_id))
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), $country_position->business_id, ['class' => 'form-control']) !!}
        @else
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position[]', 15, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

<div class="row">
   <?php $country_position = \App\Models\Country_business_position::where('country_id', $country->id)->where('position',16)->first();?>
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        @if(isset($country_position->business_id))
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), $country_position->business_id, ['class' => 'form-control']) !!}
        @else
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position[]', 16, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

<div class="row">
   <?php $country_position = \App\Models\Country_business_position::where('country_id', $country->id)->where('position',17)->first();?>
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        @if(isset($country_position->business_id))
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), $country_position->business_id, ['class' => 'form-control']) !!}
        @else
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position[]', 17, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

<div class="row">
   <?php $country_position = \App\Models\Country_business_position::where('country_id', $country->id)->where('position',18)->first();?>
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        @if(isset($country_position->business_id))
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), $country_position->business_id, ['class' => 'form-control']) !!}
        @else
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position[]', 18, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

<div class="row">
   <?php $country_position = \App\Models\Country_business_position::where('country_id', $country->id)->where('position',19)->first();?>
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        @if(isset($country_position->business_id))
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), $country_position->business_id, ['class' => 'form-control']) !!}
        @else
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position[]', 19, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<div class="row">
   <?php $country_position = \App\Models\Country_business_position::where('country_id', $country->id)->where('position',20)->first();?>
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        @if(isset($country_position->business_id))
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), $country_position->business_id, ['class' => 'form-control']) !!}
        @else
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position[]', 20, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<div class="row">
   <?php $country_position = \App\Models\Country_business_position::where('country_id', $country->id)->where('position',21)->first();?>
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        @if(isset($country_position->business_id))
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), $country_position->business_id, ['class' => 'form-control']) !!}
        @else
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position[]', 21, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<div class="row">
   <?php $country_position = \App\Models\Country_business_position::where('country_id', $country->id)->where('position',22)->first();?>
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        @if(isset($country_position->business_id))
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), $country_position->business_id, ['class' => 'form-control']) !!}
        @else
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position[]', 22, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

<div class="row">
   <?php $country_position = \App\Models\Country_business_position::where('country_id', $country->id)->where('position',23)->first();?>
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        @if(isset($country_position->business_id))
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), $country_position->business_id, ['class' => 'form-control']) !!}
        @else
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position[]', 23, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

<div class="row">
   <?php $country_position = \App\Models\Country_business_position::where('country_id', $country->id)->where('position',24)->first();?>
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        @if(isset($country_position->business_id))
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), $country_position->business_id, ['class' => 'form-control']) !!}
        @else
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position[]', 24, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

<div class="row">
   <?php $country_position = \App\Models\Country_business_position::where('country_id', $country->id)->where('position',25)->first();?>
    <div class="form-group col-md-6">
        {!! Form::label('business_id', 'Business Name:') !!}
        @if(isset($country_position->business_id))
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), $country_position->business_id, ['class' => 'form-control']) !!}
        @else
        {!! Form::select('business_id[]', [''=>'Select Business'] + $brands->toArray(), null, ['class' => 'form-control']) !!}
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="grade">Position number</label>
        {!! Form::text('position[]', 25, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

@endif


<!-- Status Field -->
<!-- <div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::number('status', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('countries.index') }}" class="btn btn-default">Cancel</a>
</div>

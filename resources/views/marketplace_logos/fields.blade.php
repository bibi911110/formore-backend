<!-- Business Id Field -->
<div class="form-group">
    {!! Form::label('country_id', 'Country Name:') !!}
    {!! Form::select('country_id', [''=>'Select Country'] + $country->toArray(), null, ['class' => 'form-control country']) !!}
</div>

<div class="form-group">
    {!! Form::label('business_id', 'Business Name:') !!}
    @if(!empty($marketplaceLogo->business_id))
    {!! Form::select('business_id', [''=>'Select Business'] + $brands->toArray(), $marketplaceLogo->business_id, ['class' => 'form-control business']) !!}
    @else
    {!! Form::select('business_id', [''=>'Select Business'] , null, ['class' => 'form-control business']) !!}
    @endif
</div>

<div class="form-group">

<label for="mobile_no">Category</label>

@if(!empty($marketplaceLogo->cat_id))
{!! Form::select('cat_id', [''=>'Select Category'] +$category->toArray(), $marketplaceLogo->cat_id, ['class' => 'form-control select-chosen1 category']) !!}
@else
{!! Form::select('cat_id', [''=>'Select Category'] +$category->toArray(), null, ['class' => 'form-control select-chosen1 category']) !!}

@endif
</div>

<div class="form-group">
    
<label for="mobile_no">Sub Category</label>
@if(!empty($marketplaceLogo->sub_cat_id))

{!! Form::select('sub_cat_id', [''=>'Select Sub Category'] + $sub_category->toArray(),$marketplaceLogo->sub_cat_id, ['class' => 'form-control sub-category']) !!}
@else
    {!! Form::select('sub_cat_id', [''=>'Select Sub Category'], null, ['class' => 'form-control sub-category']) !!}
@endif
</div>

<!-- Position Field -->
<div class="form-group">
    <label for="grade">Position number</label>
    {!! Form::select('position', $position= array(""=>"Select Position number","1"=>"1","2" => "2","3"=>"3","4" => "4","5" => "5","6" => "6","7" => "7","8" => "8","9" => "9","10" => "10","11" => "11","12" => "12","13" => "13","14" => "14","15" => "15","16" => "16","17" => "17","18" => "18","19" => "19","20" => "20"), null, ['class' => 'form-control ','id' =>'example-chosen-multiple' ,'data-placeholder'=>'Select Position number']) !!}
</div>

<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('marketplaceLogos.index') }}" class="btn btn-default">Cancel</a>
</div>

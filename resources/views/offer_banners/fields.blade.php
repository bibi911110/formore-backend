<div class="form-group">
    {!! Form::label('offer_image', 'Offer Image:') !!}
    {!! Form::file('offer_image', null, ['class' => 'form-control']) !!}
</div>
 <?php if (isset($offerBanner->offer_image)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$offerBanner->offer_image; ?>" style="width: 9%"  >
     <input type="hidden" name="offer_image" value="{{$offerBanner->offer_image}}">
</div> 
<?php }?>

<!-- <div class="form-group">
    {!! Form::label('deals_banner_image', ' Deals banner photo:') !!}
    {!! Form::file('deals_banner_image', null, ['class' => 'form-control']) !!}
</div>
 <?php if (isset($offerBanner->deals_banner_image)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$offerBanner->deals_banner_image; ?>" style="width: 9%"  >
     <input type="hidden" name="deals_banner_image" value="{{$offerBanner->deals_banner_image}}">
</div> 
<?php }?> -->

<div class="form-group">
    {!! Form::label('title_for_deals', 'Title for deals:') !!}
    {!! Form::text('title_for_deals', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">

<label for="mobile_no">Category</label>

@if(!empty($offerBanner->cat_id))
{!! Form::select('cat_id', [''=>'Select Category'] +$category->toArray(), $offerBanner->cat_id, ['class' => 'form-control select-chosen1 category']) !!}
@else
{!! Form::select('cat_id', [''=>'Select Category'] +$category->toArray(), null, ['class' => 'form-control select-chosen1 category']) !!}

@endif
</div>
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


<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('offerBanners.index') }}" class="btn btn-default">Cancel</a>
</div>

<!-- Terms Of Loyalty Field -->
<div class="form-group">
    {!! Form::label('terms_of_loyalty', 'Terms Of Loyalty:') !!}
    {!! Form::text('terms_of_loyalty', null, ['class' => 'form-control']) !!}
</div>

<!-- Schema Field -->
<div class="form-group">
    {!! Form::label('schema', 'Schema:') !!}
    {!! Form::text('schema', null, ['class' => 'form-control']) !!}
</div>

<!-- popup img 5 Field -->
<div class="form-group">
    {!! Form::label('banner_img', 'Banner Image:') !!}
    {!! Form::file('banner_img') !!}
</div>
<?php if (isset($loyaltyBannerMaster->banner_img)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$loyaltyBannerMaster->banner_img; ?>" style="width: 9%"  >
     <input type="hidden" name="banner_img" value="{{$loyaltyBannerMaster->banner_img}}">
</div> 
<?php }?>
<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('loyaltyBannerMasters.index') }}" class="btn btn-default">Cancel</a>
</div>

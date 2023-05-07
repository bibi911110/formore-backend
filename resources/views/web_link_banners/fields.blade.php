<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Link Field -->
<div class="form-group">
    {!! Form::label('link', 'Link:') !!}
    {!! Form::text('link', null, ['class' => 'form-control']) !!}
</div>

<!-- Web Image Field -->
<!-- <div class="form-group">
    {!! Form::label('web_image', 'Web Image:') !!}
    {!! Form::text('web_image', null, ['class' => 'form-control']) !!}
</div> -->
<div class="form-group">
    {!! Form::label('web_image', 'Banner Image:') !!}
    {!! Form::file('web_image', null, ['class' => 'form-control']) !!}
</div>
 <?php if (isset($webLinkBanners->web_image)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$webLinkBanners->web_image; ?>" style="width: 9%"  >
     <input type="hidden" name="web_image" value="{{$webLinkBanners->web_image}}">
</div> 
<?php }?>

<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('webLinkBanners.index') }}" class="btn btn-default">Cancel</a>
</div>

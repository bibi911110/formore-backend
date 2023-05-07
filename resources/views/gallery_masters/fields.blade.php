
<div class="form-group">
    {!! Form::label('gallery_img', 'Image:') !!}
    {!! Form::file('gallery_img', null, ['class' => 'form-control']) !!}
</div>
 <?php if (isset($galleryMaster->gallery_img)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$galleryMaster->gallery_img; ?>" style="width: 9%"  >
     <input type="hidden" name="gallery_img" value="{{$galleryMaster->gallery_img}}">
</div> 
<?php }?>
<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('galleryMasters.index') }}" class="btn btn-default">Cancel</a>
</div>

<!-- Language Name Field -->
<div class="form-group">
    {!! Form::label('language_name', 'Language Name:') !!}
    {!! Form::text('language_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('icon_img', 'Icon Image:') !!}
    {!! Form::file('icon_img', null, ['class' => 'form-control']) !!}
</div>
 <?php if (isset($language->icon_img)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$language->icon_img; ?>" style="width: 9%"  >
     <input type="hidden" name="icon_img" value="{{$language->icon_img}}">
</div> 
<?php }?>



<!-- Status Field -->
<!-- <div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>
 -->
<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('languages.index') }}" class="btn btn-default">Cancel</a>
</div>

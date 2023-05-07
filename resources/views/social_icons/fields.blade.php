<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>


<!-- Link Field -->
<div class="form-group">
    {!! Form::label('link', 'Link:') !!}
    {!! Form::text('link', null, ['class' => 'form-control']) !!}
</div>

<!-- Social Icon Field -->
<!-- <div class="form-group">
    {!! Form::label('social_icon', 'Social Icon:') !!}
    {!! Form::text('social_icon', null, ['class' => 'form-control']) !!}
</div> -->
<div class="form-group">
    {!! Form::label('social_icon', 'Icon Image:') !!}
    {!! Form::file('social_icon', null, ['class' => 'form-control']) !!}
</div>
 <?php if (isset($socialIcon->social_icon)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$socialIcon->social_icon; ?>" style="width: 9%"  >
     <input type="hidden" name="social_icon" value="{{$socialIcon->social_icon}}">
</div> 
<?php }?>
<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('socialIcons.index') }}" class="btn btn-default">Cancel</a>
</div>

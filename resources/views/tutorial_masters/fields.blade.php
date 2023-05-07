
<div class="form-group">
    {!! Form::label('language_id', 'English Language:') !!}
    {!! Form::select('language_id', [''=>'Select Language'] + $language->toArray(), null, ['class' => 'form-control buss_id_country','id' => 'buss_id']) !!}
</div>
<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Details Field -->
<div class="form-group">
    {!! Form::label('details', 'Details:') !!}
    {!! Form::textarea('details', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('youtube_url', 'Youtube Link:') !!}
    {!! Form::text('youtube_url', null, ['class' => 'form-control']) !!}
</div>
<!-- Tutorial Video Field -->
<div class="form-group">
    {!! Form::label('tutorial_video', 'Tutorial Video:') !!}
    {!! Form::file('tutorial_video') !!}
</div>

 <?php if (isset($tutorialMaster->tutorial_video)) {?>
    <div class="form-group">
     <!-- <img src="<?php echo  url('/').'/'.$tutorialMaster->tutorial_video; ?>" style="width: 9%"  > -->

    <video width="240" height="240" controls>
          <source src="<?php echo  url('/').'/'.$tutorialMaster->tutorial_video; ?>" type="video/mp4">
          <!-- <source src="movie.ogg" type="video/ogg"> -->
    </video> 

     <input type="hidden" name="tutorial_video" value="{{$tutorialMaster->tutorial_video}}">
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
    <a href="{{ route('tutorialMasters.index') }}" class="btn btn-default">Cancel</a>
</div>

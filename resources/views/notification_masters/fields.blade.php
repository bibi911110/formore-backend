<div class="form-group">
   <!--  {!! Form::label('user_id', 'App User:') !!}
    {!! Form::select('user_id[]', [''=>'Select User'] + $user->toArray(), null, ['class' => 'form-control','multiple']) !!} -->
    {!! Form::label('user_id', 'App User:') !!}
    {!! Form::select('user_id[]', $user->toArray(), null, ['class' => 'form-control select-chosen', 'id' =>'example-chosen-multiple','multiple','data-placeholder'=>'Select User']) !!}
</div>
<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Business:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Details Field -->
<div class="form-group">
    {!! Form::label('details', 'Message:') !!}
    {!! Form::text('details', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('comments', 'Comments:') !!}
    {!! Form::text('comments', null, ['class' => 'form-control']) !!}
</div>

<!-- Notification Image Field -->
<div class="form-group">
    {!! Form::label('notification_image', 'Notification Image:') !!}
    {!! Form::file('notification_image') !!}
</div>
<?php if (isset($notificationMaster->notification_image)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$notificationMaster->notification_image; ?>" style="width: 9%"  >
     <input type="hidden" name="icon_img" value="{{$notificationMaster->notification_image}}">
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
    <a href="{{ route('notificationMasters.index') }}" class="btn btn-default">Cancel</a>
</div>

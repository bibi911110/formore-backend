<!-- Buss Id Field -->

<div class="form-group">
    {!! Form::label('buss_id', 'Business Name:') !!}
    {!! Form::select('buss_id', [''=>'Select Business'] + $buss->toArray(), null, ['class' => 'form-control segment_id','id'=>'']) !!}
</div>

<!-- Segment Id Field -->
@if(isset($flagSelection->segment_id))
    <div class="form-group">
    {!! Form::label('segment_id', 'Segment:') !!}
    {!! Form::select('segment_id', [''=>'Select Segment'] + $segments_data->toArray(), $flagSelection->segment_id, ['class' => 'form-control segment_id','id'=>'']) !!}
</div>
@else
<div class="form-group">
    {!! Form::label('segment_id', 'Segment:') !!}
    {!! Form::select('segment_id', [''=>'Select Segment'],null,['class' => 'form-control','id'=>'segment_data']) !!}
</div>
@endif
@if(isset($flagSelection->segment_id))
<div class="form-group">
    {!! Form::label('user_id', 'User:') !!}
   {!! Form::select('user_id', $users->toArray(), null, ['class' => 'form-control select-chosen user', 'id' =>'example-chosen-multiple','data-placeholder'=>'Select User']) !!} 
</div>
@else
<div class="form-group">
    {!! Form::label('user_id', 'User:') !!}
   {!! Form::select('user_id[]', $users->toArray(), null, ['class' => 'form-control select-chosen user', 'id' =>'example-chosen-multiple','multiple','data-placeholder'=>'Select User']) !!} 
</div>
@endif

<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('flagSelections.index') }}" class="btn btn-default">Cancel</a>
</div>

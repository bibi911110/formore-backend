<!-- Segment Name Field -->
<div class="form-group">
    {!! Form::label('segment_name', 'Segment Name:') !!}
    {!! Form::text('segment_name', null, ['class' => 'form-control','id'=>'example-nf-name']) !!}
     <!-- <span class="help-block">Please enter your segment name</span> -->
</div>

<!-- Status Field -->
<!-- <div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('segments.index') }}" class="btn btn-default">Cancel</a>
</div>

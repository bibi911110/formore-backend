<!-- Language Name Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User ID:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>
<!-- Status Field -->
<!-- <div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>
 -->
<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
    <!-- <a href="{{ route('languages.index') }}" class="btn btn-default">Cancel</a> -->
</div>

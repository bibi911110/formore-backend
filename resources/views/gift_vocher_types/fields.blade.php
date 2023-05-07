<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Transaction type:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<!-- <div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div> -->
<!-- <input type="hidden" name="status" value="1"> -->
<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('giftVocherTypes.index') }}" class="btn btn-default">Cancel</a>
</div>

<div class="form-group">
    {!! Form::label('buss_id', 'Business :') !!}
    {!! Form::select('buss_id', [''=>'Select Business'] + $buss->toArray(), null, ['class' => 'form-control', 'id' =>'stateId']) !!}

</div>
<div class="form-group">
    {!! Form::label('user_id', 'User:') !!}
    {!! Form::select('user_id[]', $users->toArray(), null, ['class' => 'form-control select-chosen', 'id' =>'example-chosen-multiple','multiple','data-placeholder'=>'Select User']) !!}

</div>

<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('ratings.index') }}" class="btn btn-default">Cancel</a>
</div>

<!-- User Id Field -->
<!-- <div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Rating No Field -->
<!-- <div class="form-group">
    {!! Form::label('rating_no', 'Rating No:') !!}
    {!! Form::text('rating_no', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Comment Field -->
<!-- <div class="form-group">
    {!! Form::label('comment', 'Comment:') !!}
    {!! Form::text('comment', null, ['class' => 'form-control']) !!}
</div>
 -->
<!-- Status Field -->
<!-- <div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>
 -->
<!-- Submit Field -->
<!-- <div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('ratings.index') }}" class="btn btn-default">Cancel</a>
</div> -->

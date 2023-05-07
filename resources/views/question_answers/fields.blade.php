<!-- Question Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('question_id', 'Question Id:') !!}
    {!! Form::text('question_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Select Ans Field -->
<div class="form-group col-sm-6">
    {!! Form::label('select_ans', 'Select Ans:') !!}
    {!! Form::text('select_ans', null, ['class' => 'form-control']) !!}
</div>

<!-- Range Ans Field -->
<div class="form-group col-sm-6">
    {!! Form::label('range_ans', 'Range Ans:') !!}
    {!! Form::text('range_ans', null, ['class' => 'form-control']) !!}
</div>

<!-- Rating Ans Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rating_ans', 'Rating Ans:') !!}
    {!! Form::text('rating_ans', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('questionAnswers.index') }}" class="btn btn-default">Cancel</a>
</div>

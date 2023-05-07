<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $questionAnswer->id }}</p>
</div>

<!-- Question Id Field -->
<div class="form-group">
    {!! Form::label('question_id', 'Question Id:') !!}
    <p>{{ $questionAnswer->question_id }}</p>
</div>

<!-- Select Ans Field -->
<div class="form-group">
    {!! Form::label('select_ans', 'Select Ans:') !!}
    <p>{{ $questionAnswer->select_ans }}</p>
</div>

<!-- Range Ans Field -->
<div class="form-group">
    {!! Form::label('range_ans', 'Range Ans:') !!}
    <p>{{ $questionAnswer->range_ans }}</p>
</div>

<!-- Rating Ans Field -->
<div class="form-group">
    {!! Form::label('rating_ans', 'Rating Ans:') !!}
    <p>{{ $questionAnswer->rating_ans }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $questionAnswer->user_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $questionAnswer->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $questionAnswer->updated_at }}</p>
</div>


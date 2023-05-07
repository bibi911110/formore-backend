<!-- Name Field -->
<!-- User Id Field -->
<div class="form-group">

	{!! Form::label('user_id', 'User:') !!}
	{!! Form::select('user_id[]', $users->toArray(), null, ['class' => 'form-control select-chosen', 'id' =>'example-chosen-multiple','multiple','data-placeholder'=>'Select User']) !!}
	
    <!-- {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!} -->
</div>
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('notes', 'Notes:') !!}
    {!! Form::text('notes', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('code', 'Code:') !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

 <div class="form-group">
    {!! Form::label('q_date', 'Date:') !!}
    @if(isset($question->q_date))
    {!! Form::text('q_date', date('Y-m-d',strtotime($question->q_date)), ['class' => 'form-control input-datepicker','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
    @else
        {!! Form::text('q_date', null, ['class' => 'form-control input-datepicker22','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
    @endif
    </div>
<div class="form-group">
        {!! Form::label('msg_eng', 'Message Eng:') !!}
        {!! Form::textarea('msg_eng', null, ['class' => 'form-control','rows' => 3]) !!}
    </div>
    <div class="form-group">
        {!! Form::label('msg_italian', 'Message Italian:') !!}
        {!! Form::textarea('msg_italian', null, ['class' => 'form-control','rows' => 3]) !!}
    </div>
    <div class="form-group">
        {!! Form::label('msg_greek', 'Message Greek:') !!}
        {!! Form::textarea('msg_greek', null, ['class' => 'form-control','rows' => 3]) !!}
    </div>
    <div class="form-group">
        {!! Form::label('msg_albanian', 'Message Albanian:') !!}
        {!! Form::textarea('msg_albanian', null, ['class' => 'form-control','rows' => 3]) !!}
    </div>
<div class="form-group">
	{!! Form::label('question_data', 'Download Sample Excel:') !!}
	<a download ="questions.xlsx" href="/public/excel/sample_file/questions.xlsx">Download</a>

</div>
<div class="form-group">
    {!! Form::label('question_data', 'Question Excel:') !!}
    {!! Form::file('question_data', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->


<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Send', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('questions.index') }}" class="btn btn-default">Cancel</a>
</div>

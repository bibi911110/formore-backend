<div class="form-group" id="campaign_cat" >
    {!! Form::label('Day', 'Select Day:') !!}
    {!! Form::select('day', [''=>'Select Day','Sunday' => 'Sunday',"Monday" => 'Monday',"Tuesday" => 'Tuesday',"Wednesday" => 'Wednesday',"Thursday" =>'Thursday',"Friday" =>'Friday',"Saturday" =>'Saturday'], null, ['class' => 'form-control','id' => 'campaign_type']) !!}
</div>

<!-- Submit Field -->
<div class="form-grou">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('weekOffMasters.index') }}" class="btn btn-default">Cancel</a>
</div>

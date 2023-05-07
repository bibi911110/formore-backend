<!-- Date Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>
 <!-- Start Date Field -->
    <div class="form-group">
        {!! Form::label('holiday_date', 'Start Date:') !!}
        @if(isset($holidayMaster->holiday_date))
        {!! Form::text('holiday_date', date('Y-m-d',strtotime($holidayMaster->holiday_date)), ['class' => 'form-control input-datepicker','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
        @else
            {!! Form::text('holiday_date', null, ['class' => 'form-control input-datepicker22','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
        @endif
    </div>


<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('holidayMasters.index') }}" class="btn btn-default">Cancel</a>
</div>

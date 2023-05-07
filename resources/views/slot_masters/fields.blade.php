<div class="form-group" id="campaign_cat" >
    {!! Form::label('start_time', 'Select Start Time:') !!}
    {!! Form::select('start_time', [''=>'Select Start Time','01:00' => '01:00',"02:00" => '02:00',"03:00" => '03:00',"04:00" => '04:00',"05:00" =>'05:00',"06:00" =>'06:00',"07:00" =>'07:00',"08:00" =>'08:00',"09:00" =>'09:00',"10:00" =>'10:00',"11:00" =>'11:00',"12:00" =>'12:00',"13:00" =>'13:00',"14:00" =>'14:00',"15:00" =>'15:00',"16:00" =>'16:00',"17:00" =>'17:00',"18:00" =>'18:00',"19:00" =>'19:00',"20:00" =>'20:00',"21:00" =>'21:00',"22:00" =>'22:00',"23:00" =>'23:00',"24:00" =>'24:00'], null, ['class' => 'form-control','id' => 'campaign_type']) !!}
</div>

<!-- End Time Field -->
<div class="form-group" id="campaign_cat" >
    {!! Form::label('end_time', 'Select End Time:') !!}
      {!! Form::select('end_time', [''=>'Select Start Time','01:00' => '01:00',"02:00" => '02:00',"03:00" => '03:00',"04:00" => '04:00',"05:00" =>'05:00',"06:00" =>'06:00',"07:00" =>'07:00',"08:00" =>'08:00',"09:00" =>'09:00',"10:00" =>'10:00',"11:00" =>'11:00',"12:00" =>'12:00',"13:00" =>'13:00',"14:00" =>'14:00',"15:00" =>'15:00',"16:00" =>'16:00',"17:00" =>'17:00',"18:00" =>'18:00',"19:00" =>'19:00',"20:00" =>'20:00',"21:00" =>'21:00',"22:00" =>'22:00',"23:00" =>'23:00',"24:00" =>'24:00'], null, ['class' => 'form-control','id' => 'campaign_type']) !!}
</div>
<!-- <div class="form-group">
    {!! Form::label('end_time', 'End Time:') !!}
    {!! Form::text('end_time', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Pepole Per Slot Field -->
<div class="form-group">
    {!! Form::label('pepole_per_slot', 'Pepole Per Slot:') !!}
    {!! Form::text('pepole_per_slot', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Per Slot Field -->
<div class="form-group">
    {!! Form::label('price_per_slot', 'Price Per Slot:') !!}
    {!! Form::text('price_per_slot', null, ['class' => 'form-control']) !!}
</div>



<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('slotMasters.index') }}" class="btn btn-default">Cancel</a>
</div>

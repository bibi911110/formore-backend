<!-- Image 1 Field -->
<div class="form-group">
    {!! Form::label('image_1', 'Image 1:') !!}
    {!! Form::file('image_1') !!}
</div>
<?php if (isset($promotionalImageMaster->image_1)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$promotionalImageMaster->image_1; ?>" style="width: 9%"  >
     <input type="hidden" name="image_1" value="{{$promotionalImageMaster->image_1}}">
     <input type="checkbox" name="image_1_check" value="1">Is Deleted
</div> 
<?php }?>

<!-- Counter 1 Field -->
<div class="form-group">
    {!! Form::label('counter_1', 'Duration Time 1:') !!}
    {!! Form::text('counter_1', null, ['class' => 'form-control']) !!}
</div>


<!-- Image 2 Field -->
<div class="form-group">
    {!! Form::label('image_2', 'Image 2:') !!}
    {!! Form::file('image_2') !!}
</div>
<?php if (isset($promotionalImageMaster->image_2)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$promotionalImageMaster->image_2; ?>" style="width: 9%"  >
     <input type="hidden" name="image_2" value="{{$promotionalImageMaster->image_2}}">
     <input type="checkbox" name="image_2_check" value="1">Is Deleted
</div> 
<?php }?>


<!-- Counter 2 Field -->
<div class="form-group">
    {!! Form::label('counter_2', 'Duration Time 2:') !!}
    {!! Form::text('counter_2', null, ['class' => 'form-control']) !!}
</div>

<!-- Image 3 Field -->
<div class="form-group">
    {!! Form::label('image_3', 'Image 3:') !!}
    {!! Form::file('image_3') !!}
</div>
<?php if (isset($promotionalImageMaster->image_3)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$promotionalImageMaster->image_3; ?>" style="width: 9%"  >
     <input type="hidden" name="image_3" value="{{$promotionalImageMaster->image_3}}">
     <input type="checkbox" name="image_3_check" value="1">Is Deleted
</div> 
<?php }?>


<!-- Counter 3 Field -->
<div class="form-group">
    {!! Form::label('counter_3', 'Duration Time 3:') !!}
    {!! Form::text('counter_3', null, ['class' => 'form-control']) !!}
</div>

<!-- Image 4 Field -->
<div class="form-group">
    {!! Form::label('image_4', 'Image 4:') !!}
    {!! Form::file('image_4') !!}
</div>
<?php if (isset($promotionalImageMaster->image_4)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$promotionalImageMaster->image_4; ?>" style="width: 9%"  >
     <input type="hidden" name="image_4" value="{{$promotionalImageMaster->image_4}}">
     <input type="checkbox" name="image_4_check" value="1">Is Deleted
</div> 
<?php }?>


<!-- Counter 4 Field -->
<div class="form-group">
    {!! Form::label('counter_4', 'Duration Time 4:') !!}
    {!! Form::text('counter_4', null, ['class' => 'form-control']) !!}
</div>

<!-- Image 5 Field -->
<div class="form-group">
    {!! Form::label('image_5', 'Image 5:') !!}
    {!! Form::file('image_5') !!}
</div>
<?php if (isset($promotionalImageMaster->image_5)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$promotionalImageMaster->image_5; ?>" style="width: 9%"  >
     <input type="hidden" name="image_5" value="{{$promotionalImageMaster->image_5}}">
     <input type="checkbox" name="image_5_check" value="1">Is Deleted
</div> 
<?php }?>

<!-- Counter 5 Field -->
<div class="form-group">
    {!! Form::label('counter_5', 'Duration Time 5:') !!}
    {!! Form::text('counter_5', null, ['class' => 'form-control']) !!}
</div>


<!-- popup img 5 Field -->
<div class="form-group">
    {!! Form::label('popup_img', 'Popup Image:') !!}
    {!! Form::file('popup_img') !!}
</div>
<?php if (isset($promotionalImageMaster->popup_img)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$promotionalImageMaster->popup_img; ?>" style="width: 9%"  >
     <input type="hidden" name="popup_img" value="{{$promotionalImageMaster->popup_img}}">
</div> 
<?php }?>
 <div class="form-group">
        {!! Form::label('from_date', 'Publish Date:') !!}
        @if(isset($promotionalImageMaster->from_date))
        {!! Form::text('from_date', date('Y-m-d',strtotime($promotionalImageMaster->from_date)), ['class' => 'form-control input-datepicker','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
        @else
            {!! Form::text('from_date', null, ['class' => 'form-control input-datepicker22','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
        @endif
    </div>
    

    <!-- End Date Field -->
    <div class="form-group">
        {!! Form::label('to_date', 'To Date:') !!}
        @if(isset($promotionalImageMaster->to_date))
        {!! Form::text('to_date', date('Y-m-d',strtotime($promotionalImageMaster->to_date)), ['class' => 'form-control input-datepickerStart','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
        @else
            {!! Form::text('to_date', null, ['class' => 'form-control input-datepickerStart','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
        @endif
    </div>


<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <!-- <a href="{{ route('promotionalImageMasters.index') }}" class="btn btn-default">Cancel</a> -->
</div>

<!-- Name Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Type Code Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('type_code', 'Type Code:') !!}
    {!! Form::text('type_code', null, ['class' => 'form-control']) !!}
</div>
 -->
<!-- Upload Photo Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('upload_photo', 'Upload Photo:') !!}
    {!! Form::file('upload_photo') !!}
</div>
<div class="clearfix"></div> -->

<div class="form-group">
    {!! Form::label('barcode_image', 'Barcode:') !!}
    {!! Form::file('barcode_image') !!}
</div>
<?php if (isset($otherProgramMaster->barcode_image)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$otherProgramMaster->barcode_image; ?>" style="width: 9%"  >
     <input type="hidden" name="barcode_image" value="{{$otherProgramMaster->barcode_image}}">
</div> 
<?php }?>


<div class="form-group">
    {!! Form::label('qr_code_img', 'Qrcode:') !!}
    {!! Form::file('qr_code_img') !!}
</div>
<?php if (isset($otherProgramMaster->qr_code_img)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$otherProgramMaster->qr_code_img; ?>" style="width: 9%"  >
     <input type="hidden" name="qr_code_img" value="{{$otherProgramMaster->qr_code_img}}">
</div> 
<?php }?>


<!-- Surname Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('surname', 'Surname:') !!}
    {!! Form::text('surname', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('otherProgramMasters.index') }}" class="btn btn-default">Cancel</a>
</div>

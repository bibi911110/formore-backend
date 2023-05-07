
<!-- Header Banner Field -->
<!-- <div class="form-group ">
    {!! Form::label('header_banner', 'Header Banner:') !!}
    {!! Form::file('header_banner') !!}
</div> -->

<div class="form-group">
    {!! Form::label('logo', 'Logo:') !!}
    {!! Form::file('logo', null, ['class' => 'form-control']) !!}
</div>
 <?php if (isset($userBusinessDetails->logo)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$userBusinessDetails->logo; ?>" style="width: 9%"  >
     <input type="hidden" name="logo" value="{{$userBusinessDetails->logo}}">
</div> 
<?php }?>
<div class="clearfix"></div>
<div class="form-group">
    {!! Form::label('header_banner', 'Header Banner:') !!}
    {!! Form::file('header_banner', null, ['class' => 'form-control']) !!}
</div>
 <?php if (isset($userBusinessDetails->header_banner)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$userBusinessDetails->header_banner; ?>" style="width: 9%"  >
     <input type="hidden" name="header_banner" value="{{$userBusinessDetails->header_banner}}">
</div> 
<?php }?>

<!-- Business Name Field -->
<!-- <div class="form-group ">
    {!! Form::label('business_name', 'Business Name:') !!}
    {!! Form::text('business_name', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Map Link Field -->
<div class="form-group ">
    {!! Form::label('map_link', 'Map Link:') !!}
    {!! Form::text('map_link', null, ['class' => 'form-control']) !!}
</div>

<!-- User Available Points Field -->
<!-- <div class="form-group ">
    {!! Form::label('user_available_points', 'Total Available Points:') !!}
    {!! Form::text('user_available_points', null, ['class' => 'form-control']) !!}
</div> -->

<!-- E Shop Banner Field -->
<!-- <div class="form-group ">
    {!! Form::label('e_shop_banner', 'E Shop Banner:') !!}
    {!! Form::file('e_shop_banner') !!}
</div>
 -->
 <div class="form-group">
    {!! Form::label('e_shop_banner', 'E Shop Banner:') !!}
    {!! Form::file('e_shop_banner', null, ['class' => 'form-control']) !!}
</div>
 <?php if (isset($userBusinessDetails->e_shop_banner)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$userBusinessDetails->e_shop_banner; ?>" style="width: 9%"  >
     <input type="hidden" name="e_shop_banner" value="{{$userBusinessDetails->e_shop_banner}}">
</div> 
<?php }?>
<div class="clearfix"></div>
<!-- Booking Banner Field -->
<!-- <div class="form-group ">
    {!! Form::label('booking_banner', 'Booking Banner:') !!}
    {!! Form::text('booking_banner', null, ['class' => 'form-control']) !!}
</div> -->

<div class="form-group">
    {!! Form::label('booking_banner', 'Booking Banner:') !!}
    {!! Form::file('booking_banner', null, ['class' => 'form-control']) !!}
</div>
 <?php if (isset($userBusinessDetails->booking_banner)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$userBusinessDetails->booking_banner; ?>" style="width: 9%"  >
     <input type="hidden" name="booking_banner" value="{{$userBusinessDetails->booking_banner}}">
</div> 
<?php }?>

<!-- Logo Field -->
<!-- <div class="form-group ">
    {!! Form::label('logo', 'Logo:') !!}
    {!! Form::text('logo', null, ['class' => 'form-control']) !!}
</div> -->



<!-- Submit Field -->
<div class="form-group ">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('userBusinessDetails.index') }}" class="btn btn-default">Cancel</a>
</div>







@extends('layouts.app')
@section('title','Find A Member')
@section('content')
 <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
           <!-- Normal Form Block -->
            <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                    <h2><strong>@if(@$business_details->stamp_point == 1 ) Stamp @else Point @endif </strong> </h2>
                </div>                
                    {!! Form::open(['route' => 'rewards_submit', 'files' => true]) !!}
                    
                    <input type="hidden" name="user_id" value="{{$user_details->id}}">
                        <!-- Language Name Field -->
                        
                        <div class="row">
                            <div class="form-group">
                                {!! Form::label('user_id', 'User Name:') !!}
                                {!! Form::label('user_id', $user_details->name) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('user_id', 'User Code:') !!}
                                {!! Form::label('user_id', $user_details->unique_no) !!}
                            </div>
                            <?php  $Gift_vocher_types  = \App\Models\Gift_vocher_types::where('status','1')->pluck('name','id'); ?>
                            <!-- <div class="form-group">
                                {!! Form::label('transaction_type', 'Transaction type:') !!}
                                {!! Form::select('transaction_type', [''=>'Select Transaction type'] + $Gift_vocher_types->toArray(), null, ['class' => 'form-control']) !!}
                            </div> -->
                            @if(@$business_details->stamp_point == 1)
                            <input type="hidden" name="stamp_point" value="1">
                            <input type="hidden" name="setup_level" id="setup_level" value="{{$business_stamp->setup_level}}" disabled="true">
                            <input type="hidden" name="current_stemp" id="current_stemp" value="<?php if(isset($total_stmp_point->total_stamp)){  echo $total_stmp_point->total_stamp;}else { echo 0; } ?>" disabled="true">
                            <div class="form-group">
                                <h3>Rewards</h3>
                            </div>
                            <?php  $Gift_vocher_types  = \App\Models\Gift_vocher_types::where('status','1')->pluck('name','id'); ?>
                            <div class="form-group">
                                {!! Form::label('transaction_type', 'Transaction type:') !!}
                                {!! Form::select('transaction_type', [''=>'Select Transaction type'] + $Gift_vocher_types->toArray(), null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('user_id', 'Stamp:') !!}
                                <?php // echo"<pre>"; print_r($total_stmp_point->total_stamp); exit; ?>
                                <label><?php if(isset($total_stmp_point->total_stamp)){  echo $total_stmp_point->total_stamp .'/'. $business_stamp->setup_level; } else { echo '0' .'/'. $business_stamp->setup_level;;} ?></label>
                            </div>
                            <div class="form-group">
                                
                                {!! Form::label('user_id', 'Points:') !!}
                                <label><?php if(isset($total_stmp_point->total_point)){  echo $total_stmp_point->total_point;}else { echo 0; } ?></label>
                            </div>
                            <input type="hidden" name="points" value="{{$business_stamp->point_per_stamp}}">
                            <input type="hidden" name="stamp" value="1">
                            <?php $app_info = \App\Models\App_screen_information::where('screen_name','Stamp info')->where('language_id','1')->first(); ?>
                            <div class="form-group">
                                {!! Form::label('info', 'Info:') !!}
                                <p>{!! $app_info->content !!}</p>
                            </div>
                            @else
                                <div class="form-group">
                                    <h3>Rewards</h3>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('user_id', 'Current Points:') !!}
                                    <label><?php if(isset($total_stmp_point->total_point)){  echo $total_stmp_point->total_point;}else { echo 0; } ?></label>
                                </div>
                                 <?php  $Gift_vocher_types  = \App\Models\Gift_vocher_types::where('status','1')->pluck('name','id'); ?>
                            <div class="form-group">
                                {!! Form::label('transaction_type', 'Transaction type:') !!}
                                {!! Form::select('transaction_type', [''=>'Select Transaction type'] + $Gift_vocher_types->toArray(), null, ['class' => 'form-control']) !!}
                            </div>
                                <div class="form-group">
                                    {!! Form::label('user_id', 'Amount:') !!}
                                    {!! Form::text('amount', null, ['class' => 'form-control' ,'id'=>'amount','onkeypress'=>"return isNumberKey(event)"]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('user_id', 'New Points:') !!}
                                    <label><p id="pointTxt"></p></label>
                                </div>
                                 @if(isset($flag_selection->amount))
                                     <input type="hidden" name="sg_amount" id="sg_amount" value="{{$flag_selection->amount}}">
                                     <input type="hidden" class="new_point" name="points" id="point_value" value="">
                                      <input type="hidden" name="cash_out_ration" id="cash_out_ration" value="{{$business_point->ratio_of_collecting_points}}">
                                 @else
                                    <input type="hidden" class="new_point" name="points" id="point_value" value="">
                                    <input type="hidden" name="cash_out_ration" id="cash_out_ration" value="{{@$business_point->ratio_of_collecting_points}}">
                                @endif

                            <?php $app_info = \App\Models\App_screen_information::where('screen_name','Point info')->where('language_id','1')->first(); ?>
                            <div class="form-group">
                                {!! Form::label('info', 'Info:') !!}
                                <p>{!! $app_info->content !!}</p>
                            </div>
                            @endif
                        </div>
                        
                        
                        <!-- Submit Field -->
                        <div class="form-group" id="showBtn">
                            {!! Form::submit('Confirm', ['class' => 'btn btn-primary']) !!}
                            <!-- <a href="{{ route('languages.index') }}" class="btn btn-default">Cancel</a> -->
                        </div>
                        <div class="form-group" id="showMdl" style="display: none">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myLotery_1" >Confirm</button>
                        </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
    <div id="myLotery_1" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header" style="background-color: black;color: white;">
                                      <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
                                      <h4 class="modal-title"><b>Voucher Details</b></h4>
                                    </div>
                                     <div class="modal-body">
                                        <center><p>Point limit reached</p></center>
                                    </div>
                                    <div class="modal-footer" style="background-color: black;">
                                      <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color:white;">Close</button>
                                    </div>
                                  </div>

                            </div>
                          </div>
@endsection
@push('scripts')
<script type="text/javascript">
$("#amount").focusout(function() {
    var amount = $("#amount").val();
    var cash_out_ration = $("#cash_out_ration").val();

    var newPoint = parseInt(amount) / parseInt(cash_out_ration);
    //alert(newPoint);
    
    $("#point_value").val(newPoint);
    $("#pointTxt").text(newPoint);
    //alert(cash_out_ration);


});
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

$(document).ready(function(){

    var setup_level = $('#setup_level').val();
    var current_stemp = $('#current_stemp').val();

    if(setup_level != '' && current_stemp != '')
    {
       /* if(setup_level >= current_stemp)
        {
            $("#showMdl").hide();
            $("#showBtn").show();
        }
        else
        {
            $("#showMdl").show();
            $("#showBtn").hide();

        }*/
    }
});
</script>
@endpush
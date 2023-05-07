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
                    <h2><strong>Cash Back</strong> </h2>
                </div>                
                    {!! Form::open(['route' => 'save_cash_back', 'files' => true]) !!}

                    <input type="hidden" name="user_id" value="{{$user_details->id}}">

                        <!-- Language Name Field -->
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('user_id', 'User Name:') !!}
                                {!! Form::label('user_id', $user_details->name) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('user_id', 'User Code:') !!}
                                {!! Form::label('user_id', $user_details->unique_no) !!}
                            </div>
                            
                            <div class="form-group">
                                <h3>Cashback</h3>
                            </div>
                            <!-- <div class="form-group">
                                {!! Form::label('user_id', 'Stamp:') !!}
                            </div> -->
                            <?php  $Gift_vocher_types  = \App\Models\Gift_vocher_types::where('status','1')->pluck('name','id'); ?>
                            <div class="form-group">
                                {!! Form::label('transaction_type', 'Transaction type:') !!}
                                {!! Form::select('transaction_type', [''=>'Select Transaction type'] + $Gift_vocher_types->toArray(), null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('user_id', 'Points:') !!}
                                 <?php if(isset($user_stmp_point->total_point)){ echo $user_stmp_point->total_point;}else{ echo "0";} ?>
                                <input type="hidden" name="current_points" id="current_points" value="<?php if(isset($user_stmp_point->total_point)){ echo $user_stmp_point->total_point;}else{ echo "0";} ?>" disabled>
                            </div>
                            <?php // echo $business_point->ratio_for_cash_out; exit; ?>
                            <div class="form-group">
                                {!! Form::label('user_id', 'Value:') !!}
                                <?php if(isset($business_point->ratio_for_cash_out)){ ?>
                                {!! Form::label('user_id', $business_point->ratio_for_cash_out) !!}
                                <input type="hidden" id="ratio_for_cash_out" value="{{$business_point->ratio_for_cash_out}}">
                            <?php }else{ ?>
                                {!! Form::label('user_id', $business_point->ration_of_cash_out) !!}
                                <input type="hidden" id="ratio_for_cash_out" value="{{$business_point->ration_of_cash_out}}">
                            <?php } ?>
                            </div>
                            <div class="form-group">
                                {!! Form::label('user_id', 'Receipt value:') !!}
                                {!! Form::text('cash_out_value', null, ['class' => 'form-control','id' => 'cash_out_value','onkeypress'=>"return isNumberKey(event)"]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('user_id', 'Cash Out Points:') !!}
                                {!! Form::text('cash_out_points', null, ['class' => 'form-control','id' => 'cash_out_points','onkeypress'=>"return isNumberKey(event)"]) !!}
                            </div>

                            <?php $app_info = \App\Models\App_screen_information::where('screen_name','Cashback info')->where('language_id','1')->first(); ?>
                                <div class="form-group">
                                    {!! Form::label('info', 'Info:') !!}
                                    <p>{!! $app_info->content !!}</p>
                                </div>
                        </div>
                        <!-- Submit Field -->
                        <div class="form-group">
                            <button style="margin-left: 15px;" type="button" class="btn btn-primary cash_val" data-toggle="modal" data-target="#myLotery_1">Confirm</button>
                            <!-- Modal -->
                          <div id="myLotery_1" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header" style="background-color: black;color: white;">
                                  <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
                                  <h4 class="modal-title"><b>Cash Back</b></h4>
                                </div>
                                 <div class="modal-body">
                                     
                                     <input type="hidden" name="user_id" value="{{$user_details->id}}">  
                                     <div class="form-group">
                                        {!! Form::label('user_id', 'Cash Out Value:') !!}
                                        {!! Form::text('cash_out_value_final', null, ['class' => 'form-control','id' => 'cash_out_value_final' ,'readonly']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('user_id', 'Cash Out Points:') !!}
                                        {!! Form::text('cash_out_points_final', null, ['class' => 'form-control','id' => 'cash_out_points_final','readonly']) !!}
                                    </div>

                                    <?php $app_info = \App\Models\App_screen_information::where('screen_name','Cashback details info')->where('language_id','1')->first(); ?>
                                <div class="form-group">
                                    {!! Form::label('info', 'Info:') !!}
                                    <p>{!! $app_info->content !!}</p>
                                </div>
                                 <div class="form-group">
                                 {!! Form::submit('Confirm', ['class' => 'btn btn-primary cash_val','id'=>'cash_val']) !!}        
                                </div>
                                </div>
                                    
                                <div class="modal-footer" style="background-color: black;">
                                  <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color:white;">Close</button>
                                </div>
                              </div>

                            </div>
                          </div>
                            <!-- <a href="{{ route('languages.index') }}" class="btn btn-default">Cancel</a> -->
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script type="text/javascript">
$("#cash_out_value").focusout(function() {
    var cash_out_value = $("#cash_out_value").val();
    var ratio_for_cash_out = $("#ratio_for_cash_out").val();


    $("#cash_out_value_final").val(cash_out_value)
    var point_value = parseInt(cash_out_value) / parseInt(ratio_for_cash_out);

    var current_points = $('#current_points').val();
   
    if(current_points > point_value){
        //alert('yes')
        $("#cash_out_points").val(Math.ceil(point_value));
        //alert(Math.ceil(point_value));
        $("#cash_out_points_final").val(Math.ceil(point_value));
        $(".cash_val").attr('disabled',false);
    }
    else
       
    {
       alert('You do not have enough available points');
       $(".cash_val").attr('disabled',true);

    }
    

});
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>
@endpush
@extends('layouts.app')
@section('title','Voucher Details')
@section('content')
 <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
           <!-- Normal Form Block -->
            <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                    <h2><strong>Voucher </strong> Details</h2>
                </div>                
                    
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
                            <div class="col-md-12">
                                 @foreach($memberVoucher as $voucher)                                 
                                        
                                            <div class="form-group col-md-3">
                                             <img src="<?php echo  url('/').'/'. $voucher['banner_image']; ?>" data-toggle="modal" data-target="#myLotery_{{$voucher->id}}" style="width: 20%">
                                        </div>
                                        
                               <!-- Modal -->
                          <div id="myLotery_{{$voucher->id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">
                              {!! Form::open(['route' => 'credit_member_voucher', 'files' => true]) !!}
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header" style="background-color: black;color: white;">
                                  <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
                                  <h4 class="modal-title"><b>Voucher Details</b></h4>
                                </div>
                                 <div class="modal-body">
                                     <input type="hidden" name="voucher_id" value="{{$voucher->id}}">
                                     <input type="hidden" name="user_id" value="{{$user_details->id}}">
                                     <center>  
                                     <img src="<?php echo  url('/').'/'. $voucher['banner_image']; ?>" data-toggle="modal" data-target="#myLotery_{{$voucher->id}}" style="width: 35%">
                                     </center>
                                     <?php $app_info = \App\Models\App_screen_information::where('screen_name','Voucher detail info')->where('language_id','1')->first(); ?>
                            <div class="form-group">
                                {!! Form::label('info', 'Info:') !!}
                                <p>{!! $app_info->content !!}</p>
                            </div>
                                </div>

                                

                                 <div class="form-group col-md-offset-6" style="margin-left: 47%;">
                                        {!! Form::submit('Confirm', ['class' => 'btn btn-primary']) !!}
                                </div>                                     
                                {!! Form::close() !!}
                                    
                                <div class="modal-footer" style="background-color: black;">
                                  <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color:white;">Close</button>
                                </div>
                              </div>

                            </div>
                          </div>                  
                    

                          
                      
                            @endforeach
                        </div>
                        </div>
                        <?php $app_info = \App\Models\App_screen_information::where('screen_name','Voucher info')->where('language_id','1')->first(); ?>
                            <div class="form-group">
                                {!! Form::label('info', 'Info:') !!}
                                <p>{!! $app_info->content !!}</p>
                            </div>
                       
                    
                </div>
            </div>
        </div>
    </div>
@endsection




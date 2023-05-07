@extends('layouts.app')
@section('title','Find A Member')
@section('content')
 <div class="content" >
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
           <!-- Normal Form Block -->
            <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                    <h2><strong>Find A </strong> Member</h2>
                </div>                
                    {!! Form::open(['route' => 'findMemberDetails', 'files' => true]) !!}
                        <!-- Language Name Field -->
                        <div class="row">
                            <div class="col-sm-6 col-lg-3">
                                <!-- Widget -->
                                <a href="{{url('rewards_details').'/'.$userDetails->id}}" class="widget widget-hover-effect1" style="background-color: #e67e22;color: white;">
                                    <div class="widget-simple">
                                        <div class="widget-icon pull-left themed-background-autumn animation-fadeIn">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                        <h3 class="widget-content text-right animation-pullDown">
                                        <strong>Rewards</strong><br>
                                            
                                        </h3>
                                    </div>
                                </a>
                                <!-- END Widget -->
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <!-- Widget -->
                                
                                <a href="{{url('get_member_voucher').'/'.$userDetails->id}}" class="widget widget-hover-effect1" style="background-color: #27ae60;color: white;color: white;">
                                    <div class="widget-simple">
                                       <div class="widget-icon pull-left themed-background-spring animation-fadeIn">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                        <h3 class="widget-content text-right animation-pullDown">
                                             <strong>Member Vouchers</strong><br>
                                            
                                        </h3>
                                    </div>
                                </a>
                                <!-- END Widget -->
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <!-- Widget -->
                                <a href="{{url('get_give_voucher').'/'.$userDetails->id}}" class="widget widget-hover-effect1" style="background-color:#af64cc;color: white;">
                                    <div class="widget-simple">
                                        <div class="widget-icon pull-left themed-background-amethyst animation-fadeIn" >
                                            <i class="fa fa-file-text"></i>
                                        </div> 
                                        <h3 class="widget-content text-right animation-pullDown">
                                             <strong>Give Vouchers</strong><br>
                                            
                                        </h3>
                                    </div>
                                </a>
                                <!-- END Widget -->
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <!-- Widget -->
                                <a href="{{url('cash_back').'/'.$userDetails->id}}" class="widget widget-hover-effect1" style="background-color:#e74c3c;color: white;">
                                    <div class="widget-simple">
                                      <div class="widget-icon pull-left themed-background-fire animation-fadeIn">
                                            <i class="gi gi-usd"></i>
                                        </div>

                                        <h3 class="widget-content text-right animation-pullDown">
                                        <strong>Cash Back</strong>
                                            
                                        </h3>
                                    </div>
                                </a>
                                <!-- END Widget -->
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <!-- Widget -->
                                <a href="#" class="widget widget-hover-effect1" style="background-color:#e67e22;color: white;;">
                                    <div class="widget-simple">
                                       <div class="widget-icon pull-left themed-background-autumn animation-fadeIn">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                        <h3 class="widget-content text-right animation-pullDown">
                                        <strong>Appointments</strong>
                                            
                                        </h3>
                                    </div>
                                </a>
                                <!-- END Widget -->
                            </div>
                        </div>
                        <!-- Status Field -->
                        <!-- <div class="form-group">
                            {!! Form::label('status', 'Status:') !!}
                            {!! Form::text('status', null, ['class' => 'form-control']) !!}
                        </div>
                        -->
                        <!-- Submit Field -->
                        <div class="form-group">
                            <!-- {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!} -->
                            <!-- <a href="{{ route('languages.index') }}" class="btn btn-default">Cancel</a> -->
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection




@extends('layouts.app')
@section('title','Lottery Code Details')
@section('content')
<!-- Datatables Content -->
  <div class="block full">
      <div class="block-title">
          <h2><strong>Lottery Code Details</strong> </h2>
          <!--  <h1 class="pull-right">
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('vouchers.create') }}">Add New</a>
          </h1> -->
      </div>
        @include('flash::message')
      <div class="table-responsive">
         <table id="role-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Business Name</th>
                        <th class="text-center">Code</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Start Date</th>
                        <th class="text-center">End Date</th>
                        <th class="text-center">Lottery Code</th>
                      <!-- <th class="text-center">Actions</th> -->
                  </tr>
              </thead>
              <tbody>
                  <?php $i =1;?>
                  @foreach ($data as $key => $vouchers)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{ $vouchers->bussName }}</td>
                      <td class="text-center">{{ $vouchers->code }}</td>
                      <td class="text-center">{{ $vouchers->voucherCategory }}</td>
                      <td class="text-center">{{date('Y-m-d',strtotime($vouchers->start_date))}}</td>
                      <td class="text-center">{{date('Y-m-d',strtotime($vouchers->end_date))}}</td>
                      @if($vouchers->scenario_type == 1)
                      <td class="text-center">
                       <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myLotery_{{$i}}">Lottery Details</button>

                          <!-- Modal -->
                          <div id="myLotery_{{$i}}" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header" style="background-color: black;color: white;">
                                  <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
                                  <h4 class="modal-title"><b>Used Voucher Details</b></h4>
                                </div>
                                <div class="" >
                                  <h1 class="pull-right" >
                                         <a  class="btn btn-primary pull-right" style="margin-right: 5%;" href="<?php echo url('export_upload_scenario_1/'.$vouchers->id) ?>">Excel Download</a>
                                  </h1>
                                </div>
                                <hr>
                                 <div class="modal-body">  
                                   <?php $loteryData = \App\Models\Loyalty_code_scenario1::where('voucher_id',$vouchers->id)->get();
                                   
                                    if(!empty($loteryData) && count($loteryData) != '0')
                                    {
                                   ?>
                                   <?php foreach ($loteryData as $lotery) { ?>
                                   
                                    <div class="row">
                                        <div class="col-md-6">
                                          <b>Code - </b>{{$lotery->voucher_code}}
                                        </div>
                                        
                                        <div class="col-md-6">
                                          <b>User Name - </b> <?php $user_data = \App\User::where('id',$lotery->user_id)->select('id','name')->first(); 
                                            if(isset($user_data->name)){ echo $user_data->name;} else { echo '--';}
                                           ?>

                                        </div>
                                      </div>
                                    <hr>
                                  <?php } 
                                  } else {
                                    echo "All Code are exist please update Your record";

                                  } ?>
                              </div>
                                    
                                <div class="modal-footer" style="background-color: black;">
                                  <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color:white;">Close</button>
                                </div>
                              </div>

                            </div>
                          </div>
                      </td>
                      @else
                      <td class="text-center"> - </td>
                      @endif
                      <!-- <td class="text-center">
                          {!! Form::open(['route' => ['vouchers.destroy', $vouchers->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                                           
                                <a href="{{ route('vouchers.edit', $vouchers->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                                {!! Form::button('<i class="fa fa-times"></i>', [
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'onclick' => "return confirm('Are you sure?')"
                                ]) !!}
                            </div>
                            {!! Form::close() !!}
                      </td> -->
                    </tr>
                  @endforeach
                                
              </tbody>
          </table>
      </div>
  </div>
  <!-- END Datatables Content -->
@endsection
@section('scripts')
    <script src="{{url('public/new/js/pages/tablesDatatables.js') }}"></script>
        <script>$(function(){ RoleTablesDatatables.init(); });</script>
@endsection




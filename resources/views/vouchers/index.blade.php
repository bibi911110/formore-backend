@extends('layouts.app')
@section('title','Vouchers')
@section('content')
<!-- Datatables Content -->
  <div class="block full">
      <div class="block-title">
          <h2><strong>Vouchers</strong> </h2>
           <h1 class="pull-right">
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('vouchers.create') }}">Add New</a>
          </h1>
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
                        <th class="text-center">Status</th>
                        <th class="text-center">Used Code Status</th>
                        <th class="text-center">View</th>
                        <th class="text-center">Lottery Code</th>
                      <th class="text-center">Actions</th>
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
                      <td class="text-center">
                       @if($vouchers->status == 1)
                            <a href="{{ route('vouchers_status',['id'=> $vouchers->id,'status'=> $vouchers->status]) }}"><span class="label label-success">Active</span></a>
                        @else
                            <a href="{{ route('vouchers_status',['id'=> $vouchers->id,'status'=> $vouchers->status]) }}"><span class="label label-danger">Deactive</span></a>
                        @endif
                      </td>
                      <td>
                         @if($vouchers->code_status == 1)
                            <p>Used</p>
                        @else
                            <p>Not Used</p>
                        @endif
                      </td>
                      <td class="text-center">
                       <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal_{{$i}}">Voucher Details</button>

                          <!-- Modal -->
                          <div id="myModal_{{$i}}" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header" style="background-color: black;color: white;">
                                  <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
                                  <h4 class="modal-title"><b>Voucher Details</b></h4>
                                </div>
                                 <div class="modal-body">
                                    <div class="row">
                                      <div class="col-md-6">
                                         <b>Business Name - </b>{{$vouchers->bussName}}
                                      </div>
                                      <div class="col-md-6">
                                        <b>country - </b>{{$vouchers->countryName}}
                                      </div>
                                    </div>
                                  <hr>
                                  <div class="row">
                                      <div class="col-md-6">
                                         <b>Code - </b>{{$vouchers->code}}
                                      </div>
                                      <div class="col-md-6">
                                        <b>Icon - </b><img src="<?php echo  url('/').'/'.$vouchers->icon; ?>" style="width: 30%">
                                      </div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                      <div class="col-md-6">
                                         <b>Image - </b><img src="<?php echo  url('/').'/'.$vouchers->image; ?>" style="width: 30%">
                                      </div>
                                      <div class="col-md-6">
                                        <b>Banner Image - </b><img src="<?php echo  url('/').'/'.$vouchers->banner_image; ?>" style="width: 30%">
                                      </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                      <div class="col-md-6">
                                         <b>Category - </b>{{$vouchers->voucherCategory}}
                                      </div>
                                      <div class="col-md-6">
                                        @if($vouchers->campaign_type == 1)
                                          <b>Campaign Type - </b>Random Winners
                                        @elseif($vouchers->campaign_type == 2)
                                          <b>Campaign Type - </b>Instant Win (all)
                                        @elseif($vouchers->campaign_type == 3)
                                          <b>Campaign Type - </b>Loyalty
                                        @elseif($vouchers->campaign_type == 4)
                                          <b>Campaign Type - </b>Lottery
                                        @endif
                                      </div>
                                    </div>
                                  <hr>
                                  <div class="row">
                                  @if($vouchers->category_id == 3)
                                      <div class="col-md-6">
                                         <b>Campaign Code - </b>{{$vouchers->campaign_code}}
                                      </div>
                                      <div class="col-md-6">
                                          <b>Campaign Start Date - </b>{{date('Y-m-d',strtotime($vouchers->campaign_start_date))}}
                                      </div>
                                    </div>
                                  <hr>
                                  

                                  <div class="row">
                                      <div class="col-md-6">
                                         <b>Campaign End Date - </b>{{date('Y-m-d',strtotime($vouchers->campaign_end_date))}}
                                      </div>
                                      @if($vouchers->campaign_type != '1')

                                      <!-- <div class="col-md-6">
                                          <b>Date Of Campaign - </b>{{date('Y-m-d',strtotime($vouchers->date_of_campaign))}}
                                      </div> -->
                                      @endif
                                    </div>
                                  <hr>

                                  <div class="row">
                                      <!-- <div class="col-md-6">
                                         <b>Max Member - </b>{{$vouchers->max_member}}
                                      </div> -->
                                      <div class="col-md-6">
                                          <b>Used Code Member - </b>{{$vouchers->used_code_member}}
                                      </div>
                                    </div>
                                  <hr>
                                  @endif
                                  <div class="row">
                                      <div class="col-md-6">
                                         <b>Start Date - </b>{{date('Y-m-d',strtotime($vouchers->start_date))}}
                                      </div>
                                      <div class="col-md-6">
                                          <b>End Date - </b>{{date('Y-m-d',strtotime($vouchers->end_date))}}
                                      </div>
                                    </div>
                                  <hr>

                                  <div class="row">
                                      <div class="col-md-6">
                                         <b>title Eng - </b>{{$vouchers->title_eng}}
                                      </div>
                                      <div class="col-md-6">
                                          <b>Title Italian - </b>{{$vouchers->title_italian}}
                                      </div>
                                    </div>
                                  <hr>

                                  <div class="row">
                                      <div class="col-md-6">
                                         <b>Title Greek - </b>{{$vouchers->title_greek}}
                                      </div>
                                      <div class="col-md-6">
                                          <b>Title Albanian - </b>{{$vouchers->title_albanian}}
                                      </div>
                                    </div>
                                  <hr>

                                  <div class="row">
                                      <div class="col-md-6">
                                         <b>Terms Eng - </b>{{$vouchers->terms_eng}}
                                      </div>
                                      <div class="col-md-6">
                                          <b>Terms Italian - </b>{{$vouchers->terms_italian}}
                                      </div>
                                    </div>
                                  <hr>
                                  <div class="row">
                                      <div class="col-md-6">
                                         <b>Terms Greek - </b>{{$vouchers->terms_greek}}
                                      </div>
                                      <div class="col-md-6">
                                          <b>Terms Albanian - </b>{{$vouchers->terms_albanian}}
                                      </div>
                                    </div>
                                  <hr>

                                  <div class="row">
                                      <div class="col-md-6">
                                         <b>Description Eng - </b>{{$vouchers->description_eng}}
                                      </div>
                                      <div class="col-md-6">
                                          <b>Description Italian - </b>{{$vouchers->description_italian}}
                                      </div>
                                    </div>
                                  <hr>

                                  <div class="row">
                                      <div class="col-md-6">
                                         <b>Description Greek - </b>{{$vouchers->description_greek}}
                                      </div>
                                      <div class="col-md-6">
                                          <b>Description Albanian - </b>{{$vouchers->description_albanian}}
                                      </div>
                                    </div>
                                  <hr>

                                  <div class="row">
                                      <div class="col-md-6">
                                         <b>Text For Not Win Code Eng - </b>{{$vouchers->text_for_not_win_code_eng}}
                                      </div>
                                      <div class="col-md-6">
                                          <b>Text For Not Win Code Italian - </b>{{$vouchers->text_for_not_win_code_italian}}
                                      </div>
                                    </div>
                                  <hr>
                                  <div class="row">
                                      <div class="col-md-6">
                                         <b>Text For Not Win Code Greek - </b>{{$vouchers->text_for_not_win_code_greek}}
                                      </div>
                                      <div class="col-md-6">
                                          <b>Text For Not Win Code Albanian - </b>{{$vouchers->text_for_not_win_code_albanian}}
                                      </div>
                                    </div>
                                  <hr>

                                  <div class="row">
                                      <div class="col-md-6">
                                         <b>Text For Win Code Eng  - </b>{{$vouchers->text_for_win_code_eng}}
                                      </div>
                                      <div class="col-md-6">
                                          <b>Text For Win Code Italian - </b>{{$vouchers->text_for_win_code_italian}}
                                      </div>
                                    </div>
                                  <hr>

                                  <div class="row">
                                      <div class="col-md-6">
                                         <b>Text For Win Code Greek  - </b>{{$vouchers->text_for_win_code_greek}}
                                      </div>
                                      <div class="col-md-6">
                                          <b>Text For Win Code Albanian - </b>{{$vouchers->text_for_win_code_albanian}}
                                      </div>
                                    </div>
                                  <hr>
                                  @if($vouchers->scenario_type != 2)

                                  <div class="row">
                                      <div class="col-md-6">
                                         <b>Bar Code - </b><img src="<?php echo  url('/').'/'.$vouchers->bar_code_image; ?>" style="width: 30%">
                                      </div>
                                      <div class="col-md-6">
                                        <b>QR Code - </b><img src="<?php echo  url('/').'/'.$vouchers->qr_code; ?>" style="width: 30%">
                                      </div>
                                    </div>
                                    <hr>
                                    @endif
                              </div>
                                    
                                <div class="modal-footer" style="background-color: black;">
                                  <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color:white;">Close</button>
                                </div>
                              </div>

                            </div>
                          </div>
                      </td>
                      @if($vouchers->scenario_type == 2)
                      <td class="text-center">
                       <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myLotery_{{$i}}">Lotery Details</button>

                          <!-- Modal -->
                          <div id="myLotery_{{$i}}" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header" style="background-color: black;color: white;">
                                  <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
                                  <h4 class="modal-title"><b>Voucher Details</b></h4>
                                </div>
                                 <div class="modal-body">  
                                   <?php $loteryData = \App\Models\Lotery_code_details::where('voucher_id',$vouchers->id)->get();
                                   
                                    if(!empty($loteryData) && count($loteryData) != '0')
                                    {
                                   ?>
                                   <?php foreach ($loteryData as $lotery) { ?>
                                   
                                    <div class="row">
                                        <div class="col-md-4">
                                          <b>Code - </b>{{$lotery->lotery_code}}
                                        </div>
                                        <div class="col-md-4">
                                          <b>Bar Code - </b><img src="<?php echo  url('/').'/'. $lotery->bar_code; ?>" style="width: 30%">
                                        </div>
                                        <div class="col-md-4">
                                          <b>QR Code - </b><img src="<?php echo  url('/').'/'. $lotery->qr_code_image; ?>" style="width: 30%">
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
                      <td class="text-center">
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
                      </td>
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




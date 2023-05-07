@extends('layouts.app')
@section('title','Stamp Masters')
@section('content')
  <div class="block full">
      <div class="block-title">
          <h2><strong>Stamp Masters</strong> </h2>
           <h1 class="pull-right">
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('stampMasters.create') }}">Add New</a>
          </h1>
      </div>
        @include('flash::message')
      <div class="table-responsive">
         <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Business</th>
                      <!-- <th class="text-center">NFC Code</th> -->
                     <!--  <th class="text-center">Country</th> -->
                     <!--  <th class="text-center">Type</th> -->
                     <th class="text-center">View</th>
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i=1;?>
                  @foreach ($data as $key => $stamp)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{ $stamp->bussName }}</td>
                      <!-- <td class="text-center">{{ $stamp->nfc_code }}</td> -->
                      <!-- <td class="text-center">{{ $stamp->countryName }}</td> -->
                      <!-- <td class="text-center"><?php if($stamp->stapm_point == 1){ echo 'Stamp';}else { echo 'Point';} ?></td>
                     -->
                      <td class="text-center">
                       <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal_{{$i}}">Stamp Details</button>

                          <!-- Modal -->
                          <div id="myModal_{{$i}}" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header" style="background-color: black;color: white;">
                                  <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
                                  <h4 class="modal-title"><b>Stamp Details</b></h4>
                                </div>
                                 <div class="modal-body">
                                  <div class="row">
                                        <?php $sg_data = \App\Models\Nfc_code::where('stamp_id',  $stamp->id)->get();
                                            //echo "<pre>"; print_r($sg_data); exit;
                                         
                                        
                                        foreach ($sg_data as $key =>  $sgp_data) { ?>
                                      <div class="col-md-12">
                                         <b>Nfc Code</b>  - {{$sgp_data->nfc_code}}
                                      </div>
                                      <?php } ?>
                                    </div>
                                  <hr>
                                    <div class="row">
                                      <div class="col-md-6">
                                         <b>Upload the image of the loyalty card - </b><img src="<?php echo  url('/').'/'.$stamp->image_of_loyalty_card; ?>" style="width: 30%">
                                      </div>
                                      <div class="col-md-6">
                                        <b>Set up level  - </b>{{$stamp->setup_level}}
                                      </div>
                                    </div>
                                  <hr>
                                  <div class="row">
                                      <div class="col-md-6">
                                         <b>Daily limit for each member - </b>{{$stamp->daily_limit}}
                                      </div>
                                      <div class="col-md-6">
                                         @if($stamp->welcome_stamp == 1)
                                         <b>Welcome stamp - </b>Yes
                                         @else
                                          <b>Welcome stamp - </b>No
                                        @endif
                                      </div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                      <div class="col-md-6">
                                        @if($stamp->birthday_step == 1)
                                         <b>Birthday stamp - </b>Yes
                                         @else
                                          <b>Birthday stamp - </b>No
                                        @endif
                                       
                                      </div>
                                      <div class="col-md-6">
                                        @if($stamp->bonus_stamp == 1)
                                         <b>Bonus stamp - </b>Yes
                                         @else
                                          <b>Bonus stamp - </b>No
                                        @endif
                                         
                                      </div>
                                    </div>
                                  <hr>
                                   <div class="row">
                                      <div class="col-md-6">
                                         <b>Expiration period of stamps - </b>{{date('Y-m-d',strtotime($stamp->stapm_expired))}}
                                      </div>
                                      <div class="col-md-6">
                                          <b>Points collection per stamp - </b>{{$stamp->point_per_stamp}}
                                      </div>
                                    </div>
                                  <hr>

                                  <div class="row">
                                      <div class="col-md-6">
                                         <b>Currency - </b>{{$stamp->Currency}}
                                      </div>
                                      <div class="col-md-6">
                                          <b>Ratio for cash out (points) - </b>{{$stamp->ration_of_cash_out}}
                                      </div>
                                    </div>
                                  <hr>
                               
                                  <div class="row">
                                      <div class="col-md-6">
                                         <b>Message Eng - </b>{{$stamp->message_eng}}
                                      </div>
                                      <div class="col-md-6">
                                          <b>Message Italian - </b>{{$stamp->message_italian}}
                                      </div>
                                    </div>
                                  <hr>

                                  <div class="row">
                                      <div class="col-md-6">
                                         <b>Message Greek - </b>{{$stamp->message_greek}}
                                      </div>
                                      <div class="col-md-6">
                                          <b>Message Albanian - </b>{{$stamp->message_albanian}}
                                      </div>
                                    </div>
                                  <hr>

                                                          
                                    
                                <div class="modal-footer" style="background-color: black;">
                                  <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color:white;">Close</button>
                                </div>
                              </div>

                            </div>
                          </div>
                      </td>
                      <td class="text-center">
                          {!! Form::open(['route' => ['stampMasters.destroy', $stamp->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                                           
                                <a href="{{ route('stampMasters.edit', $stamp->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
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
        <script>$(function(){ TablesDatatables.init(); });</script>
@endsection





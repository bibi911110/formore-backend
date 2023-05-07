@extends('layouts.app')
@section('title','Points Masters')
@section('content')
  <div class="block full">
      <div class="block-title">
          <h2><strong>Points Masters</strong> </h2>
           <h1 class="pull-right">
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('pointsMasters.create') }}">Add New</a>
          </h1>
      </div>
        @include('flash::message')
      <div class="table-responsive">
         <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Business</th>
                      <!-- <th class="text-center">Country</th> -->
                     <th class="text-center">View</th>
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i=1;?>
                  @foreach ($data as $key => $points)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{ $points->bussName }}</td>
                      <!-- <td class="text-center">{{ $points->countryName }}</td> -->
                      <td class="text-center">
                       <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal_{{$i}}">Points Details</button>

                          <!-- Modal -->
                          <div id="myModal_{{$i}}" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header" style="background-color: black;color: white;">
                                  <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
                                  <h4 class="modal-title"><b>Points Details</b></h4>
                                </div>
                                 <div class="modal-body">
                                   <div class="row">
                                      <div class="col-md-6">
                                         <b>Upload the image of the loyalty card - </b><img src="<?php echo  url('/').'/'.$points->image_of_loyalty_card; ?>" style="width: 30%">
                                      </div>
                                      <div class="col-md-6">
                                        <b>Color  - </b>{{$points->color}}
                                      </div>
                                    </div>
                                      <hr>
                                    <div class="row">
                                      <div class="col-md-6">
                                        @if($points->schema == 1)
                                          <b>Schema - </b>Have to win direct
                                        @elseif($points->schema == 2)
                                          <b>Schema - </b> Win and continue for next level
                                        @elseif($points->schema == 3)
                                          <b>Schema - </b> Option if you want to take the voucher (and restart the counter) or continue for next level
                                        @endif
                                      </div>
                                      <div class="col-md-6">
                                        <b>Currency - </b>{{$points->currency_name}}
                                      </div>
                                    </div>
                                  <hr>
                                  <div class="row">
                                      <div class="col-md-6">
                                         <b>Ratio of collecting points - </b>{{$points->ratio_of_collecting_points}}
                                      </div>
                                      <div class="col-md-6">
                                        <b>Ratio for cash out(points) - </b>{{$points->ratio_for_cash_out}}
                                      </div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                      <div class="col-md-6">
                                         <b>Segments - </b>{{$points->segment_name}}
                                      </div>
                                      <div class="col-md-6">
                                        <b>Levels based on scenarios - </b>{{$points->levels_based_on_scenarios}}
                                      </div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                      <div class="col-md-6">
                                        @if($points->birthday == 1)
                                         <b>Birthday - </b>Yes
                                         @else
                                          <b>Birthday - </b>No
                                        @endif
                                      </div>
                                      <div class="col-md-6">
                                        @if($points->welcome == 1)
                                         <b>Welcome - </b>Yes
                                         @else
                                          <b>Welcome - </b>No
                                        @endif
                                      </div>
                                    </div>
                                  <hr>
                                  @if($points->birthday == 1)
                                  <div class="row">
                                      <div class="col-md-6">
                                        <b>Birthday Points - </b>{{$points->birth_point}}
                                      </div>
                                      <div class="col-md-6">
                                       @php
                                          $birth_segments_id = explode(',', $points->birth_segments_id);
                                          $birth_segments = \App\Models\Segment::whereIn('id',$birth_segments_id)->select('segment_name','id')->get();
                                       @endphp
                                       <b>Birthday segments</b>
                                       <?php foreach ($birth_segments as $key => $value) { ?>
                                         <div>{{ $value->segment_name}}</div>
                                        <?php  } ?>
                                      </div>
                                    </div>
                                    @endif
                                  <hr>

                                  @if($points->welcome == 1)
                                  <div class="row">
                                      <div class="col-md-6">
                                        <b>Welcome Points - </b>{{$points->welcome_point}}
                                      </div>
                                      <div class="col-md-6">
                                       @php
                                          $welcome_segments_id = explode(',', $points->welcome_segments_id);
                                          $welcome_segments = \App\Models\Segment::whereIn('id',$welcome_segments_id)->select('segment_name','id')->get();
                                       @endphp
                                       <b>Welcome segments</b>
                                       <?php foreach ($welcome_segments as $key => $value) { ?>
                                         <div>{{ $value->segment_name}}</div>
                                        <?php  } ?>
                                      </div>
                                    </div>
                                    @endif
                                  <hr>

                                  <div class="row">
                                      <div class="col-md-6">
                                         <b>Transactions means - </b>{{$points->transactions_means}}
                                      </div>
                                      <div class="col-md-6">
                                         <b>Duration - </b>{{$points->duration}}
                                      </div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                      <div class="col-md-6">
                                         <b>Points limits - </b>{{$points->points_limits}}
                                      </div>

                                      <div class="col-md-6">
                                        @if($points->campaign == 1)
                                         <b>Campaign - </b>Yes
                                         @else
                                          <b>Campaign - </b>No
                                        @endif
                                      </div>
                                    </div>
                                  <hr>
                               @if($points->campaign == 1)
                                   <div class="row">
                                      <div class="col-md-6">
                                         <b>Start date - </b>{{date('Y-m-d',strtotime($points->start_date))}}
                                      </div>
                                      <div class="col-md-6">
                                          <b>End date - </b>{{date('Y-m-d',strtotime($points->end_date))}}
                                      </div>
                                    </div>
                                  <hr>
                                  <div class="row">
                                     <div class="col-md-6">
                                         <b>Expiration date - </b>{{date('Y-m-d',strtotime($points->expiration_date))}}
                                      </div>
                                    <div class="col-md-6">
                                        @if($points->amount_type == 1)
                                         <b>Amount type - </b>Percentage - {{$points->c_percentage}}
                                         @else
                                          <b>Amount_type - </b>Amount - {{$points->c_amount}}
                                        @endif
                                      </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                     <div class="col-md-6">
                                       @php
                                          $c_segments_id = explode(',', $points->c_segments_id);
                                          $c_segment_data = \App\Models\Segment::whereIn('id',$c_segments_id)->select('segment_name','id')->get();
                                       @endphp
                                       <b>Campaign segments</b>
                                       <?php foreach ($c_segment_data as $key => $value) { ?>
                                         <div>{{ $value->segment_name}}</div>
                                        <?php  } ?>
                                      </div>
                                    
                                    </div>
                                  @endif
                                  <hr>
                                  <div class="row">
                                      <div class="col-md-6">
                                         <b>Message Eng - </b>{{$points->message_eng}}
                                      </div>
                                      <div class="col-md-6">
                                          <b>Message Italian - </b>{{$points->message_italian}}
                                      </div>
                                    </div>
                                  <hr>
                                  <div class="row">
                                      <div class="col-md-6">
                                         <b>Message Greek - </b>{{$points->message_greek}}
                                      </div>
                                      <div class="col-md-6">
                                          <b>Message Albanian - </b>{{$points->message_albanian}}
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
                          {!! Form::open(['route' => ['pointsMasters.destroy', $points->id], 'method' => 'delete']) !!}
                              <div class='btn-group'>
                                                           
                                <a href="{{ route('pointsMasters.edit', $points->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
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







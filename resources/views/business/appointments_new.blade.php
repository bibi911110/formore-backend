@extends('layouts.app')
@section('title','Appointments')
@section('content')
 <div class="block full">
      <div class="block-title">
          <h2><strong>Appointments</strong> </h2>
           <!-- <h1 class="pull-right">
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('brands.create') }}">Add New</a>
          </h1> -->
      </div>
        @include('flash::message')
      <div class="table-responsive">
        <!-- <button class="btn btn-primary">Today</button> -->
        <a href="{{url('appointments_new')}}" class="btn btn-primary">New</a>
        <a href="{{url('appointments_view')}}" class="btn btn-primary">Today</a>
        <a href="{{url('appointments_weekly_view')}}" class="btn btn-primary">Weekly</a>
        <a href="{{url('appointments_monthly_view')}}" class="btn btn-primary">Monthly</a>
         <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Slot</th>
                      <th class="text-center">Date</th>
                      <th class="text-center">Total Booking</th>
                      <th class="text-center">Booked Status</th>
                  </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
                  @foreach ($book_slot as $key => $slot)
                    <?php $appointmentCount = \App\Models\Booking_add_cart_time_order::where('business_id',$slot->business_id)->where('slot_id',$slot->id)
                    //->whereDate('date', \Carbon\Carbon::today())
                    ->count();  ?>
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{ $slot->slot_time}}</td>
                      <td class="text-center">{{ $slot->date}}</td>
                      <td class="text-center">{{ $appointmentCount}}</td>
                      @if($slot->limit_per_slot == $appointmentCount)
                        <td class="text-center"><a href="" data-toggle="modal" data-target="#myBooking_{{$slot->id}}"><span style="color: #FF00FF;"><?php echo "BOOKED"; ?></span></a></td>
                            <div id="myBooking_{{$slot->id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header" style="background-color: black;color: white;">
                                  <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
                                  <h4 class="modal-title"><b>Booking Details</b></h4>
                                </div>
                                <div class="modal-body">  
                                    <?php  $booking_data = \App\Models\Booking_add_cart_time_order::where('slot_id',$slot->id)
                                                            ->whereDate('booking_add_cart_time_order.date', \Carbon\Carbon::today())
                                                            ->leftJoin('booked_services','booking_add_cart_time_order.booking_id','booked_services.booking_id')
                                                            ->leftJoin('users','booked_services.member_id','users.id')
                                                            ->select('booking_add_cart_time_order.*','booked_services.id as bookingId','users.id as userId','users.name')
                                                            ->get();
                                    if(!empty($booking_data) && count($booking_data) != '0')
                                    {
                                   ?>
                                   
                                    <?php foreach ($booking_data as  $booking) { ?>
                                      <div class="row">
                                          <div class="col-md-3">
                                              <p><b>User Name : </b> {{ $booking->name }}</p>
                                          </div>
                                          <div class="col-md-3">
                                              <p><b>Slot Time : </b> {{ $slot->slot_time }}</p>
                                          </div>
                                          <div class="col-md-3">
                                              <p><b>Action : </b> <a href="{{url('/booked_appointment').'/'.$booking->id.'/'.$booking->userId.'/'.$slot->id}}">Edit</a></p>
                                          </div>
                                        </div>
                                        <hr>
                                        <?php  } ?>
                                        
                                      
                                    <hr>
                                  <?php  
                                      }
                                   ?>   
                                </div>
                                    
                                <div class="modal-footer" style="background-color: black;">
                                  <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color:white;">Close</button>
                                </div>
                              </div>

                            </div>
                          </div>
                      @else
                      <?php if($appointmentCount == ''){ ?>
                        <td class="text-center"><a href="{{ url('book_appointment',['id'=> $slot->id]) }}"><?php echo "AVAILABLE"; ?></a></td>
                      <?php }else { ?>
                        <td class="text-center"><a href="{{ url('available_appointment_list',['id'=> $slot->id]) }}"><?php echo "AVAILABLE"; ?></a></td>
                      <?php } ?>
                      @endif
                      
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


